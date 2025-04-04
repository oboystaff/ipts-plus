<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light"
    data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - IPRS </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/authentication-main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">


</head>

<body>
    <style>
        .btn-custom {
            background-color: #f37429;
            border-color: #f37429;
        }

        .btn-custom:hover {
            background-color: #e2631d;
            border-color: #e2631d;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
            /* To avoid scrolling */
        }

        .authentication-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background-image: url('{{ asset('assetsfront/images/banner/ipts1.jpg') }}'),
                url('{{ asset('assetsfront/images/banner/ipts4.jpg') }}'),
                url('{{ asset('assetsfront/images/banner/ipts5.jpg') }}'),
                url('{{ asset('assetsfront/images/banner/ipts1.jpg') }}'); */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            animation: slideBackground 20s linear infinite;
            opacity: 1;
        }

        @keyframes slideBackground {
            0% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/ipts4.jpg') }}");
            }

            25% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/ipts5.jpg') }}");
            }

            50% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/ipts3.jpg') }}");
            }

            75% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/ipts1.jpg') }}");
            }

            100% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/ipts3.jpg') }}");
            }
        }
    </style>

    <div class="authentication-background">
        <div class="container-lg">
            <div class="row justify-content-center authentication authentication-basic align-items-center h-100">
                <div class="col-xxl-4 col-lg-6 col-md-8 col-12"> <!-- Adjusted width classes -->
                    <div class="card custom-card my-4 border">
                        <div class="card-body">
                            <!-- Registration Form -->
                            <div class="mb-4 text-center">
                                <h4 class="mb-3">Send OTP</h4>
                                <p class="text-muted">Please fill in the details to reset password.</p>
                            </div>

                            @if (session()->has('status'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11">
                                        </path>
                                    </svg>
                                    <strong>{{ session('status') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
                                    </button>
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11">
                                        </path>
                                    </svg>
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('auth.sendUserOTP') }}" method="post">
                                @csrf

                                <div class="form-group first mb-4">
                                    <label for="email" class="form-label"><b>Account Phone number</b></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Account Phone number" id="phone" name="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <input type="submit" value="Send OTP" class="text-white btn btn-block btn-custom"
                                    style="width: 100%;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Show Password JS -->
    <script src="../assets/js/show-password.js"></script>
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
