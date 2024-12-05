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
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier['URA number'] }}</td>
                        <td>{{ $supplier['Care provider name'] }}</td>
                        <td>{{ $supplier['Endpoint'] }}</td>
                        <td>{{ $supplier['created_at'] }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('suppliers.show', $supplier['URA number']) }}" class="button">View</a>
                                <a href="{{ route('suppliers.edit', $supplier['URA number']) }}" class="button">Edit</a>
                                <a href="{{ route('suppliers.destroy', $supplier['URA number']) }}" class="button">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </section>
@endsection
