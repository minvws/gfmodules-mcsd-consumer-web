@extends('layouts.app')
@section('content')
    <section>
        <div>
            @if ($errors->any())
                <x-validation-errors class="custom-error-class" />
            @endif
            <h1>Create Supplier</h1>
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" required>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="endpoint">Endpoint url:</label>
                <input type="text" id="endpoint" name="endpoint" required>
                <button type="submit" class="button">Create</button>
            </form>
        </div>
    </section>
@endsection
