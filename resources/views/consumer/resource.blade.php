@extends('layouts.app')

@section('content')

@if (!$version['match'])
<section role="alert" class="error no-print" aria-label="{{__('error') }}">
    <div>
        <p><span>{{__('Error') }}:</span> Consumer version <strong>( {{ $version['consumer'] }} )</strong> and supplier version <strong>( {{ $version['supplier'] }} )</strong> do not match: </p>
        <a style="color: white" href="{{ route('consumer.update', ['id' => $supplierId]) }}" class="button">Update consumer</a>
    </div>
</section>
@else
<section
    role="alert"
    class="confirmation no-print"
    role="group"
    aria-label="{{__('confirmation') }}">
    <div>
        <p><span>{{__('Confirmation') }}:</span> Consumer version <strong>( {{ $version['consumer'] }} )</strong> and supplier version <strong>( {{ $version['supplier'] }} )</strong> match </p>
    </div>
</section>
@endif
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
