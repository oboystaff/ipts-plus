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
                            <h4 class="card-title">View Assembly Block</h4>
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
                                    value="{{ $block->block_code }}" readonly>

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
                                    value="{{ $block->block_name }}" readonly>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="assembly_code">Assembly Code</label>
                                <input type="text" class="form-control @error('assembly_code') is-invalid @enderror"
                                    id="assembly_code" placeholder="Enter division name" name="assembly_code"
                                    value="{{ $block->assembly->name ?? '' }} ({{ $block->assembly_code }})" readonly>

                                @error('assembly_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="division_name">Division Name</label>
                                <input type="text" class="form-control @error('division_code') is-invalid @enderror"
                                    id="division_code" placeholder="Enter division code" name="division_code"
                                    value="{{ $block->division->division_name ?? '' }}" readonly>

                                @error('division_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    id="status" placeholder="Enter status" name="status" value="{{ $block->status }}"
                                    readonly>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
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
