<html lang="en" dir="ltr" data-nav-layout="horizontal" data-nav-style="menu-click" data-menu-position="fixed"
    data-theme-mode="light">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IPTS-Level 10 </title>
    <meta name="Description" content="Level 10">
    <meta name="Author" content="Level 10">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- SwiperJS Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <script>
        if (localStorage.rixzodarktheme) {
            document.querySelector("html").setAttribute("data-theme-mode", "dark")
        }
        if (localStorage.rixzortl) {
            document.querySelector("html").setAttribute("dir", "rtl")
            document.querySelector("#style")?.setAttribute("href",
                "{{ asset('assets/libs/bootstrap/css/bootstrap.rtl.min.css') }}");
        }
    </script>


</head>

<body>


    <div class="row authentication authentication-cover-main mx-0">
        <div class="col-xxl-5 col-xl-7">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-7 col-xl-9 col-lg-6 col-md-6 col-sm-8 col-12">
                    <div class="card custom-card my-auto border authentication-cover-right">
                        <div class="card-body p-4">
                            <div
                                class="text-center mb-4 bg-primary-transparent rounded border border-primary border-opacity-10 pt-2 position-relative overflow-hidden">
                                <i class="ri-lock-2-line position-absolute lock-icon-auth"></i>
                                <img src="{{ asset('assets/images/level10.png') }}" alt=""
                                    class="img-fluid ms-4">
                            </div>
                            <form action="{{ route('citizens.frontstore') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            name="first_name" placeholder="First Name">

                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <input type="text"
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            name="last_name" placeholder="Last Name">

                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <select name="prefix"
                                            class="form-control @error('prefix') is-invalid @enderror">
                                            <option disabled selected>Select Prefix</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Dr">Dr</option>
                                        </select>

                                        @error('prefix')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <select name="gender"
                                            class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <input type="date"
                                            class="form-control @error('date_of_birth') is-invalid @enderror"
                                            name="date_of_birth" placeholder="Date of Birth">

                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <select name="marital_status"
                                            class="form-control @error('marital_status') is-invalid @enderror">
                                            <option value="">Marital Status</option>
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
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <input type="text"
                                            class="form-control @error('telephone_number') is-invalid @enderror"
                                            name="telephone_number" placeholder="Telephone Number">

                                        @error('telephone_number')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mt-2 mt-sm-0">
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
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <select name="customer_type"
                                            class="form-control @error('customer_type') is-invalid @enderror">
                                            <option value="">Select Customer Type</option>
                                            @foreach ($customerTypes as $customerType)
                                                <option value="{{ $customerType->id }}">
                                                    {{ $customerType->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('customer_type')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text"
                                            class="form-control @error('Ghana_card_number') is-invalid @enderror"
                                            name="Ghana_card_number" placeholder="Ghana Card Number">

                                        @error('Ghana_card_number')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Add more form fields as needed -->
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block"
                                            style="margin-top:20px">Create
                                            Account</button>
                                    </div>
                                </div>
                            </form>

                            <div class="text-center">
                                <p class="text-muted mt-3 mb-0">Already have an account? <a
                                        class="text-primary fw-medium text-decoration-underline"
                                        href=" {{ route('citizens.activate') }}">Activate Now </a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-7 col-xl-5 col-lg-12 d-xl-block d-none px-0">
            <div class="authentication-cover overflow-hidden">
                <div class="aunthentication-cover-content d-flex align-items-center justify-content-center">
                    <div>
                        <a href="index.html">
                            <img src="{{ asset('assets/images/arms.png') }}" alt=""
                                class="authentication-brand toggle-white img-fluid mb-4">
                        </a>
                        <h4 class="text-fixed-white mb-2 fw-medium">Welcome Back! <span
                                class="text-secondary text-shadow">Sign In</span></h4>
                        <h6 class="text-fixed-white mb-3 fw-medium">Access Your Account</h6>
                        <p class="text-fixed-white mb-1 op-6">Please enter your Phone number / IPTS Access Code and
                            password to continue.</p>

                        <div class="d-flex mb-1 gap-2 flex-wrap flex-lg-nowrap">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Show Password JS -->
    <script src="{{ asset('assets/js/show-password.js') }}"></script>

</body>
