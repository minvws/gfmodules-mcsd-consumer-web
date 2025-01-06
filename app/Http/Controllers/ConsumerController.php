<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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
        if (isset($get_url['error'])) {
            return view('consumer.index', ['error' => $get_url['error']]);
        }

        $consumerResource = $this->retrieveResource($get_url['url'], $resourceType, $resourceId);

        if (isset($consumerResource['error'])) {
            return view('consumer.index', ['error' => $consumerResource['error']]);
        }

        $supplierData = $this->getSupplierUrlAndResourceId($resourceId);

        if (isset($supplierData['error'])) {
            return view('consumer.index', ['error' => $supplierData['error']]);
        }

        $supplierResource = $this->retrieveResource(
            $supplierData['supplier_url'],
            $resourceType,
            $supplierData['resource_id']
        );

        if (isset($supplierResource['error'])) {
            return view('consumer.index', ['error' => $supplierResource['error']]);
        }

        return view('consumer.resource', ['consumerData' =>
            $consumerResource['resourceData'], 'supplierData' => $supplierResource['resourceData']]);
    }

    /**
     * @return array<string, string>
     */
    private function retrieveResource(string $url, string $resourceType, string $resourceId): array
    {
        try {
            $response = Http::get($url . "/$resourceType/$resourceId/_history");
            if ($response->status() === 200) {
                return ['resourceData' => $response->json()];
            } else {
                return ['error' => 'Error occurred: ' . $response->status() . ' ' . $response->body()];
            }
        } catch (\Exception $e) {
            return ['error' => 'Error occurred: ' . $e->getMessage()];
        }
    }

    /**
     * @return array<string, string>
     */
    private function getBaseUrl(): array
    {
        try {
            $response = Http::get(Config::get('app.mcsd_fastapi_app_url') . '/consumer');
            if ($response->status() === 200) {
                return ['url' => $response['consumer_url']];
            } else {
                return ['error' => 'Error occurred: ' . $response->status() . ' ' . $response->body()];
            }
        } catch (\Exception $e) {
            return ['error' => 'Error occurred: ' . $e->getMessage()];
        }
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
            if ($mapper->status() !== 200) {
                return ['error' => 'Error occurred: ' . $mapper->status() . ' ' . $mapper->body()];
            }
            $supplierId = $mapper->json()[0]['supplier_id'];
            $supplier = Http::get($this->mapperUrl . "/supplier/$supplierId");
            if ($supplier->status() !== 200) {
                return ['error' => 'Error occurred: ' . $supplier->status() . ' ' . $supplier->body()];
            }
            return ['supplier_url' => $supplier->json()['endpoint'],
                'resource_id' => $mapper->json()[0]['supplier_resource_id']];
        } catch (\Exception $e) {
            return ['error' => 'Error occurred: ' . $e->getMessage()];
        }
    }
}
