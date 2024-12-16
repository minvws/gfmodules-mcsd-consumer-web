<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;

class MapperController extends Controller
{
    private string $mapperUrl;

    public function __construct()
    {
        $this->mapperUrl = Config::get('app.mcsd_fastapi_app_url') . '/resource_map';
    }

    public function index(Request $request): View
    {
        $id = $request->input('id');
        $resourceType = $request->input('resourceType');

        $errors = null;
        $responseData = null;

        try {
            if (is_null($id) && !is_null($resourceType)) {
                $errors = 'Invalid parameters, you must set ID when you want to use Resource Type';
            } else {
                $response = Http::get($this->mapperUrl, [
                    'supplier_id' => $id,
                    'resource_type' => $resourceType
                ]);
                $responseData = $response->json();
                if ($response->status() === 200) {
                    if (!isset($responseData[0])) {
                        $errors = 'No data found';
                    } else {
                        $headers = array_keys($responseData[0]);
                        $rows = array_map(function ($item) {
                            return array_values($item);
                        }, $responseData);
                        $responseData = [
                            'headers' => $headers,
                            'rows' => $rows
                        ];
                    }
                } else {
                    $errors = 'Error occurred: ' . $response->status() . ' ' . $response->body();
                }
            }
        } catch (ConnectionException $e) {
            $errors = 'error: ' . $e->getMessage();
        }

        return view('mapper-overview', [
            'mapperData' => $responseData,
            'errors' => $errors
        ]);
    }
}
