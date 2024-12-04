@if(config('app.env') === "production")
<a href="/" class="ro-logo" aria-label="{{__('Rijksoverheid logo, go to the homepage')}}">
    <img src="{{ asset('img/ro-logo.svg') }}" alt="Logo Rijksoverheid">Rijksoverheid
</a>
@else
<a href="/" class="ro-logo" aria-label="{{__('Rijksoverheid logo, go to the homepage')}}">
    <img src="{{ asset('img/fhir-logo.png') }}" alt="Logo Rijksoverheid">Mega Cool Service Discovery
</a>
@endif
