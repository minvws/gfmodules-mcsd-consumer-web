@extends('layouts.app')

@section('content')
    <section>
        <div>
            <h1>{{ $supplier['Care provider name'] }}</h1>
            <p>URA Number: {{ $supplier['URA number'] }}</p>
            <p>Care Provider Name: {{ $supplier['Care provider name'] }}</p>
            <p>Endpoint: {{ $supplier['Endpoint'] }}</p>
            <p>Created At: {{ $supplier['created_at'] }}</p>
            <div class="action-buttons">
                <a href="{{ route('suppliers.edit', $supplier['URA number']) }}" class="button">Edit</a>
                <a href="{{ route('suppliers.destroy', $supplier['URA number']) }}" class="button">Delete</a>
            </div>
        </div>
    </section>
@endsection
