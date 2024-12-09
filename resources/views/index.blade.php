@extends('layouts.guest')

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
            <h1>This is the index page</h1>
            <p>Index page works</p>
            <a href="{{ route('consumer.update') }}" class="button">Update consumer</a>
        </div>
    </section>
@endsection
