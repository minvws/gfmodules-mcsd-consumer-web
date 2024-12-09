<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use Illuminate\Validation\ValidationException;

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

    public function store(SupplierStoreRequest $request): RedirectResponse
    {
        try {
            Http::post($this->baseUrl, $request->validated());
            return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
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

    public function update(SupplierUpdateRequest $request, string $id): RedirectResponse
    {
        try {
            Http::put("{$this->baseUrl}/{$id}", $request->validated());
            return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        Http::delete("{$this->baseUrl}/{$id}");

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
