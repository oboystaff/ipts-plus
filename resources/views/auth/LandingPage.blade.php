<html lang="en" dir="ltr" data-nav-layout="horizontal" data-nav-style="menu-click" data-menu-position="fixed"
    data-theme-mode="light">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IPTS </title>
    <meta name="Description" content="Level 10">
    <meta name="Author" content="Level 10">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/level10.png') }}" type="image/x-icon">

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

<body class="landing-body">

    <!-- Start Switcher -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Switcher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="">
                <p class="switcher-style-head">Theme Color Mode:</p>
                <div class="row switcher-style gx-0">
                    <div class="col-4">
                        <div class="form-check switch-select">
                            <label class="form-check-label" for="switcher-light-theme">
                                Light
                            </label>
                            <input class="form-check-input" type="radio" name="theme-style" id="switcher-light-theme"
                                checked>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check switch-select">
                            <label class="form-check-label" for="switcher-dark-theme">
                                Dark
                            </label>
                            <input class="form-check-input" type="radio" name="theme-style" id="switcher-dark-theme">
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Directions:</p>
                <div class="row switcher-style gx-0">
                    <div class="col-4">
                        <div class="form-check switch-select">
                            <label class="form-check-label" for="switcher-ltr">
                                LTR
                            </label>
                            <input class="form-check-input" type="radio" name="direction" id="switcher-ltr" checked>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check switch-select">
                            <label class="form-check-label" for="switcher-rtl">
                                RTL
                            </label>
                            <input class="form-check-input" type="radio" name="direction" id="switcher-rtl">
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-colors">
                <p class="switcher-style-head">Theme Primary:</p>
                <div class="d-flex align-items-center switcher-style">
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-1" type="radio" name="theme-primary"
                            id="switcher-primary">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-2" type="radio" name="theme-primary"
                            id="switcher-primary1">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-3" type="radio"
                            name="theme-primary" id="switcher-primary2">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-4" type="radio"
                            name="theme-primary" id="switcher-primary3">
                    </div>
                    <div class="form-check switch-select me-3">
                        <input class="form-check-input color-input color-primary-5" type="radio"
                            name="theme-primary" id="switcher-primary4">
                    </div>
                    <div class="form-check switch-select me-3 ps-0 mt-1 color-primary-light">
                        <div class="theme-container-primary"></div>
                        <div class="pickr-container-primary"></div>
                    </div>
                </div>
            </div>
            <div>
                <p class="switcher-style-head">reset:</p>
                <div class="text-center">
                    <button id="reset-all" class="btn btn-danger mt-3">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Switcher -->

    <div class="landing-page-wrapper">

        <!-- app-header -->
        <header class="app-header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="#" class="header-logo">
                                <img src="{{ asset('assets/images/level10.png') }}" alt="logo"
                                    class="toggle-logo">
                                <img src="{{ asset('assets/images/level10.png') }}" alt="logo"
                                    class="toggle-white">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
                            <span class="open-toggle">
                                <i class="ri-menu-3-line fs-20"></i>
                            </span>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                    <!-- Start::header-element -->
                    <div class="header-element align-items-center">
                        <!-- Start::header-link|switcher-icon -->
                        <div class="btn-list d-lg-none d-flex">
                            <a href="{{ route('auth.register') }}" class="btn-signup-light">
                                Create Account
                            </a>

                        </div>
                        <!-- End::header-link|switcher-icon -->
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->

        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <div class="container-xl">
                <!-- Start::main-sidebar -->
                <div class="main-sidebar shadow-none">

                    <!-- Start::nav -->
                    <nav class="main-menu-container nav nav-pills sub-open">
                        <div class="landing-logo-container">
                            <div class="horizontal-logo">
                                <a href="index.html" class="header-logo">
                                    <img src="{{ asset('assets/images/level10.png') }}" alt="logo"
                                        class="desktop-logo">
                                    <img src="{{ asset('assets/level10.png') }}" alt="logo"
                                        class="desktop-white">
                                </a>
                            </div>
                        </div>
                        <div class="slide-left" id="slide-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                            </svg>
                        </div>
                        <ul class="main-menu ms-auto">
                            <!-- Start::slide -->
                            <li class="slide">
                                <a class="side-menu__item" href="#home">
                                    <span class="side-menu__label">Home</span>
                                </a>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="#about" class="side-menu__item">
                                    <span class="side-menu__label">About</span>
                                </a>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->

                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="#team" class="side-menu__item">
                                    <span class="side-menu__label">Features</span>
                                </a>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->

                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="#faqs" class="side-menu__item">
                                    <span class="side-menu__label">FAQ's</span>
                                </a>
                            </li>
                            <!-- End::slide -->
                            <!-- Start::slide -->

                            <!-- End::slide -->
                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="#contact" class="side-menu__item">
                                    <span class="side-menu__label">Contact Us</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                </path>
                            </svg></div>
                        <div class="d-lg-flex d-none">
                            <div class="btn-list d-lg-flex d-none mt-lg-2 mt-xl-0 mt-0">
                                <a href="{{ route('auth.register') }}"
                                    class="btn btn-wave btn-success rounded-pill btn-w-md">
                                    Sign Up
                                </a>

                            </div>
                        </div>
                    </nav>
                    <!-- End::nav -->

                </div>
                <!-- End::main-sidebar -->
            </div>

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content landing-main px-0">

            <!-- Start:: Section-1 -->
            <div class="landing-banner" id="home">
                <section class="section main-banner-section">
                    <div class="container main-banner-container pb-lg-0">
                        <div class="row pt-xl-3">
                            <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-8">
                                <div class="banner-content">
                                    <p class="fs-14 fw-medium text-success mb-3">
                                        <span class="landing-section-heading text-success"><i
                                                class="ti ti-inner-shadow-top-right-filled text-secondary me-1 fs-10"></i>Optimized
                                            and Accessible</span>
                                    </p>
                                    <h6 class="landing-banner-heading mb-3 text-fixed-white">Empowering Local
                                        Assemblies, Strengthening Communities with
                                        <span class="fw-semibold text-warning">IPTS</span>
                                    </h6>
                                    <div class="fs-16 mb-5 text-fixed-white op-7">Introducing IPTS – Your Gateway to
                                        Transparent and Efficient Revenue Management</div>
                                    <a href="{{ route('auth.index') }}"
                                        class="m-1 btn btn-lg rounded-pill px-4 bg-success text-fixed-white">
                                        Login
                                        <i class="ri-eye-line ms-2 align-middle"></i>
                                    </a>
                                    <a href="{{ route('auth.register') }}"
                                        class="m-1 btn btn-lg rounded-pill px-4 btn-primary btn-wave waves-effect waves-light">
                                        Create Account
                                        <i class="ri-arrow-right-line ms-2 align-middle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-4 my-auto">
                                <div class="text-end landing-main-image landing-heading-img">
                                    <img src="{{ asset('assets/images/media/media-72.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- End:: Section-1 -->

            <!-- Start:: Section-2 -->
            <section class="section" id="about">
                <div class="container position-relative">
                    <div class="text-center">
                        <p class="fs-14 fw-medium text-success mb-1">
                            <span class="landing-section-heading text-success"><i
                                    class="ti ti-inner-shadow-top-right-filled text-secondary me-1 fs-10"></i>Overview</span>
                        </p>
                        <h4 class="fw-semibold mb-1 mt-3">Transforming Revenue Management Across Africa</h4>
                        <div class="row justify-content-center">
                            <div class="col-xl-7">
                                <p class="text-muted fs-14 mb-5 fw-normal">
                                    IPTS is redefining how communities across Africa collect and manage revenue. By
                                    leveraging technology and promoting transparency, it ensures efficient processes
                                    that empower citizens and drive sustainable development.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <div
                                class="card custom-card landing-first-cards primary border border-primary border-opacity-25 shadow-none">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span
                                            class="avatar avatar-lg bg-primary-transparent avatar-rounded border-3 border border-opacity-50 border-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-primary"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M64,105V40a8,8,0,0,0-16,0v65a32,32,0,0,0,0,62v49a8,8,0,0,0,16,0V167a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,56,152Zm80-95V40a8,8,0,0,0-16,0V57a32,32,0,0,0,0,62v97a8,8,0,0,0,16,0V119a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,128,104Zm104,64a32.06,32.06,0,0,0-24-31V40a8,8,0,0,0-16,0v97a32,32,0,0,0,0,62v17a8,8,0,0,0,16,0V199A32.06,32.06,0,0,0,232,168Zm-32,16a16,16,0,1,1,16-16A16,16,0,0,1,200,184Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                    <h6 class="fw-semibold">Real-Time Monitoring </h6>
                                    <p class="text-muted">Track payments and revenue in real time to ensure
                                        accountability.</p>
                                    <a href="javascript:void(0);" class="fw-semibold text-primary">Read More<i
                                            class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div
                                class="card custom-card landing-first-cards secondary border border-secondary border-opacity-25 shadow-none">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span
                                            class="avatar avatar-lg bg-secondary-transparent avatar-rounded border-3 border border-opacity-50 border-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-secondary"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M64,105V40a8,8,0,0,0-16,0v65a32,32,0,0,0,0,62v49a8,8,0,0,0,16,0V167a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,56,152Zm80-95V40a8,8,0,0,0-16,0V57a32,32,0,0,0,0,62v97a8,8,0,0,0,16,0V119a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,128,104Zm104,64a32.06,32.06,0,0,0-24-31V40a8,8,0,0,0-16,0v97a32,32,0,0,0,0,62v17a8,8,0,0,0,16,0V199A32.06,32.06,0,0,0,232,168Zm-32,16a16,16,0,1,1,16-16A16,16,0,0,1,200,184Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                    <h6 class="fw-semibold">Ease of Payment</h6>
                                    <p class="text-muted">Enjoy secure and convenient payment options through digital
                                        channels or local centers.</p>
                                    <a href="javascript:void(0);" class="fw-semibold text-secondary">Read More<i
                                            class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div
                                class="card custom-card landing-first-cards success border border-success border-opacity-25 shadow-none">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span
                                            class="avatar avatar-lg bg-success-transparent avatar-rounded border-3 border border-opacity-50 border-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-success"
                                                width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M64,105V40a8,8,0,0,0-16,0v65a32,32,0,0,0,0,62v49a8,8,0,0,0,16,0V167a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,56,152Zm80-95V40a8,8,0,0,0-16,0V57a32,32,0,0,0,0,62v97a8,8,0,0,0,16,0V119a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,128,104Zm104,64a32.06,32.06,0,0,0-24-31V40a8,8,0,0,0-16,0v97a32,32,0,0,0,0,62v17a8,8,0,0,0,16,0V199A32.06,32.06,0,0,0,232,168Zm-32,16a16,16,0,1,1,16-16A16,16,0,0,1,200,184Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                    <h6 class="fw-semibold">User-Friendly Portal</h6>
                                    <p class="text-muted">Navigate a simple, intuitive platform for accessing your
                                        property and business information.
                                    </p>
                                    <a href="javascript:void(0);" class="fw-semibold text-success">Read More<i
                                            class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div
                                class="card custom-card landing-first-cards info border border-info border-opacity-25 shadow-none">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span
                                            class="avatar avatar-lg bg-info-transparent avatar-rounded border-3 border border-opacity-50 border-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-info" width="32"
                                                height="32" fill="#000000" viewBox="0 0 256 256">
                                                <path
                                                    d="M64,105V40a8,8,0,0,0-16,0v65a32,32,0,0,0,0,62v49a8,8,0,0,0,16,0V167a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,56,152Zm80-95V40a8,8,0,0,0-16,0V57a32,32,0,0,0,0,62v97a8,8,0,0,0,16,0V119a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,128,104Zm104,64a32.06,32.06,0,0,0-24-31V40a8,8,0,0,0-16,0v97a32,32,0,0,0,0,62v17a8,8,0,0,0,16,0V199A32.06,32.06,0,0,0,232,168Zm-32,16a16,16,0,1,1,16-16A16,16,0,0,1,200,184Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                    <h6 class="fw-semibold">Enhanced Transparency</h6>
                                    <p class="text-muted">Gain confidence in how funds are managed and reinvested into
                                        community development.
                                    </p>
                                    <a href="javascript:void(0);" class="fw-semibold text-info">Read More<i
                                            class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-2 -->

            <!-- Start:: Section-3 -->
            <section class="section bg-white overflow-hidden" id="expectations">
                <div class="container">
                    <div class="row gx-5 mx-0 align-items-end">
                        <div class="col-xl-5 d-none d-xl-block">
                            <div class="home-proving-image rounded-3 border border-primary border-opacity-25">
                                <img src="{{ asset('assets/images/media/media-80.png') }}" alt=""
                                    class="img-fluid about-image">
                            </div>
                            <div class="proving-pattern-1"></div>
                        </div>
                        <div class="col-xl-7 my-auto">
                            <div class="heading-section text-start mb-4">
                                <p class="fs-14 fw-medium text-success mb-1">
                                    <span class="landing-section-heading text-success"><i
                                            class="ti ti-inner-shadow-top-right-filled text-secondary me-1 fs-10"></i>About
                                        Us</span>
                                </p>
                                <h4 class="mt-3 fw-semibold mb-2">Our Commitment to Excellence</h4>
                                <div class="heading-description fs-14"> </div>
                            </div>
                            <div class="row gy-4 mb-0">
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-top">
                                        <div
                                            class="avatar avatar-lg bg-primary-transparent avatar-rounded border-3 border border-opacity-50 border-primary me-2 flex-shrink-0">
                                            01.
                                        </div>
                                        <div>
                                            <span class="fs-14">
                                                <strong>Unwavering Transparency
                                                    :</strong> We prioritize openness in all processes, ensuring
                                                citizens and stakeholders have a clear understanding of how funds are
                                                managed and utilized. Transparency fosters trust and accountability,
                                                forming the foundation of our operations.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-top">
                                        <div
                                            class="avatar avatar-lg bg-secondary-transparent avatar-rounded border-3 border border-opacity-50 border-secondary me-2 flex-shrink-0">
                                            02.
                                        </div>
                                        <div>
                                            <span class="fs-14">
                                                <strong>Innovative Solutions:</strong> By embracing cutting-edge
                                                technology, we create efficient systems that simplify revenue collection
                                                and management. Our solutions are designed to adapt to modern
                                                challenges, making processes faster and more reliable.


                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-top">
                                        <div
                                            class="avatar avatar-lg bg-success-transparent avatar-rounded border-3 border border-opacity-50 border-success me-2 flex-shrink-0">
                                            03.
                                        </div>
                                        <div>
                                            <span class="fs-14">
                                                <strong>Community-Centered Approach:</strong> Every decision we make is
                                                aimed at improving the lives of citizens. From reinvesting funds into
                                                infrastructure to enhancing public services, we are committed to
                                                fostering sustainable development in every community we serve.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-top">
                                        <div
                                            class="avatar avatar-lg bg-info-transparent avatar-rounded border-3 border border-opacity-50 border-info me-2 flex-shrink-0">
                                            04.
                                        </div>
                                        <div>
                                            <span class="fs-14">
                                                <strong>Exceptional User Experience:</strong> We believe in making
                                                things easy for everyone. Our platforms are intuitive, accessible, and
                                                tailored to meet the needs of both individuals and organizations,
                                                ensuring a seamless experience from start to finish.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- End:: Section-3 -->

            <!-- Start:: Section-4 -->
            <section class="section section-bg" id="services">
                <div class="container my-4">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div
                                                        class="border border-2 border-primary border-opacity-10 bg-primary-transparent rounded-4">
                                                        <div class="p-1 bg-white rounded-circle border">
                                                            <span class="avatar avatar-md avatar-rounded bg-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="svg-white" width="32" height="32"
                                                                    viewBox="0 0 24 24">
                                                                    <g fill="none" stroke="currentColor"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2">
                                                                        <path
                                                                            d="M12 17v4m3.2-16.1l-.9-.4m.9 2.6l-.9.4m2.6-4.3l-.4-.9m.4 6.5l-.4.9m3-7.4l-.4.9m.4 6.5l-.4-.9m2.6-4.3l-.9.4m.9 2.6l-.9-.4M22 13v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7M8 21h8" />
                                                                        <circle cx="18" cy="6" r="3" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <h5 class="fw-semibold mb-0"> Real-Time Revenue Tracking</h5>
                                                </div>
                                            </div>
                                            <p class="text-muted">Monitor payments and revenue in real time, ensuring
                                                transparency and accountability at every stage.</p>
                                            <a href="javascript:void(0);" class="fw-semibold text-primary">Read More<i
                                                    class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                        </div>
                                    </div>
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div
                                                        class="border border-2 border-info border-opacity-10 bg-info-transparent rounded-4">
                                                        <div class="p-1 bg-white rounded-circle border">
                                                            <span class="avatar avatar-md avatar-rounded bg-info">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="svg-info" width="32" height="32"
                                                                    viewBox="0 0 24 24">
                                                                    <g fill="none" stroke="currentColor"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2">
                                                                        <path d="m8 11l2 2l4-4" />
                                                                        <circle cx="11" cy="11" r="8" />
                                                                        <path d="m21 21l-4.3-4.3" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <h5 class="fw-semibold mb-0">Secure and Easy Payment Options </h5>
                                                </div>
                                            </div>
                                            <p class="text-muted">With multiple payment methods, including digital and
                                                local channels, paying taxes has never been easier or more secure.</p>
                                            <a href="javascript:void(0);" class="fw-semibold text-info">Read More<i
                                                    class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="card custom-card mt-xl-4">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div
                                                        class="border border-2 border-secondary border-opacity-10 bg-secondary-transparent rounded-4">
                                                        <div class="p-1 bg-white rounded-circle border">
                                                            <span class="avatar avatar-md avatar-rounded bg-secondary">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="svg-secondary" width="32"
                                                                    height="32" viewBox="0 0 24 24">
                                                                    <g fill="none" stroke="currentColor"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2">
                                                                        <circle cx="12" cy="17" r="3" />
                                                                        <path
                                                                            d="M4.2 15.1A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.2m-4.3 2.2l-.9-.3m-5.6-2.2l-.9-.3m2.3 5.1l.3-.9m2.2-5.6l.3-.9m.2 7.4l-.4-1m-2.4-5.4l-.4-1m-2.1 5.3l1-.4m5.4-2.4l1-.4" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <h5 class="fw-semibold mb-0">User-Friendly Interface </h5>
                                                </div>
                                            </div>
                                            <p class="text-muted">Navigate a simple, intuitive platform to access
                                                property assessments, make payments, and track progress effortlessly..
                                            </p>
                                            <a href="javascript:void(0);" class="fw-semibold text-secondary">Read
                                                More<i
                                                    class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                        </div>
                                    </div>
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div
                                                        class="border border-2 border-success border-opacity-10 bg-success-transparent rounded-4">
                                                        <div class="p-1 bg-white rounded-circle border">
                                                            <span class="avatar avatar-md avatar-rounded bg-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="svg-white" width="32" height="32"
                                                                    viewBox="0 0 24 24">
                                                                    <g fill="none" stroke="currentColor"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2">
                                                                        <rect width="14" height="20" x="5"
                                                                            y="2" rx="2" ry="2" />
                                                                        <path d="M12 18h.01" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <h5 class="fw-semibold mb-0">Automated Notifications </h5>
                                                </div>
                                            </div>
                                            <p class="text-muted">Receive timely alerts and reminders for payment
                                                deadlines, keeping you updated and in control of your obligations.

                                            </p>
                                            <a href="javascript:void(0);" class="fw-semibold text-success">Read More<i
                                                    class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="card custom-card mt-xl-5">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div
                                                        class="border border-2 border-teal border-opacity-10 bg-teal-transparent rounded-4">
                                                        <div class="p-1 bg-white rounded-circle border">
                                                            <span class="avatar avatar-md avatar-rounded bg-teal">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="svg-white" width="32" height="32"
                                                                    viewBox="0 0 24 24">
                                                                    <g fill="none" stroke="currentColor"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2">
                                                                        <circle cx="8" cy="21" r="1" />
                                                                        <circle cx="19" cy="21" r="1" />
                                                                        <path
                                                                            d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <h5 class="fw-semibold mb-0">Enhanced Data Security</h5>
                                                </div>
                                            </div>
                                            <p class="text-muted">Built with state-of-the-art security features to
                                                safeguard your personal and financial data, ensuring peace of mind.</p>
                                            <a href="javascript:void(0);" class="fw-semibold text-teal">Read More<i
                                                    class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                        </div>
                                    </div>
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div
                                                        class="border border-2 border-pink border-opacity-10 bg-pink-transparent rounded-4">
                                                        <div class="p-1 bg-white rounded-circle border">
                                                            <span class="avatar avatar-md avatar-rounded bg-pink">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="svg-white" width="32" height="32"
                                                                    viewBox="0 0 24 24">
                                                                    <path fill="none" stroke="currentColor"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M2 8V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-6M2 12a9 9 0 0 1 8 8m-8-4a5 5 0 0 1 4 4m-4 0h.01" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <h5 class="fw-semibold mb-0">Community Investment </h5>
                                                </div>
                                            </div>
                                            <p class="text-muted">Every payment contributes to vital infrastructure and
                                                services, directly benefiting the local community and driving growth.
                                            </p>
                                            <a href="javascript:void(0);" class="fw-semibold text-pink">Read More<i
                                                    class="ti ti-arrow-narrow-right ms-1 fs-16 lh-1 align-middle d-inline-block rtl-icon-transform"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="heading-section text-end mb-4">
                                <p class="fs-14 fw-medium text-success mb-1">
                                    <span class="landing-section-heading text-success"><i
                                            class="ti ti-inner-shadow-top-right-filled text-secondary me-1 fs-10"></i>Our
                                        Services</span>
                                </p>
                                <h4 class="mt-3 fw-semibold mb-2">Revenue Assurance </h4>
                                <div class="heading-description fs-14 mb-3">By integrating advanced technology and
                                    user-focused design, IPTS empowers citizens and authorities alike to participate in
                                    transparent and efficient revenue collection.</div>
                                <a href="{{ route('auth.register') }}"
                                    class="btn btn-wave btn-secondary rounded-pill">
                                    Get started Now
                                </a>
                            </div>
                            <img src="{{ asset('assets/images/media/media-79.png') }}" alt=""
                                class="img-fluid ps-5 d-none d-xl-block">
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-4 -->



            <!-- Start:: Section-6 -->
            <section class="section" id="team">
                <div class="container">
                    <div class="text-center">
                        <p class="fs-14 fw-medium text-success mb-1">
                            <span class="landing-section-heading text-success"><i
                                    class="ti ti-inner-shadow-top-right-filled text-secondary me-1 fs-10"></i>Our
                                Team</span>
                        </p>
                        <h4 class="fw-semibold mt-3 mb-2">Meet the Dedicated Individuals Behind Our Success</h4>
                        <div class="row justify-content-center">
                            <div class="col-xl-7">
                                <p class="text-muted fs-14 mb-5 fw-normal">Our team comprises talented professionals
                                    who are committed to excellence and passionate about driving results.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card custom-card team-member text-center">
                                <div class="team-shape1"></div>
                                <div class="team-shape2"></div>
                                <div class="card-body py-4">
                                    <div class="mb-3 lh-1 d-flex gap-2 justify-content-center">
                                        <span class="rounded-circle p-2 bg-success bg-opacity-25 shadow-sm">
                                            <img src="{{ asset('assets/images/faces/8.jpg') }}"
                                                class="card-img rounded-circle" alt="Xavier Holt">
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-2 fw-medium">Xavier Holt</h6>
                                        <p class="mb-0 text-primary fw-semibold">CHIEF FINANCIAL OFFICER</p>
                                        <hr class="bg-success border-success border-2 border-top">
                                        <p class="text-muted fs-12 pt-1 px-2">Xavier brings over 20 years of financial
                                            expertise to the company, ensuring our financial stability and growth.</p>
                                        <div class="d-flex justify-content-center">
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-primary btn-wave btn-sm waves-effect waves-light"><i
                                                    class="ri-twitter-x-fill"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-secondary btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-facebook-fill"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-success btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-instagram-line"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-info btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-linkedin-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card custom-card team-member text-center">
                                <div class="team-shape1"></div>
                                <div class="team-shape2"></div>
                                <div class="card-body py-4">
                                    <div class="mb-3 lh-1 d-flex gap-2 justify-content-center">
                                        <span class="rounded-circle p-2 bg-info bg-opacity-25 shadow-sm">
                                            <img src="{{ asset('assets/images/faces/10.jpg') }}"
                                                class="card-img rounded-circle" alt="Mateo Cruz">
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-2 fw-medium">Mateo Cruz</h6>
                                        <p class="mb-0 text-primary fw-semibold">HEAD OF PRODUCT DEVELOPMENT</p>
                                        <hr class="bg-success border-success border-2 border-top">
                                        <p class="text-muted fs-12 pt-1 px-2">Mateo oversees the entire product
                                            development lifecycle, ensuring that our solutions meet market.</p>
                                        <div class="d-flex justify-content-center">
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-primary btn-wave btn-sm waves-effect waves-light"><i
                                                    class="ri-twitter-x-fill"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-secondary btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-facebook-fill"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-success btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-instagram-line"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-info btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-linkedin-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card custom-card team-member text-center">
                                <div class="team-shape1"></div>
                                <div class="team-shape2"></div>
                                <div class="card-body py-4">
                                    <div class="mb-3 lh-1 d-flex gap-2 justify-content-center">
                                        <span class="rounded-circle p-2 bg-secondary bg-opacity-25 shadow-sm">
                                            <img src="{{ asset('assets/images/faces/5.jpg') }}"
                                                class="card-img rounded-circle" alt="...">
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-2 fw-medium">Ariana Wolfe</h6>
                                        <p class="mb-0 text-primary fw-semibold">CHIEF OPERATIONS OFFICER</p>
                                        <hr class="bg-success border-success border-2 border-top">
                                        <p class="text-muted fs-12 pt-1 px-2">Ariana has over a decade of experience in
                                            operational excellence and business strategies, ensuring smooth.</p>
                                        <div class="d-flex justify-content-center">
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-primary btn-wave btn-sm waves-effect waves-light"><i
                                                    class="ri-twitter-x-fill"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-secondary btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-facebook-fill"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-success btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-instagram-line"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-info btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-linkedin-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card custom-card team-member text-center">
                                <div class="team-shape1"></div>
                                <div class="team-shape2"></div>
                                <div class="card-body py-4">
                                    <div class="mb-3 lh-1 d-flex gap-2 justify-content-center">
                                        <span class="rounded-circle p-2 bg-primary bg-opacity-25 shadow-sm">
                                            <img src="{{ asset('assets/images/faces/7.jpg') }}"
                                                class="card-img rounded-circle" alt="...">
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-2 fw-medium">Selena Rivera</h6>
                                        <p class="mb-0 text-primary fw-semibold">MARKETING DIRECTOR</p>
                                        <hr class="bg-success border-success border-2 border-top">
                                        <p class="text-muted fs-12 pt-1 px-2">Selena is an expert in digital marketing
                                            strategies and brand building, helping our company reach a global audience.
                                        </p>
                                        <div class="d-flex justify-content-center">
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-primary btn-wave btn-sm waves-effect waves-light"><i
                                                    class="ri-twitter-x-fill"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-secondary btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-facebook-fill"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-success btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-instagram-line"></i></a>
                                            <a aria-label="anchor" href="javascript:void(0);"
                                                class="btn btn-icon rounded-circle btn-info btn-wave btn-sm ms-2 waves-effect waves-light"><i
                                                    class="ri-linkedin-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-6 -->



            <!-- Start:: Section-8 -->
            <section class="section" id="faqs">
                <div class="container text-center">
                    <p class="fs-14 fw-medium text-success mb-1">
                        <span class="landing-section-heading text-success"><i
                                class="ti ti-inner-shadow-top-right-filled text-secondary me-1 fs-10"></i>FAQs</span>
                    </p>
                    <h4 class="fw-semibold mt-3 mb-2">Common Questions and Answers</h4>
                    <div class="row justify-content-center">
                        <div class="col-xl-7">
                            <p class="text-muted fs-14 mb-5 fw-normal">Weve compiled a list of the most common
                                questions to assist you in finding the information you need.</p>
                        </div>
                    </div>
                    <div class="row text-start">
                        <div class="col-xl-12">
                            <div class="row gy-2">
                                <div class="col-xl-6">
                                    <div class="accordion accordion-customicon1 faq-accordion accordion-primary accordions-items-separate"
                                        id="accordionFAQ5">
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2TwentyOne">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2TwentyOne"
                                                    aria-expanded="true" aria-controls="collapsecustomicon2TwentyOne">
                                                    1. How do I update my account settings?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2TwentyOne"
                                                class="accordion-collapse collapse show"
                                                aria-labelledby="headingcustomicon2TwentyOne"
                                                data-bs-parent="#accordionFAQ5">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    You can update your account settings by going to the settings page,
                                                    where you can change your personal information, password, and
                                                    notification preferences.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2TwentyTwo">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2TwentyTwo"
                                                    aria-expanded="false"
                                                    aria-controls="collapsecustomicon2TwentyTwo">
                                                    2. How can I reset my password?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2TwentyTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2TwentyTwo"
                                                data-bs-parent="#accordionFAQ5">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    To reset your password, go to the login page and click on the
                                                    "Forgot Password" link. You will receive an email with instructions
                                                    to reset your password.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2TwentyThree">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2TwentyThree"
                                                    aria-expanded="false"
                                                    aria-controls="collapsecustomicon2TwentyThree">
                                                    3. How do I change my email address?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2TwentyThree"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2TwentyThree"
                                                data-bs-parent="#accordionFAQ5">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    To change your email address, navigate to the account settings page,
                                                    where you can enter a new email address and verify it through a
                                                    confirmation email.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2TwentyFour">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2TwentyFour"
                                                    aria-expanded="false"
                                                    aria-controls="collapsecustomicon2TwentyFour">
                                                    4. How can I enable two-factor authentication?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2TwentyFour"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2TwentyFour"
                                                data-bs-parent="#accordionFAQ5">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    To enable two-factor authentication, go to your account settings and
                                                    click on the "Security" tab. You can enable two-factor
                                                    authentication using an authenticator app or SMS.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2TwentyFive">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2TwentyFive"
                                                    aria-expanded="false"
                                                    aria-controls="collapsecustomicon2TwentyFive">
                                                    5. How do I delete my account?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2TwentyFive"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2TwentyFive"
                                                data-bs-parent="#accordionFAQ5">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    If you want to delete your account, please visit the account
                                                    settings page and follow the instructions under the "Delete Account"
                                                    section. Note that this action is irreversible.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="accordion accordion-customicon1 faq-accordion accordion-primary accordions-items-separate"
                                        id="accordionFAQ1">
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2One">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2One" aria-expanded="false"
                                                    aria-controls="collapsecustomicon2One">
                                                    6. How can I update my privacy settings?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2One" class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2One"
                                                data-bs-parent="#accordionFAQ1">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    To update your privacy settings, navigate to the "Privacy &
                                                    Security" section in your account settings. Here, you can manage
                                                    data sharing options, control who sees your profile information, and
                                                    adjust permissions for third-party apps.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2Two">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2Two" aria-expanded="false"
                                                    aria-controls="collapsecustomicon2Two">
                                                    7. How do I enable two-factor authentication?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2Two" class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2Two"
                                                data-bs-parent="#accordionFAQ1">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    To enable two-factor authentication, go to the "Security Settings"
                                                    and choose the two-factor authentication option. You can set it up
                                                    using an authenticator app or receive codes via SMS for enhanced
                                                    account security.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2Three">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2Three" aria-expanded="false"
                                                    aria-controls="collapsecustomicon2Three">
                                                    8. How do I manage my data sharing preferences?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2Three"
                                                class="accordion-collapse collapse show"
                                                aria-labelledby="headingcustomicon2Three"
                                                data-bs-parent="#accordionFAQ1">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    You can manage your data sharing preferences by visiting the
                                                    "Privacy Settings" page. Here, you can control how your data is
                                                    shared with third-party services.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2Four">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2Four" aria-expanded="false"
                                                    aria-controls="collapsecustomicon2Four">
                                                    9. How do I secure my account if I suspect unauthorized access?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2Four" class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2Four"
                                                data-bs-parent="#accordionFAQ1">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    If you suspect unauthorized access to your account, go to the
                                                    "Security" section and review your recent activity. You can log out
                                                    of all devices, reset your password, and enable two-factor
                                                    authentication for added protection.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item shadow-sm">
                                            <h2 class="accordion-header" id="headingcustomicon2Five">
                                                <button
                                                    class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2Five" aria-expanded="false"
                                                    aria-controls="collapsecustomicon2Five">
                                                    10. How can I delete my personal data from the platform?
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2Five" class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2Five"
                                                data-bs-parent="#accordionFAQ1">
                                                <div
                                                    class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                    You can request the deletion of your personal data by navigating to
                                                    the "Privacy Settings" page and selecting the option to delete your
                                                    data. Note that this action is irreversible, and your data will be
                                                    permanently removed from the platform.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-8 -->

            <!-- Start:: Section-9 -->

            <!-- End:: Section-9 -->

            <!-- Start:: Section-10 -->
            <section class="section" id="contact">
                <div class="container text-center">
                    <p class="fs-14 fw-medium text-success mb-1">
                        <span class="landing-section-heading text-success"><i
                                class="ti ti-inner-shadow-top-right-filled text-secondary me-1 fs-10"></i>Contact
                            Us</span>
                    </p>
                    <h4 class="fw-semibold mt-3 mb-2">Have Questions? We're Here to Help!</h4>
                    <div class="row justify-content-center">
                        <div class="col-xl-9">
                            <p class="text-muted fs-14 mb-5 fw-normal">Discover our extensive support resources! Get
                                quick answers to your questions and find the solutions you need.</p>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-9">
                            <div class="card custom-card contactus-form contactus-form-left overflow-hidden p-4">
                                <div class="text-start">
                                    <div class="row pt-0 justify-content-center">
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="row gy-3 text-start">
                                                <div class="col-xl-12">
                                                    <label class="form-label" for="contact-address-firstname">First
                                                        Name :</label>
                                                    <input class="form-control rounded-pill bg-light"
                                                        id="contact-address-firstname" placeholder="Enter Name"
                                                        type="text">
                                                </div>
                                                <div class="col-xl-12">
                                                    <label class="form-label" for="contact-address-email">Email Id
                                                        :</label>
                                                    <input class="form-control rounded-pill bg-light"
                                                        id="contact-address-email" placeholder="Enter Email Id"
                                                        type="email">
                                                </div>
                                                <div class="col-xl-7">
                                                    <label class="form-label" for="contact-mail-message">Message
                                                        :</label>
                                                    <textarea class="form-control rounded-pill bg-light" id="contact-mail-message" rows="1"
                                                        placeholder="Write Here.."></textarea>
                                                </div>
                                                <div class="col-xl-5 align-self-end">
                                                    <button
                                                        class="btn btn-primary btn-wave btn-w-lg waves-effect waves-light w-100 rounded-pill">Submit
                                                        Message</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-5 col-xl-6 d-none d-xl-block">
                                            <img src="{{ asset('assets/images/media/media-78.png') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body bg-primary mt-5 rounded-3 bg-opacity-25">
                                    <div class="row justify-content-center gy-3 gy-xl-0">
                                        <div class="col-xl-4">
                                            <div class="card custom-card mb-0">
                                                <div class="card-body">
                                                    <span class="avatar avatar-lg bg-primary avatar-rounded">
                                                        <i class="ri-map-pin-fill fs-18 lh-1 align-middle"></i>
                                                    </span>
                                                    <p class="fw-semibold fs-14 mb-0"><span
                                                            class="text-muted fw-medium fs-12">Office Location:
                                                        </span>Accra-Ghana</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card custom-card mb-0">
                                                <div class="card-body">
                                                    <span class="avatar avatar-lg bg-info avatar-rounded">
                                                        <i class="ri-phone-fill fs-18 lh-1 align-middle"></i>
                                                    </span>
                                                    <p class="fw-semibold fs-14 mb-0"><span
                                                            class="text-muted fw-medium fs-12">Mobile:
                                                        </span>+233500503599</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card custom-card mb-0">
                                                <div class="card-body">
                                                    <span class="avatar avatar-lg bg-pink avatar-rounded">
                                                        <i class="ri-mail-fill fs-18 lh-1 align-middle"></i>
                                                    </span>
                                                    <p class="fw-semibold fs-14 mb-0"><span
                                                            class="text-muted fw-medium fs-12">Mail:
                                                        </span>info@level10gh.com</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-10 -->

            <!-- Start:: Section-11 -->
            <section class="section landing-footer text-fixed-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="px-4">
                                <p class="mb-2 fw-medium fs-14 text-secondary">Subscribe :</p>
                                <ul class="list-unstyled fw-normal landing-footer-list">
                                    <li>
                                        <div class="input-group p-1 border bg-white rounded-pill gap-2 mb-4">
                                            <input type="text"
                                                class="form-control rounded-pill border-0 bg-transparent"
                                                placeholder="Subscribe to our news letter..">
                                            <div class="btn btn-success rounded-pill">Subscribe</div>
                                        </div>
                                        <p class="mb-2 fw-medium fs-14 text-secondary">Follow Us On :</p>
                                        <div class="mb-0">
                                            <div class="btn-list">
                                                <button
                                                    class="btn btn-sm btn-icon footer-btn rounded-pill btn-wave waves-effect waves-light">
                                                    <i class="ri-facebook-line fw-bold lh-1 align-middle"></i>
                                                </button>
                                                <button
                                                    class="btn btn-sm btn-icon footer-btn rounded-pill btn-wave waves-effect waves-light">
                                                    <i class="ri-twitter-x-line fw-bold lh-1 align-middle"></i>
                                                </button>
                                                <button
                                                    class="btn btn-sm btn-icon footer-btn rounded-pill btn-wave waves-effect waves-light">
                                                    <i class="ri-instagram-line fw-bold lh-1 align-middle"></i>
                                                </button>
                                                <button
                                                    class="btn btn-sm btn-icon footer-btn rounded-pill btn-wave waves-effect waves-light">
                                                    <i class="ri-github-line fw-bold lh-1 align-middle"></i>
                                                </button>
                                                <button
                                                    class="btn btn-sm btn-icon footer-btn rounded-pill btn-wave waves-effect waves-light">
                                                    <i class="ri-youtube-line fw-bold lh-1 align-middle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-12">
                            <div class="px-4">
                                <h6 class="fw-medium fs-14 text-secondary text-decoration-underline link-offset-3">
                                    Quick Links</h6>
                                <ul class="list-unstyled op-8 fw-normal landing-footer-list">

                                    <li>
                                        <a href="javascript:void(0);" class="text-fixed-white">About</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="text-fixed-white">Features</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="text-fixed-white">FAQ's</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-12">
                            <div class="px-4">
                                <h6 class="fw-medium fs-14 text-secondary text-decoration-underline link-offset-3">
                                    INFO</h6>
                                <ul class="list-unstyled op-8 fw-normal landing-footer-list">
                                    <li>
                                        <a href="{{ route('auth.register') }}" class="text-fixed-white">Create
                                            Account</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="text-fixed-white">Login </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="text-fixed-white">Reset Password</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mb-md-0 mb-3">
                            <div class="px-4">
                                <p class="fw-medium mb-3">
                                    <a href="index.html"><img src="{{ asset('assets/images/level10.png') }}"
                                            alt="" class="landing-footer-logo"></a>
                                </p>
                                <p class="mb-2 op-6 fw-normal">
                                    IPTS is a transformative solution designed to streamline revenue collection and
                                    enhance transparency for
                                    local assemblies across Africa.

                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-11 -->

            <div class="text-center landing-main-footer py-3 text-muted">
                <span class="text-muted fs-15">
                    Copyright ©
                    <span id="year"></span>
                    <a href="https://level10gh.com/" class="text-primary fw-medium"><u>IPTS</u></a>.
                    Managed by Level 10 </a>.
                    All rights reserved.
                </span>
            </div>

        </div>
        <!-- End::app-content -->

    </div>

    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.js') }}"></script>

    <!-- Internal Landing JS -->
    <script src="{{ asset('assets/js/landing.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Landing Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

</body>
