<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Config::get('app.mcsd_fastapi_app_url');
    }

    public function update(Request $request): View
    {
        $id = $request->input('id');
        $resourceType = $request->input('resourceType');

        if (($resourceType !== null) && ($id === null)) {
            $responseData = [
                'error' => 'Error occured: You must set ID when you want to use Resource Type'
            ];
            return view('mapper-overview', ['responseData' => $responseData]);
        }

        return $this->updateConsumer($id, $resourceType);
    }

    public function updateConsumer(?string $id = null, ?string $resourceType = null): View
    {
        # DO UPDATE
        try {
            if (is_null($id) && is_null($resourceType)) {
                $response = Http::post($this->baseUrl . '/update_resources');
            } elseif (!is_null($id) && is_null($resourceType)) {
                $response = Http::post($this->baseUrl . '/update_resources/' . $id);
            } elseif (!is_null($id) && !is_null($resourceType)) {
                $response = Http::post($this->baseUrl . '/update_resources/' . $id . '/' . $resourceType);
            } else {
                $responseData = [
                    'error' => 'Invalid parameters'
                ];
                return view('mapper-overview', ['responseData' => $responseData]);
            }
            $responseData = $response->json();
            if ($response->status() !== 200) {
                $responseData = [
                    'error' => 'Error occured: ' . $response->status() . ' ' . $response->body()
                ];
                return view('mapper-overview', ['responseData' => $responseData]);
            }
        } catch (ConnectionException $e) {
            $responseData = [
                'error' => 'Connection error: ' . $e->getMessage()
            ];
            return view('mapper-overview', ['responseData' => $responseData]);
        }

        # RETURN VIEW
        try {
            // Call FastAPI app with a timeout
            if (is_null($id) && is_null($resourceType)) {
                $response = Http::get($this->baseUrl . '/resource_map');
            } elseif (!is_null($id) && is_null($resourceType)) {
                $response = Http::get($this->baseUrl . '/resource_map', [
                    'supplier_id' => $id,
                ]);
            } elseif (!is_null($id) && !is_null($resourceType)) {
                $response = Http::get($this->baseUrl . '/resource_map', [
                    'supplier_id' => $id,
                    'resource_type' => $resourceType
                ]);
            } else {
                $responseData = [
                    'error' => 'Invalid parameters'
                ];
                return view('mapper-overview', ['responseData' => $responseData]);
            }
            $responseData = $response->json();
            if ($response->status() === 200) {
                if (!isset($responseData[0])) {
                    $responseData = [
                        'error' => 'No data found'
                    ];
                    return view('mapper-overview', ['responseData' => $responseData]);
                }
                $headers = array_keys($responseData[0]);
                $rows = array_map(function ($item) {
                    return array_values($item);
                }, $responseData);
                $responseData = [
                    'headers' => $headers,
                    'rows' => $rows
                ];
            } else {
                $responseData = [
                    'error' => 'Error occured: ' . $response->status() . ' ' . $response->body()
                ];
                return view('mapper-overview', ['responseData' => $responseData]);
            }
        } catch (ConnectionException $e) {
            $responseData = [
                'error' => 'Connection error: ' . $e->getMessage()
            ];
            return view('mapper-overview', ['responseData' => $responseData]);
        }

        return view('mapper-overview', ['responseData' => $responseData]);
    }
}
