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
                            <h4 class="card-title">Edit Assembly Block</h4>
                        </div>

                        <div>
                            <a href="{{ route('blocks.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('blocks.update', $block) }}">
                            @csrf

                            <input type="hidden" name="division_url" url="{{ route('ajax.division') }}">

                            <div class="col-md-6 mb-3">
                                <label for="block_code">Block Code</label>
                                <input type="text" class="form-control @error('block_code') is-invalid @enderror"
                                    id="block_code" name="block_code" placeholder="Enter block code"
                                    value="{{ $block->block_code }}" required>

                                @error('block_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_name">Block Name</label>
                                <input type="text" class="form-control @error('block_name') is-invalid @enderror"
                                    id="block_name" name="block_name" placeholder="Enter block name"
                                    value="{{ $block->block_name }}" required>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="assembly_code">Assembly Code</label>
                                <select class="form-control @error('assembly_code') is-invalid @enderror" id="assembly_code"
                                    name="assembly_code" required>
                                    @foreach ($assemblies as $assembly)
                                        <option value="{{ $assembly->assembly_code }}"
                                            {{ old('assembly_code', $block->assembly_code) == $assembly->assembly_code ? 'selected' : '' }}>
                                            {{ $assembly->name }}
                                            ({{ $assembly->assembly_code }})
                                        </option>
                                    @endforeach
                                </select>

                                @error('assembly_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="division_name">Division Name</label>
                                <select class="form-control @error('division_code') is-invalid @enderror" id="division_name"
                                    name="division_code" required>
                                    <option disabled selected>Select Division Name</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ old('division_code', $block->division_code) == $division->id ? 'selected' : '' }}>
                                            {{ $division->division_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('division_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value="Active"
                                        {{ old('status', $division->status) == 'Active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="InActive"
                                        {{ old('status', $division->status) == 'InActive' ? 'selected' : '' }}>In Active
                                    </option>
                                </select>

                                @error('status')
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
    <script src="{{ asset('assets/js/general/app.js') }}"></script>
@endsection
