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
                            <div class="card-title">Property Management / View Assembly Property</div>
                        </div>

                        <div>
                            <a href="{{ route('dashboard.myproperties') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('properties.update', $property) }}">
                            @csrf

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="entity_type">Entity Type</label>
                                    <input type="text" class="form-control @error('entity_type') is-invalid @enderror"
                                        id="entity_type" name="entity_type" placeholder="Digital address"
                                        value="{{ $property->entityType->name ?? '' }}" readonly>

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
                                        id="digital_address" name="digital_address" placeholder="Digital address"
                                        value="{{ $property->digital_address }}" readonly>

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
                                        id="location" name="location" placeholder="Location"
                                        value="{{ $property->location }}" readonly>

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
                                        placeholder="Street name" value="{{ $property->street_name }}" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="rated">Rated</label>
                                    <input type="text" class="form-control" id="rated" name="rated"
                                        placeholder="Street name" value="{{ $property->rated }}" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="validated">Validated</label>
                                    <input type="text" class="form-control" id="validated" name="validated"
                                        placeholder="Street name" value="{{ $property->validated }}" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="entity_type">Associate Owner</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    placeholder="Street name"
                                    value="{{ $property->customer->first_name ?? '' }} {{ $property->customer->last_name ?? '' }}"
                                    readonly>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="ratable_value">Ratable Value</label>
                                    <input type="text" class="form-control" id="ratable_value" name="ratable_value"
                                        placeholder="Ratable value" value="{{ $property->ratable_value }}" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                        placeholder="Longitude" value="{{ $property->longitude }}" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="Latitude" value="{{ $property->latitude }}" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="latitude">Property Number</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="Latitude" value="{{ $property->property_number }}" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="latitude">Division</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="Latitude" value="{{ $property->division->division_name ?? 'N/A' }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="latitude">Block</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="Latitude" value="{{ $property->block->block_name ?? 'N/A' }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="latitude">Zone</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="Latitude" value="{{ $property->zone->name ?? 'N/A' }}" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="latitude">Property Use</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="Latitude" value="{{ $property->propertyUse->name ?? 'N/A' }}"
                                        readonly>
                                </div>
                            </div>

                            <!-- Add Assembly field here -->
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="assembly">Assembly Property</label>
                                    <input type="text" class="form-control" id="assembly_code" name="assembly_code"
                                        placeholder="Assembly_code" value="{{ $property->assembly->name ?? '' }}"
                                        readonly>

                                    @error('assembly_code')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
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
@endsection
