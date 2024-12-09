<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ManageSuppliersController extends Controller
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Config::get('app.mcsd_fastapi_app_url') . '/supplier';
    }

    public function __invoke(): View
    {
        $response = Http::get($this->baseUrl);
        $suppliers = $response->json();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create(): View
    {
        return view('suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        # TODO Create a supplier validator model

        Http::post($this->baseUrl, $request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function show(string $id): View
    {
        $response = Http::get("{$this->baseUrl}/{$id}");
        $supplier = $response->json();

        return view('suppliers.show', compact('supplier'));
    }

    public function edit(string $id): View
    {
        $response = Http::get("{$this->baseUrl}/{$id}");
        $supplier = $response->json();

        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        # TODO Create a supplier validator model

        Http::put("{$this->baseUrl}/{$id}", $request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Http::delete("{$this->baseUrl}/{$id}");

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
