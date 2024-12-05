@extends('layouts.app')

@section('content')
    <section>
        <div>
            <h1>Create Supplier</h1>
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                <label for="ura_number">URA Number:</label>
                <input type="text" id="ura_number" name="ura_number" required>
                <label for="care_provider_name">Care Provider Name:</label>
                <input type="text" id="care_provider_name" name="care_provider_name" required>
                <label for="endpoint">Endpoint:</label>
                <input type="text" id="endpoint" name="endpoint" required>
                <button type="submit" class="button">Create</button>
            </form>
        </div>
    </section>
@endsection
