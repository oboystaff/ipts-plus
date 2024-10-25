@extends('layout.base')

@section('page-styles')
    <link href="{{ asset('assets/css/bootstrap-duallistbox.css') }}" rel="stylesheet">
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="col-lg-6 col-lg-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">View Task Assignment</h4>
                        </div>

                        <div>
                            <a href="{{ route('task-assignments.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('task-assignments.store') }}">
                                @csrf

                                <input type="hidden" name="assembly_code" value="{{ $data['assemblyCode'] }}">
                                <input type="hidden" name="supervisor_id" value="{{ $supervisor->id }}">

                                <div class="row">

                                    <div class="mb-4 col-md-6">
                                        <label class="form-label">Supervisor</label>
                                        <input type="text" class="form-control @error('supervisor') is-invalid @enderror"
                                            id="supervisor" name="supervisor" placeholder="Supervisor"
                                            value="{{ $supervisor->name }}" readonly>

                                        @error('supervisor')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label for="assembly_code" class="form-label">Assembly</label>
                                        <input type="text" class="form-control @error('assembly') is-invalid @enderror"
                                            id="assembly" name="assembly" placeholder="Assembly"
                                            value="{{ $data['assembly'] }}" readonly>

                                        @error('assembly')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label for="agent_id" class="form-label">Agent</label>
                                        <select class="form-control @error('agent_id') is-invalid @enderror"
                                            name="agent_id">
                                            <option value="">Select Agent</option>
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('agent_id')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label for="task" class="form-label">Task</label>
                                        <select class="form-control @error('task') is-invalid @enderror" name="task">
                                            <option value="">Select Task</option>
                                            <option value="Payment"
                                                {{ $taskAssignment->task == 'Payment' ? 'selected' : '' }}>
                                                Payment
                                            </option>
                                            <option value="Data Collection"
                                                {{ $taskAssignment->task == 'Data Collection' ? 'selected' : '' }}>Data
                                                Collection
                                            </option>
                                        </select>

                                        @error('task')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
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
    </div>
@endsection

@section('page-scripts')
@endsection
