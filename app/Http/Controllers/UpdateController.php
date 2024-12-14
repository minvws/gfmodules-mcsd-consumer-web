<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UpdateController extends Controller
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Config::get('app.mcsd_fastapi_app_url');
    }

    public function update(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $resourceType = $request->input('resourceType');
        $since = $request->input('since');

        if ($since !== null) {
            $since = Carbon::parse($since)->setTimezone('Europe/Amsterdam')->toIso8601String();
            $since = str_replace('+', '%2B', $since);
        }

        if (($resourceType !== null) && ($id === null)) {
            $errorData = [
                'error' => 'Error occured: You must set ID when you want to use Resource Type'
            ];
            return redirect()->route('resource.mapper')->withErrors($errorData);
        }

        return $this->updateConsumer($id, $resourceType, $since);
    }

    private function updateConsumer(
        ?string $id = null,
        ?string $resourceType = null,
        ?string $since = null
    ): RedirectResponse {
        # DO UPDATE
        try {
            if (is_null($id) && is_null($resourceType)) {
                $response = Http::timeout(0)->post($this->baseUrl . '/update_resources', [
                    '_since' => $since
                ]);
            } elseif (!is_null($id) && is_null($resourceType)) {
                $response = Http::timeout(0)->post($this->baseUrl . '/update_resources/' . $id, [
                    '_since' => $since
                ]);
            } elseif (!is_null($id) && !is_null($resourceType)) {
                $response = Http::timeout(0)->post($this->baseUrl . '/update_resources/' . $id . '/' . $resourceType, [
                    '_since' => $since
                ]);
            } else {
                $errorData = [
                    'error' => 'Invalid parameters'
                ];
                return redirect()->route('resource.mapper')->withErrors($errorData);
            }
            if ($response->status() !== 200) {
                $errorData = [
                    'error' => 'Error occured: ' . $response->status() . ' ' . $response->body()
                ];
                return redirect()->route('resource.mapper')->withErrors($errorData);
            }
        } catch (ConnectionException $e) {
            $errorData = [
                'error' => 'Connection error: ' . $e->getMessage()
            ];
            return redirect()->route('resource.mapper')->withErrors($errorData);
        }
        return redirect()->route('resource.mapper', ['id' => $id, 'resourceType' => $resourceType]);
    }
}
