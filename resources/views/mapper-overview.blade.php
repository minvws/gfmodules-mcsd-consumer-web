@extends('layouts.guest')
@section('content')
@if (isset($error['error']))
<section>
<div class="error" aria-label="{{__('Error') }}">
    <ul>
        <li>{{ $error['error'] }}</li>
    </ul>
</div>
</section>
@else
<x-mapper :headers="$mapperData['headers']" :rows="$mapperData['rows']" />
@endif
@endsection
