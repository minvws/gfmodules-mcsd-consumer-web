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
        <!-- Show $response in div -->
        <div>
            @if (isset($response['error']))
                <p>{{ $response['error'] }}</p>
            @else
                {{ var_export($response, true) }}
            @endif
        </div>
    </section>
@endsection
