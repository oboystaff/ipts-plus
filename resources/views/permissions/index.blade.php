@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div class="card-header">
                            <div class="card-title">Permissions Management / All Permissions</div>
                        </div>

                        <div class="d-flex align-items-center">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm ms-2">+ Create Role</a>
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

                    <div class="card-body px-0">
                        <div class="table-responsive active-projects user-tbl  dt-filter">
                            <table id="file-export" class="table table-bordered text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Date Created</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $index => $role)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('permissions.edit', $role) }}"
                                                    class="btn btn-sm btn-primary">Assign Privilages</a>

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
    </div>
@endsection
