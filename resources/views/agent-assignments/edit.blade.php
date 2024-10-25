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
                            <h4 class="card-title">Edit Agent Assignment</h4>
                        </div>

                        <div>
                            <a href="{{ route('agent-assignments.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('agent-assignments.update', $agentAssignment) }}">
                            @csrf

                            <div class="col-md-6 mb-3">
                                <label for="assembly">Assembly</label>
                                <input type="text" class="form-control @error('assembly') is-invalid @enderror"
                                    id="assembly" placeholder="Enter division name" name="assembly"
                                    value="{{ $agentAssignment->assembly->name ?? '' }}" readonly>

                                @error('assembly')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="supervisor_id">Supervisor Name</label>
                                <select class="form-control @error('supervisor_id') is-invalid @enderror"
                                    name="supervisor_id">
                                    <option disabled selected>Select Supervisor</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}"
                                            {{ old('supervisor_id', $agentAssignment->supervisor_id) == $supervisor->id ? 'selected' : '' }}>
                                            {{ $supervisor->name }}</option>
                                    @endforeach
                                </select>

                                @error('supervisor_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="agent_id">Agent Name</label>
                                <input type="text" class="form-control @error('agent_id') is-invalid @enderror"
                                    id="agent_id" name="agent_id" placeholder="Enter block name"
                                    value="{{ $agentAssignment->agent->name ?? '' }}" readonly>

                                @error('agent_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="division_name">Assigned Date</label>
                                <input type="text" class="form-control @error('division_code') is-invalid @enderror"
                                    id="division_code" placeholder="Enter division code" name="division_code"
                                    value="{{ $agentAssignment->created_at }}" readonly>

                                @error('division_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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
