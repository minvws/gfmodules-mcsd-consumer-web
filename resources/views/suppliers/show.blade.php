@extends('layouts.app')

@section('content')
    <section>
        <div>
            <x-success-notification class="custom-class" />
            <h1>Care provider supplier</h1>
            <p>ID: {{ $supplier['id'] }}</p>
            <p>Name: {{ $supplier['name'] }}</p>
            <p>Endpoint: {{ $supplier['endpoint'] }}</p>
            <p>Created at: {{ $supplier['created_at'] }}</p>
            <p>Modified at: {{ $supplier['modified_at'] }}</p>
            <div class="action-buttons">
                <a href="{{ route('suppliers.edit', $supplier['id']) }}" class="button">Edit</a>
                <a href="{{ route('suppliers.destroy', $supplier['id']) }}" class="button">Delete</a>
                <a href="{{ route('resource.mapper', ['id' => $supplier['id']]) }}" class="button">Show Mapper</a>
                <a href="{{ route('consumer.update', ['id' => $supplier['id']]) }}" class="button">Update consumer</a>
            </div>
        </div>
    </section>
@endsection
