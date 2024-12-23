@extends('layouts.guest')
@section('content')
@if (isset($errors))
<x-validation-errors class="custom-error-class" />
@else
<x-success-notification class="custom-class" />
<x-mapper :headers="$mapperData['headers']" :rows="$mapperData['rows']" />
@endif
@endsection
