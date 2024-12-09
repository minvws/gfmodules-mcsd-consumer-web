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
        return $this->updateConsumer($id);
    }

    public function updateConsumer(string $id): View
    {

        # DO UPDATE
        try {
            // Call FastAPI app with a timeout
            $response = Http::post($this->baseUrl . '/supplier/' . $id . '/update_resources');
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
            $response = Http::get($this->baseUrl . '/resource_map', [
                'supplier_id' => $id
            ]);
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
