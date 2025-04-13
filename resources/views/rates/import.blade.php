@extends('layout.base')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/lightgallery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fileinput.min.css') }}">
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="card">
            <!-- HEADER SECTION -->
            <div class="card-body border-bottom pb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h4 class="fw-bold text-primary mb-1">
                            <i class="ri-money-dollar-circle-line me-2"></i> Rates Settings
                        </h4>

                        <p class="mb-0 text-muted fs-14">
                            You are Importing Rates Settings Record To your
                            central database repository.
                        </p>
                    </div>
                    @can('rates.create')
                        <a href="{{ route('rates.index') }}" class="btn btn-sm btn-primary">
                            <i class="ri-arrow-go-back-line"></i> Back
                        </a>
                        <a href="{{ route('rates.downloadTemplate') }}" class="btn btn-sm btn-primary">
                            <i class="ri-file-download-line me-1"></i> Download Rates Sample
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">



                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('rates.importData') }}"
                            enctype="multipart/form-data">
                            @csrf

                            @if (session()->has('status'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <strong>{{ session('status') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span><i class="fa-solid fa-xmark"></i></span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-md-12 mb-3">
                                <label for="first_name" class="mb-3">Upload Property Rate Excel File</label>
                                <input class="file" id="file" name="file" type="file" data-show-upload="false"
                                    data-theme="fa" data-max-file-count="" data-max-total-file-count=""
                                    data-initial-preview-as-data="true" , data-initial-preview=""
                                    data-initial-preview-config="" data-required="false" data-overwrite-initial="false"
                                    data-max-file-size="15000" data-browse-label="Browse"
                                    data-browse-icon="<i class='fa fa-folder-open'></i>" />

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Import Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/lightgallery-all.min.js') }}"></script>
@endsection
