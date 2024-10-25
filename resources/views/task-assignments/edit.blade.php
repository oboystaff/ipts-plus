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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('task-assignments.update', $taskAssignment) }}">
                                @csrf

                                <input type="hidden" name="assembly_code" value="{{ $assemblyData['assemblyCode'] }}">
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
                                            value="{{ $assemblyData['assembly'] }}" readonly>

                                        @error('assembly')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label for="block_data" class="form-label">Block</label>
                                        <select multiple
                                            class="default-select form-control wide @error('block_data') is-invalid @enderror"
                                            id="block_data" name="block_data[]" required>
                                            @foreach ($blockss as $block)
                                                <option value="{{ $block->id }}"
                                                    @if (collect($taskAssignment->block_data ?? [])->contains('block_id', $block->id)) selected @endif>
                                                    {{ $block->block_name }}</option>
                                            @endforeach
                                        </select>

                                        @error('block_data')
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
                                                <option value="{{ $agent->id }}"
                                                    {{ old('agent_id', $taskAssignment->agent_id) == $agent->id ? 'selected' : '' }}>
                                                    {{ $agent->name }}</option>
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

                                @if (!empty($taskAssignment->block_data))
                                    <div class="alert alert-warning alert-dismissible fade show" style="margin-top:30px">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                            stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="me-2">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                        </svg>
                                        <strong>AGENT ASSIGNED BLOCKS DETAILS</strong>
                                    </div>

                                    <div class="tab-content" id="myTabContent-3">
                                        <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel"
                                            aria-labelledby="home-tab-3">
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table id="example4" class="display table" style="width: 100%">
                                                        <thead>
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Block Code</th>
                                                                <th>Block Name</th>
                                                                <th>Assembly</th>
                                                                <th>Task</th>
                                                                <th>Status</th>
                                                                <th>Assigned By</th>
                                                                <th>Created Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($blocks as $index => $block)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $block->block_code }}</td>
                                                                    <td>{{ $block->block_name }}</td>
                                                                    <td>{{ $block->assembly }}</td>
                                                                    <td>{{ $block->task }}</td>
                                                                    <td>{{ $block->status }}</td>
                                                                    <td>{{ $block->created_by }}</td>
                                                                    <td>{{ $block->created_at }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
