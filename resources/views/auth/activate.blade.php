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
                            <form action="{{ route('citizens.activateCitizen') }}" method="post">
                                @csrf

                                <div class="form-group last mb-3">
                                    <label for="email"><b>Activation Code</b></label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                                        placeholder="Activation Code" id="code" name="code">

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <input type="submit" value="Activate Account" class="btn btn-block btn-success"
                                    style="margin-top: 20px">

                            </form>

                            <div class="text-center">
                                <p class="text-muted mt-3 mb-0">Don't have an account? <a
                                        class="text-primary fw-medium text-decoration-underline"
                                        href="{{ route('auth.register') }}">Sign Up</a></p>
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
