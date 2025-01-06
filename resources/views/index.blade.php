@extends('layouts.guest')
@section('content')
<section>
    <div>
        <x-validation-errors class="custom-error-class" />
        <h1>This is the index page</h1>
        <p>Index page works</p>
        <form action="{{ route('consumer.update') }}" method="GET">
            @csrf
            <div>
            <label for="supplier_id">Choose Supplier from this list. When left empty, all suppliers will be updated:</label>
            <select name="supplier_id" id="supplier_id">
                <option value="">Update all</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier['id'] }}">{{ $supplier['name'] }}</option>
                @endforeach
            </select>

            </div>
            <div>
                <label for="Since">Since:</label>
                <input type="datetime-local" id="since" name="since">
            </div>
            <div>
                <button type="submit" class="button">Update consumer</button>
            </div>
        </form>
    </div>
</section>
@endsection
