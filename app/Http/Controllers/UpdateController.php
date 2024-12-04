<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class UpdateController extends Controller
{
    public function __invoke(): View
    {
        $mcsdFastapiAppUrl = config('mcsd_fastapi_app_url');

        // try {
        //     // Call FastAPI app with a timeout
        //     $response = Http::timeout(2)->get($mcsdFastapiAppUrl . '/update-consumer');
        //     $responseData = $response->json();
        // } catch (ConnectionException $e) {
        //     // Handle timeout exception
        //     $responseData = ['error' => 'Request timed out. Please try again later.'];
        // }

        $responseData = [
            'nrOfRows' => 6,
            'nrOfColumns' => 7,
            'columns' => ['supplier_id', 'resource_type', 'supplier_resource_id', 'supplier_resource_version',
                'consumer_resource_id', 'consumer_resource_version', 'last_update'],
            'rows' => [
                ['row1col1', 'row1col2', 'row1col3', 'row1col4', 'row1col5', 'row1col6', 'row1col7'],
                ['row2col1', 'row2col2', 'row2col3', 'row2col4', 'row2col5', 'row2col6', 'row2col7'],
                ['row3col1', 'row3col2', 'row3col3', 'row3col4', 'row3col5', 'row3col6', 'row3col7'],
                ['row4col1', 'row4col2', 'row4col3', 'row4col4', 'row4col5', 'row4col6', 'row4col7'],
                ['row5col1', 'row5col2', 'row5col3', 'row5col4', 'row5col5', 'row5col6', 'row5col7'],
                ['row6col1', 'row6col2', 'row6col3', 'row6col4', 'row6col5', 'row6col6', 'row6col7'],
            ],
        ];

        return view('mapper-overview', ['responseData' => $responseData]);
    }
}
