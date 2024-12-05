@extends('layouts.app')

@section('content')
    <section>
        <div>
            <h1>Edit Supplier</h1>
            <form action="{{ route('suppliers.update', $supplier['URA number']) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="ura_number">URA Number:</label>
                <input type="text" id="ura_number" name="ura_number" value="{{ $supplier['URA number'] }}" required>
                <label for="care_provider_name">Care Provider Name:</label>
                <input type="text" id="care_provider_name" name="care_provider_name" value="{{ $supplier['Care provider name'] }}" required>
                <label for="endpoint">Endpoint:</label>
                <input type="text" id="endpoint" name="endpoint" value="{{ $supplier['Endpoint'] }}" required>
                <button type="submit" class="button">Update</button>
            </form>
        </div>
    </section>
@endsection
