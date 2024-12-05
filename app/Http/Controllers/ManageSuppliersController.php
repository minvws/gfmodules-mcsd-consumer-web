<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\View\View;

class ManageSuppliersController extends Controller
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('mcsd_fastapi_app_url') . '/suppliers';
    }

    public function __invoke(): View
    {
        // $response = Http::get($this->baseUrl);
        // $suppliers = $response->json();
        
        // Mock suppliers with random json
        $suppliers = [
            [
                'URA number' => 1,
                'Care provider name' => 'Supplier 1',
                'Endpoint' => 'http://supplier1.com',
                'created_at' => '2021-09-01 12:00:00',
            ],
            [
                'URA number' => 2,
                'Care provider name' => 'Supplier 2',
                'Endpoint' => 'http://supplier2.com',
                'created_at' => '2021-09-02 12:00:00',
            ],
            [
                'URA number' => 3,
                'Care provider name' => 'Supplier 3',
                'Endpoint' => 'http://supplier3.com',
                'created_at' => '2021-09-03 12:00:00',
            ]
        ];

                
        return view('suppliers.index', compact('suppliers'));
    }

    // Display a listing of the suppliers
    // public function index()
    // {
    //     $response = Http::get($this->baseUrl);
    //     $suppliers = $response->json();
    //     return view('suppliers.index', compact('suppliers'));
    // }

    // Show the form for creating a new supplier
    public function create()
    {
        return view('suppliers.create');
    }

    // Store a newly created supplier in storage
    public function store(Request $request)
    {
        # TODO Create a supplier validator model

        // Http::post($this->baseUrl, $request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    // Display the specified supplier
    public function show($id)
    {
        // $response = Http::get("{$this->baseUrl}/{$id}");
        // $supplier = $response->json();

        // Mock suppliers with random json
        $supplier = 
            [
                'URA number' => 1,
                'Care provider name' => 'Supplier 1',
                'Endpoint' => 'http://supplier1.com',
                'created_at' => '2021-09-01 12:00:00',
            ];

        return view('suppliers.show', compact('supplier'));
    }

    // Show the form for editing the specified supplier
    public function edit($id)
    {
        // $response = Http::get("{$this->baseUrl}/{$id}");
        // $supplier = $response->json();

        // Mock suppliers with random json
        $supplier = 
            [
                'URA number' => 1,
                'Care provider name' => 'Supplier 1',
                'Endpoint' => 'http://supplier1.com',
                'created_at' => '2021-09-01 12:00:00',
            ];

        return view('suppliers.edit', compact('supplier'));
    }

    // Update the specified supplier in storage
    public function update(Request $request, $id)
    {
        # TODO Create a supplier validator model

        // Http::put("{$this->baseUrl}/{$id}", $request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    // Remove the specified supplier from storage
    public function destroy($id)
    {
        // Http::delete("{$this->baseUrl}/{$id}");

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}