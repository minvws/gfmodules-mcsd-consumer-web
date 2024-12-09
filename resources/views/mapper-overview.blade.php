@extends('layouts.guest')

@section('content')
    <section>
        <div>
            @if (isset($responseData['error']))
            <div class="error" aria-label="{{__('Error') }}">
                <ul>
                    <li>{{ $responseData['error'] }}</li>
                </ul>
            </div>
            @else
                <x-mapper :columns="$responseData['columns']" :rows="$responseData['rows']" />
            @endif
        </div>
    </section>

    


@endsection
