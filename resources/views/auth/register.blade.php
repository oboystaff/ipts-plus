<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <link rel="stylesheet" href="{{ asset('assets/auth/css/bootstrap.min.css') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ERMS PLUS">
    <meta property="og:title" content="ERMS PLUS">
    <meta property="og:description" content="ERMS PLUS">
    <meta property="og:image" content=" ">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>ERMS PLUS</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="vh-100"
    style="background-image: url('{{ asset('assets/images/gh.jpeg') }}'); background-position: center; background-size: cover; background-attachment: fixed; height: 100vh;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('assets/images/arms.png') }}" class="rounded-circle"
                                            alt="" style="width: 100px; height: 100px;">
                                    </div>

                                    <h4 class="text-center mb-4">Sign up your account</h4>
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

                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary"
                                                href=" {{ route('citizens.activate') }}">Activate
                                                Account</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/663e4f9b9a809f19fb2fa32d/1hthme206';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
</body>

</html>
