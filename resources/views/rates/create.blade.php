@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Create Property Rate</h4>
                        </div>

                        <div>
                            <a href="{{ route('rates.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('rates.store') }}">
                            @csrf

                            <input type="hidden" name="property_use_url" url="{{ route('rates.property-use') }}">

                            <div class="col-sm-6 mb-3">
                                <label for="assembly_code" class="form-label">Assembly Code</label>
                                <select class="form-control @error('assembly_code') is-invalid @enderror" id="assembly_code"
                                    name="assembly_code" required>
                                    <option disabled selected>Select Assembly</option>
                                    @foreach ($assemblies as $assembly)
                                        <option value="{{ $assembly->assembly_code }}">{{ $assembly->name }}</option>
                                    @endforeach
                                </select>

                                @error('assembly_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="zone_id" class="form-label">Zone</label>
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

                            <div class="col-md-6 mb-3">
                                <label for="block_code">Property Rate</label>
                                <input type="text" class="form-control @error('rate') is-invalid @enderror"
                                    id="rate" name="rate" placeholder="Property rate" required>

                                @error('rate')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_code">Property Minimum Rate</label>
                                <input type="text" class="form-control @error('minimum_rate') is-invalid @enderror"
                                    id="minimum_rate" name="minimum_rate" placeholder="Property minimum rate" required>

                                @error('minimum_rate')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Save</button>
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
