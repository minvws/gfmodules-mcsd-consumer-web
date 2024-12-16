@extends('layouts.guest')
@section('content')
<section>
    <div>
        <x-validation-errors class="custom-error-class" />
        <h1>This is the index page</h1>
        <p>Index page works</p>
        <form action="{{ route('consumer.update') }}" method="POST">
            @csrf
            <div>
                <label for="supplier ID">Supplier ID:</label>
                <input type="text" id="id" name="id">
            </div>
            <!-- <div>
                    <label for="resourceType">Resource Type:</label>
                    <select id="resourceType" name="resourceType">
                        <option value=""></option>
                        <option value="Organization">Organization</option>
                        <option value="Location">Location</option>
                        <option value="Practitioner">Practitioner</option>
                        <option value="PractitionerRole">PractitionerRole</option>
                        <option value="HealthcareService">HealthcareService</option>
                        <option value="Endpoint">Endpoint</option>
                        <option value="OrganizationAffiliation">OrganizationAffiliation</option>
                    </select>
                </div> -->
            <div>
                <label for="Since">Since:</label>
                <input type="datetime-local" id="since" name="since">
            </div>
            <div>
                <button type="submit" class="button">Update consumer</button>
            </div>
        </form>
    </div>
</section>
@endsection