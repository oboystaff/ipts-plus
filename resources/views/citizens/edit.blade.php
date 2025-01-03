@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div class="card-header">
                            <div class="card-title">Rate Payer Management /Edit Rate Payer's Information</div>
                        </div>

                        <div>
                            <a href="{{ route('citizens.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" action="{{ route('citizens.update', $citizen) }}"
                            method="POST">
                            @csrf

                            <div class="col-md-6 mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    id="first_name" name="first_name" value="{{ $citizen->first_name }}">

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name" value="{{ $citizen->last_name }}">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="other_name">Prefix</label>
                                <select name="prefix" class="form-control @error('prefix') is-invalid @enderror">
                                    <option disabled selected>Select Prefix</option>
                                    <option value="Mr" {{ $citizen->prefix == 'Mr' ? 'selected' : '' }}>Mr</option>
                                    <option value="Mrs" {{ $citizen->prefix == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                    <option value="Miss" {{ $citizen->prefix == 'Miss' ? 'selected' : '' }}>Miss</option>
                                    <option value="Dr" {{ $citizen->prefix == 'Dr' ? 'selected' : '' }}>Dr</option>
                                </select>

                                @error('prefix')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gender">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                                    name="gender">
                                    <option value="Male" {{ $citizen->gender == 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="Female" {{ $citizen->gender == 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    id="date_of_birth" name="date_of_birth" value="{{ $citizen->date_of_birth }}">

                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="marital_status">Marital Status</label>
                                <select class="form-control @error('marital_status') is-invalid @enderror"
                                    id="marital_status" name="marital_status">
                                    <option value="Single" {{ $citizen->marital_status == 'Single' ? 'selected' : '' }}>
                                        Single</option>
                                    <option value="Married" {{ $citizen->marital_status == 'Married' ? 'selected' : '' }}>
                                        Married
                                    </option>
                                    <option value="Divorced"
                                        {{ $citizen->marital_status == 'Divorced' ? 'selected' : '' }}>Divorced
                                    </option>
                                    <option value="Widowed" {{ $citizen->marital_status == 'Widowed' ? 'selected' : '' }}>
                                        Widowed
                                    </option>
                                </select>

                                @error('marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telephone_number">Telephone Number</label>
                                <input type="text" class="form-control @error('telephone_number') is-invalid @enderror"
                                    id="telephone_number" name="telephone_number" value="{{ $citizen->telephone_number }}">

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
                                    <option value="Ghana"
                                        {{ $citizen->country_of_citizenship == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                    <option value="Nigeria"
                                        {{ $citizen->country_of_citizenship == 'Nigeria' ? 'selected' : '' }}>Nigeria
                                    </option>
                                    <option value="Togo"
                                        {{ $citizen->country_of_citizenship == 'Togo' ? 'selected' : '' }}>Togo</option>
                                    <option value="South Africa"
                                        {{ $citizen->country_of_citizenship == 'South Africa' ? 'selected' : '' }}>South
                                        Africa
                                    </option>
                                    <option value="Burkina Faso"
                                        {{ $citizen->country_of_citizenship == 'Burkina Faso' ? 'selected' : '' }}>Burkina
                                        Faso
                                    </option>
                                    <option value="Mali"
                                        {{ $citizen->country_of_citizenship == 'Mali' ? 'selected' : '' }}>Mali</option>
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
                                        <option value="{{ $customerType->id }}"
                                            {{ old('customer_type', $citizen->customer_type) == $customerType->id ? 'selected' : '' }}>
                                            {{ $customerType->name }}</option>
                                    @endforeach
                                </select>

                                @error('customer_type')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Ghana_card_number">Ghana Card Number</label>
                                <input type="text" class="form-control" id="Ghana_card_number"
                                    name="Ghana_card_number" value="{{ $citizen->Ghana_card_number }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control" id="account_number" name="account_number"
                                    value="{{ $citizen->account_number }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option disabled selected>Select Status</option>
                                    <option value="Active" {{ $citizen->status == 'Active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="InActive" {{ $citizen->status == 'InActive' ? 'selected' : '' }}>
                                        In Active</option>
                                </select>

                                @error('status')
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
