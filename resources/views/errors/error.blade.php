@extends('layouts.guest')

@section('content')
    <section class="layout-authentication">
        <div>
            <div class="error" role="group" aria-label="{{__('Error') }}">
                <span>@lang('Error')</span>
                <h1>
                    @lang('Error')
                    @lang(403)
                </h1>
                <p>This is an error message</p>
            </div>
        </div>
    </section>
@endsection
