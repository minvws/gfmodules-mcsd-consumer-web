<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use App\Exceptions\BackendConnectionError;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Exception;

class ConsumerController extends Controller
{
    private string $mapperUrl;

    public function __construct()
    {
        $this->mapperUrl = Config::get('app.mcsd_fastapi_app_url');
    }

    public function index(): View
    {
        return view('consumer.index');
    }

    public function getResource(Request $request): View
    {
        $resourceId = $request->get('resourceId');
        $resourceType = $request->get('resourceType');
        if (empty($resourceId) || empty($resourceType)) {
            return view('consumer.index', ['error' => 'Resource ID and Resource Type are required']);
        }

        $get_url = $this->getBaseUrl();

        $consumerResource = $this->retrieveResource($get_url['url'], $resourceType, $resourceId);

        $supplierData = $this->getSupplierUrlAndResourceId($resourceId);

        $supplierResource = $this->retrieveResource(
            $supplierData['supplier_url'],
            $resourceType,
            $supplierData['resource_id']
        );
        $supplierData['resourceData'] = $supplierResource;

        return view('consumer.resource', ['consumerData' =>
            $consumerResource, 'supplierData' => $supplierData]);
    }

    /**
     * @return array<string, string>
     */
    private function retrieveResource(string $url, string $resourceType, string $resourceId): array
    {
        try {
            $response = Http::get($url . "/$resourceType/$resourceId/_history");
        } catch (Exception $e) {
            throw new BackendConnectionError($e->getMessage());
        }
        if ($response->status() !== 200) {
            throw new BackendConnectionError('Error occurred: ' . $response->status() . ' ' . $response->body());
        }
        return $response->json();
    }

    /**
     * @return array<string, string>
     */
    private function getBaseUrl(): array
    {
        try {
            $response = Http::get(Config::get('app.mcsd_fastapi_app_url') . '/consumer');
        } catch (Exception $e) {
            throw new BackendConnectionError($e->getMessage());
        }
        if ($response->status() !== 200) {
            throw new BackendConnectionError('Error occurred: ' . $response->status() . ' ' . $response->body());
        }
        return ['url' => $response['consumer_url']];
    }

    /**
     * @return array<string, string>
     */
    private function getSupplierUrlAndResourceId(string $resourceId): array
    {
        try {
            $mapper = Http::get($this->mapperUrl . '/resource_map', [
                'consumer_resource_id' => $resourceId,
            ]);
        } catch (Exception $e) {
            throw new BackendConnectionError($e->getMessage());
        }
        if ($mapper->status() !== 200) {
            throw new BackendConnectionError('Error occurred: ' . $mapper->status() . ' ' . $mapper->body());
        }
        if (empty($mapper->json())) {
            throw new BackendConnectionError('No supplier found for this resource');
        }
        $supplierId = $mapper->json()[0]['supplier_id'];
        $supplier = Http::get($this->mapperUrl . "/supplier/$supplierId");
        if ($supplier->status() !== 200) {
            throw new BackendConnectionError('Error occurred: ' . $supplier->status() . ' ' . $supplier->body());
        }
        return [
            'supplier_url' => $supplier->json()['endpoint'],
            'supplier_id' => $supplierId,
            'supplier_name' => $supplier->json()['name'],
            'resource_id' => $mapper->json()[0]['supplier_resource_id'],
        ];
    }
}
