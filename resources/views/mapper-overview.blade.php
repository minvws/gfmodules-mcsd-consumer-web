@extends('layouts.guest')
@section('content')
@if (isset($errors))
<section>
<div class="error" aria-label="{{__('Error') }}">
    <ul>
        <li>{{ $errors }}</li>
    </ul>
</div>
</section>
@else
<x-success-notification class="custom-class" />
<x-mapper :headers="$mapperData['headers']" :rows="$mapperData['rows']" />
@endif
@endsection
