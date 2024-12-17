@extends('layouts.app')

@section('content')

<div class="container" style="display: flex; gap: 20px;">
    <div style="flex: 1; border: 1px solid #ccc; padding: 10px;">
        <h3>Consumer resource data</h3>
        <pre>{{ json_encode($consumerData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
    </div>
    <div style="flex: 1; border: 1px solid #ccc; padding: 10px;">
        <h3>Supplier resource data</h3>
        <pre>{{ json_encode($supplierData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
    </div>
</div>

@endsection
