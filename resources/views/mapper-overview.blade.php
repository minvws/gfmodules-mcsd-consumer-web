@extends('layouts.guest')
@section('content')
@if (isset($responseData['error']))
<section>
<div class="error" aria-label="{{__('Error') }}">
    <ul>
        <li>{{ $responseData['error'] }}</li>
    </ul>
</div>
</section>
@else
<x-mapper :headers="$responseData['headers']" :rows="$responseData['rows']" />
@endif
@endsection
