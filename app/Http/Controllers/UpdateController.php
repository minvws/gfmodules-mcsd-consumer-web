<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class UpdateController extends Controller
{
    public function __invoke(): View
    {
        // Read config mcsd_fastapi_app_url
        $mcsdFastapiAppUrl = config('mcsd_fastapi_app_url');

        try {
            // Call FastAPI app with a timeout
            $response = Http::timeout(2)->get($mcsdFastapiAppUrl . '/update-consumer');
            $responseData = $response->json();
        } catch (ConnectionException $e) {
            // Handle timeout exception
            $responseData = ['error' => 'Request timed out. Please try again later.'];
        }

        // Give response in view
        return view('mapper-overview', ['response' => $responseData]);
    }
}
