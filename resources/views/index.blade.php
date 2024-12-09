@extends('layouts.guest')
@section('content')
    <section>
        <div>
            @if ($errors->any())
                <x-validation-errors class="custom-error-class" />
            @endif
            <h1>This is the index page</h1>
            <p>Index page works</p>
        <form action="{{ route('consumer.update') }}" method="POST">
            @csrf
            <div>
                <label for="supplier ID">Supplier ID:</label>
                <input type="text" id="id" name="id" required>
            </div>
            <div>
                <button type="submit" class="button">Update consumer</button>
            </div>
        </form>
        </div>
    </section>
@endsection
