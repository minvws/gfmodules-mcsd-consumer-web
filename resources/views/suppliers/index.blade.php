@extends('layouts.app')

@section('content')
    @if (session()->has('error'))
        <section role="alert" class="error no-print" aria-label="{{ __('error') }}">
            <div>
                <h4>{{ session('error') }}</h4>
                <p>{{ session('error_description') }}</p>
            </div>
        </section>
    @endif
    <section>
        <div>
        <h1>Suppliers</h1>
        <a href="{{ route('suppliers.create') }}" class="button">Create New Supplier</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Endpoint</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier['id'] }}</td>
                        <td>{{ $supplier['name'] }}</td>
                        <td>{{ $supplier['endpoint'] }}</td>
                        <td>
                            <div>
                                <a href="{{ route('suppliers.show', $supplier['id']) }}" class="button">View</a>
                                <a href="{{ route('suppliers.edit', $supplier['id']) }}" class="button">Edit</a>
                                <a href="{{ route('suppliers.destroy', $supplier['id']) }}" class="button">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </section>
@endsection
