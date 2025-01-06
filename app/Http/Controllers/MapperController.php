<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Exceptions\BackendConnectionError;
use Exception;

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

        $errors = null;
        $responseData = null;

        try {
            $response = Http::get($this->mapperUrl, [
                'supplier_id' => $id,
            ]);
        } catch (Exception $e) {
            throw new BackendConnectionError($e->getMessage());
        }
        if ($response->status() !== 200) {
            throw new BackendConnectionError('Error occurred: ' . $response->status() . ' ' . $response->body());
        }

        $responseData = $response->json();

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

        return view('mapper-overview', [
            'mapperData' => $responseData,
            'errors' => $errors
        ]);
    }
}
