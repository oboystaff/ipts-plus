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
                            <h4 class="card-title">Create Assembly Customer</h4>
                        </div>

                        <div>
                            <a href="{{ route('citizens.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>


                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('citizens.store') }}">
                            @csrf

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
                                    </button>
                                </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" placeholder="First Name">

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" placeholder="Last Name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="other_name">Other Name</label>
                                <input type="text" class="form-control" name="other_name" placeholder="Other Name">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth" placeholder="Date of Birth">

                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="marital_status">Marital Status</label>
                                <select name="marital_status"
                                    class="form-control @error('marital_status') is-invalid @enderror">
                                    <option disabled selected>Select Marital Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>

                                @error('marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nia_number">NIA Number</label>
                                <input type="text" class="form-control @error('nia_number') is-invalid @enderror"
                                    name="nia_number" placeholder="NIA Number">

                                @error('nia_number')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telephone_number">Telephone Number</label>
                                <input type="text" class="form-control @error('telephone_number') is-invalid @enderror"
                                    name="telephone_number" placeholder="Telephone Number">

                                @error('telephone_number')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="country_of_citizenship">Country of Citizenship</label>
                                <select name="country_of_citizenship"
                                    class="form-control @error('country_of_citizenship') is-invalid @enderror">
                                    <option disabled selected>Select Country of Citizenship</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Togo">Togo</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Mali">Mali</option>
                                </select>

                                @error('country_of_citizenship')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="customer_type">Customer Type</label>
                                <select name="customer_type"
                                    class="form-control @error('customer_type') is-invalid @enderror">
                                    <option disabled selected>Select Customer Type</option>
                                    @foreach ($customerTypes as $customerType)
                                        <option value="{{ $customerType->id }}">{{ $customerType->name }}</option>
                                    @endforeach
                                </select>

                                @error('customer_type')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="ghana_card_number">Ghana Card Number</label>
                                <input type="text"
                                    class="form-control @error('Ghana_card_number') is-invalid @enderror"
                                    name="Ghana_card_number" placeholder="Ghana Card Number">

                                @error('Ghana_card_number')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option disabled selected>Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="In Active">In Active</option>
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
@endsection
