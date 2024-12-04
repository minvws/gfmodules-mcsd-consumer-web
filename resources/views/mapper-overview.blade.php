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
            @if (isset($responseData['error']))
                <p>{{ $responseData['error'] }}</p>
            @else
                <x-mapper :columns="$responseData['columns']" :rows="$responseData['rows']" />
            @endif
        </div>
    </section>

    


@endsection
