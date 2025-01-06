@extends('layouts.guest')

@section('content')
    <section class="layout-authentication">
        <div>
            <div class="error" role="group" aria-label="{{__('Error') }}">
                <span>@lang('Error')</span>
                <h1>
                @if(isset($error))
                    {{ $error }}
                @else
                    @lang('Error')
                @endif
                <br>
                @if(isset($code))
                    {{ $code }}
                @else
                    @lang('403')
                @endif
                </h1>
                <p>
                @if(isset($message))
                    {{ $message }}
                @else
                    @lang('An error occured')
                @endif
                </p>
            </div>
        </div>
    </section>
@endsection
