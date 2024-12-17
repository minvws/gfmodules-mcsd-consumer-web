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
        $since = $request->input('since');

        if ($since !== null) {
            $since = Carbon::parse($since)->shiftTimezone('Europe/Amsterdam')->toIso8601String();
        }

        return $this->updateConsumer($id, $since);
    }

    private function updateConsumer(
        ?string $id = null,
        ?string $since = null
    ): RedirectResponse {
        $errorData = null;

        //  Create URL for the request
        if (is_null($id)) {
            $url = $this->baseUrl . '/update_resources';
        } else {
            $url = $this->baseUrl . '/update_resources/' . $id;
        }

        $sinceParam = null;
        if ($since !== null) {
            $sinceParam = '?since=' . urlencode($since);
        }
        try {
            $response = Http::timeout(0)->post($url . ($sinceParam ?? ''));
            if ($response->status() !== 200) {
                $errorData = [
                    'error' => 'Error occured: ' . $response->status() . ' ' . $response->body()
                ];
            } elseif ($response->json() === []) {
                $errorData = [
                    'error' => 'No data was updated'
                ];
            }
        } catch (ConnectionException $e) {
            $errorData = [
                'error' => 'Connection error: ' . $e->getMessage()
            ];
        }

        if (isset($errorData)) {
            return redirect()->back()->withErrors($errorData);
        }

        return redirect()->route('resource.mapper', ['id' => $id])->with('success', 'Updated successfully.');
    }
}
