@extends('layouts.guest')
@section('content')
    <section>
        <div>
            @if ($errors->any())
                <x-validation-errors class="custom-error-class" />
            @endif
            <h1>This is the index page</h1>
            <p>Index page works</p>
            <a href="{{ route('consumer.update') }}" class="button">Update consumer</a>
        </div>
    </section>
@endsection
