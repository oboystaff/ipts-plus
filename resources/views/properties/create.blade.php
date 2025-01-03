@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div class="card-header">
                            <div class="card-title">Property Management / Create Assembly Property</div>
                        </div>

                        <div>
                            <a href="{{ route('properties.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('properties.store') }}">
                            @csrf

                            <input type="hidden" name="property_use_url" url="{{ route('rates.property-use') }}">
                            <input type="hidden" name="division_url" url="{{ route('ajax.division') }}">
                            <input type="hidden" name="block_url" url="{{ route('ajax.block') }}">

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="entity_type">Entity Type</label>
                                    <select class="form-control @error('entity_type') is-invalid @enderror" id="entity_type"
                                        name="entity_type">
                                        <option disabled selected>Select Entity Type</option>
                                        @foreach ($businessClassTypes as $businessClassType)
                                            <option value="{{ $businessClassType->id }}">
                                                {{ $businessClassType->name }} -
                                                {{ $businessClassType->category }} - GHS
                                                {{ $businessClassType->rate }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('entity_type')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="digital_address">Digital Address</label>
                                    <input type="text"
                                        class="form-control @error('digital_address') is-invalid @enderror"
                                        id="digital_address" name="digital_address" placeholder="Digital address">

                                    @error('digital_address')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" placeholder="Location">

                                    @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="street_name">Street Name</label>
                                    <input type="text" class="form-control" id="street_name" name="street_name"
                                        placeholder="Street name">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="rated">Rated</label>
                                    <select class="form-control" id="rated" name="rated">
                                        <option disabled selected>Select If Rated</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="validated">Validated</label>
                                    <select class="form-control" id="validated" name="validated">
                                        <option disabled selected>Select If Validated</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="entity_type">Associate Owner</label>
                                <select class="form-control" id="customer_name" name="customer_name">
                                    <option disabled selected>Select Associate Owner</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->first_name }} - {{ $customer->nia_number }} -
                                            {{ $customer->account_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="ratable_value">Ratable Value</label>
                                    <input type="text" class="form-control" id="ratable_value" name="ratable_value"
                                        placeholder="Ratable value">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                        placeholder="Longitude">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="Latitude">
                                </div>
                            </div>

                            <!-- Add Assembly field here -->
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="assembly">Select An Assembly Where Property is
                                        Located</label>
                                    <select class="form-control @error('assembly_code') is-invalid @enderror"
                                        id="assembly" name="assembly_code">
                                        <option disabled selected>Select Assembly</option>
                                        @foreach ($districtAssemblies as $assembly)
                                            <option value="{{ $assembly->assembly_code }}">{{ $assembly->name }}
                                                Assembly
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('assembly_code')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="division_id" class="form-label">Property Division</label>
                                <select class="form-control @error('division_id') is-invalid @enderror" id="division_id"
                                    name="division_id" required>
                                    <option disabled selected>Select Division</option>
                                </select>

                                @error('division_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="block_id" class="form-label">Property Block</label>
                                <select class="form-control @error('block_id') is-invalid @enderror" id="block_id"
                                    name="block_id" required>
                                    <option disabled selected>Select Block</option>
                                </select>

                                @error('block_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="zone_id" class="form-label">Property Zone</label>
                                <select class="form-control @error('zone_id') is-invalid @enderror" id="zone_id"
                                    name="zone_id" required>
                                    <option disabled selected>Select Zone</option>
                                    @foreach ($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                    @endforeach
                                </select>

                                @error('zone_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="property_use_id" class="form-label">Property use</label>
                                <select class="form-control @error('property_use_id') is-invalid @enderror"
                                    id="property_use_id" name="property_use_id" required>
                                    <option disabled selected>Select Property Use</option>
                                </select>

                                @error('property_use_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/general.js?v1=1234') }}"></script>
@endsection
