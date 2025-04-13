@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="card">

                <!-- HEADER SECTION -->
                <div class="card-body border-bottom pb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h4 class="fw-bold text-primary mb-1">
                                <i class="ri-user-settings-line me-2"></i> Rate Payer Type Management
                            </h4>

                            <p class="mb-0 text-muted fs-14">
                                You are Viewing all Rate Payer Types / Categories from your
                                central database repository.
                            </p>

                        </div>
                        @can('customer-types.create')
                            <a href="{{ route('customer-types.create') }}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-plus me-1"></i>
                                Create New
                            </a>
                        @endcan


                    </div>
                </div>
            </div>


            @if (session()->has('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>{{ session('status') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                                class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
            @endif


            <div class="card">


                <div class="card-body px-0">
                    <div class="table-responsive active-projects user-tbl  dt-filter">
                        <table id="empoloyees-tbl" class="table">
                            <table id="file-export" class="table table-bordered text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Date Created</th>
                                        <th> Interval Analysis</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customerTypes as $index => $customerType)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $customerType->name }}</td>
                                            <td>
                                                @if ($customerType->status === 'Active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">In-Active</span>
                                                @endif
                                            </td>
                                            <td>{{ $customerType->createdBy->name ?? '' }}</td>
                                            <td>{{ $customerType->created_at }}</td>
                                            <td>
                                                @php
                                                    $createdAt = $customerType->created_at;
                                                    $formattedDate = $createdAt->format('M d, Y');
                                                    $timeAgo = $createdAt->diffForHumans();
                                                    $daysAgo = $createdAt->diffInDays();
                                                @endphp

                                                @if ($daysAgo >= 365)
                                                    <span class="badge bg-secondary">{{ $timeAgo }}</span>
                                                    <div class="progress progress-xs progress-animate" role="progressbar"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-secondary" style="width: 100%">
                                                        </div>
                                                    </div>
                                                @elseif($daysAgo >= 30)
                                                    <span class="badge bg-primary">{{ $timeAgo }}</span>
                                                    <div class="progress progress-xs progress-animate" role="progressbar"
                                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-primary" style="width: 75%"></div>
                                                    </div>
                                                @elseif($daysAgo >= 7)
                                                    <span class="badge bg-danger">{{ $timeAgo }}</span>
                                                    <div class="progress progress-xs progress-animate" role="progressbar"
                                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-danger" style="width: 50%"></div>
                                                    </div>
                                                @elseif($daysAgo >= 1)
                                                    <span class="badge bg-success">{{ $timeAgo }}</span>
                                                    <div class="progress progress-xs progress-animate" role="progressbar"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-success" style="width: 25%"></div>
                                                    </div>
                                                @else
                                                    <span class="badge bg-success">Today</span>
                                                    <div class="progress progress-xs progress-animate" role="progressbar"
                                                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-success" style="width: 10%"></div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <div class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path
                                                                d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path
                                                                d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <div class="py-2">
                                                            <a class="dropdown-item"
                                                                href=" {{ route('customer-types.show', $customerType->id) }}">View
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href=" {{ route('customer-types.edit', $customerType->id) }}">Edit
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-scripts')
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
@endsection
