@extends('layouts.app')

@section('content')
<section>
    <div>
        <x-validation-errors class="custom-error-class" />
        <h1>Consumer</h1>
        <p>View consumer resources</p>
        <form action="{{ route('consumer.getResource') }}" method="get">
            @csrf
            <label for="resourceType">Resource type:</label>
            <select id="resourceType" name="resourceType" required>
                <option value="Endpoint">Endpoint</option>
                <option value="Organization">Organization</option>
                <option value="OrganizationAffiliation">OrganizationAffiliation</option>
                <option value="Location">Location</option>
                <option value="Practitioner">Practitioner</option>
                <option value="PractitionerRole">PractitionerRole</option>
                <option value="HealthcareService">HealthcareService</option>
            </select>
            <label for="resourceId">ID:</label>
            <input type="text" id="resourceId" name="resourceId" required>
            <button type="submit">Get resource</button>
        </form>
    </div>
</section>
@endsection
