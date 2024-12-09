@extends('layouts.app')
@section('content')
    <section>
        <div>
            @if ($errors->any())
                <x-validation-errors class="custom-error-class" />
            @endif
            <h1>Edit Supplier</h1>
            <form action="{{ route('suppliers.update', $supplier['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" value="{{ $supplier['id'] }}" readonly required style="background-color: #d3d3d3;">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $supplier['name'] }}" required>
                <label for="endpoint">Endpoint url:</label>
                <input type="text" id="endpoint" name="endpoint" value="{{ $supplier['endpoint'] }}" required>
                <button type="submit" class="button">Update</button>
            </form>
        </div>
    </section>
@endsection
