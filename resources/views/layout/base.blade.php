<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ asset('assets/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> IPTS - Level 10 </title>
    <meta name="Description" content="IPTS- Level 10">
    <meta name="Author" content="IPTS- Level 10">
    <meta name="keywords" content="IPTS- Level 10">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/level10.png') }}" type="image/x-icon">

    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('page-styles')
</head>

<body>


    <!--*******************
        Preloader start
    ********************-->
    <div id="loader">
        <img src="{{ asset('assets/images/media/loader.svg') }}" alt="">
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div class="page">
        <!-- app-header -->
        <header class="app-header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="{{ route('dashboard.operational') }}" class="header-logo">
                                <img src="{{ asset('assets/images/level10.png') }}" alt="logo"
                                    class="desktop-logo">
                                <img src="{{ asset('assets/images/level10.png') }}" alt="logo" class="toggle-logo">
                                <img src="{{ asset('assets/images/level10.png') }}" alt="logo"
                                    class="desktop-white">
                                <img src="{{ asset('assets/images/level10.png') }}" alt="logo"
                                    class="toggle-white">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element mx-lg-0 mx-2">
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    {{-- <div class="header-element header-search d-lg-block d-none my-auto auto-complete-search">
                        <!-- Start::header-link -->
                        <input type="text" class="header-search-bar form-control rounded-pill" id="header-search"
                            placeholder="Search for Results..." spellcheck=false autocomplete="off"
                            autocapitalize="off">
                        <a href="javascript:void(0);" class="header-search-icon border-0">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#5f6368">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                            </svg>
                        </a>
                        <!-- End::header-link -->
                    </div> --}}

                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                    <!-- Start::header-element -->
                    <div class="header-element d-lg-none d-flex">
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                            data-bs-target="#responsive-searchModal">
                            <!-- Start::header-link-icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" height="24px"
                                viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                <path
                                    d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                            </svg>
                            <!-- End::header-link-icon -->
                        </a>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->

                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element header-theme-mode">
                        <!-- Start::header-link|layout-setting -->
                        <a href="javascript:void(0);" class="header-link layout-setting">
                            <span class="light-layout">
                                <!-- Start::header-link-icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon"
                                    enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
                                    fill="#5f6368">
                                    <rect fill="none" height="24" width="24" />
                                    <path
                                        d="M9.37,5.51C9.19,6.15,9.1,6.82,9.1,7.5c0,4.08,3.32,7.4,7.4,7.4c0.68,0,1.35-0.09,1.99-0.27C17.45,17.19,14.93,19,12,19 c-3.86,0-7-3.14-7-7C5,9.07,6.81,6.55,9.37,5.51z M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36 c-0.98,1.37-2.58,2.26-4.4,2.26c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z" />
                                </svg>
                                <!-- End::header-link-icon -->
                            </span>
                            <span class="dark-layout">
                                <!-- Start::header-link-icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M6.76 4.84l-1.8-1.79-1.41 1.41 1.79 1.79zM1 10.5h3v2H1zM11 .55h2V3.5h-2zm8.04 2.495l1.408 1.407-1.79 1.79-1.407-1.408zm-1.8 15.115l1.79 1.8 1.41-1.41-1.8-1.79zM20 10.5h3v2h-3zm-8-5c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm-1 4h2v2.95h-2zm-7.45-.96l1.41 1.41 1.79-1.8-1.41-1.41z" />
                                </svg>
                                <!-- End::header-link-icon -->
                            </span>
                        </a>
                        <!-- End::header-link|layout-setting -->
                    </div>
                    <!-- End::header-element -->



                    <!-- Start::header-element -->
                    {{-- <div class="header-element notifications-dropdown dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z" />
                            </svg>
                            <span class="header-icon-pulse bg-secondary rounded pulse pulse-secondary"></span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                            data-popper-placement="none">
                            <div class="p-3 bg-light bg-opacity-75">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 fw-semibold">Notifications</p>
                                    <span class="badge bg-pink" id="notifiation-data">5 Unread</span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0" id="header-notification-scroll">
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span
                                                class="avatar avatar-md offline bg-primary-transparent avatar-rounded">
                                                <img src="../assets/images/faces/1.jpg" alt="Sonia Agarwal">
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-medium"><a href="chat.html">Sonia Agarwal</a></p>
                                                <div class="fw-normal header-notification-text text-muted">
                                                    <span class="fw-medium fs-12 text-success">Approval</span> for the
                                                    Insurance
                                                </div>
                                                <span class="text-muted header-notification-text fs-11">7 mins
                                                    ago</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="text-muted me-1 dropdown-item-close1">
                                                    <i class="ti ti-trash fs-16"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span
                                                class="avatar avatar-md offline bg-primary-transparent avatar-rounded">
                                                <img src="../assets/images/faces/12.jpg" alt="Rajesh Kumar">
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-medium"><a href="chat.html">Rajesh Kumar</a></p>
                                                <div class="fw-normal header-notification-text text-muted">
                                                    <span class="fw-medium fs-12 text-warning">Urgent Request</span>
                                                    for project
                                                </div>
                                                <span class="text-muted header-notification-text fs-11">3 hours
                                                    ago</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="text-muted me-1 dropdown-item-close1">
                                                    <i class="ti ti-trash fs-16"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span
                                                class="avatar avatar-md offline bg-success-transparent avatar-rounded">
                                                <img src="../assets/images/faces/3.jpg" alt="Ayesha Malik">
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-medium"><a href="chat.html">Ayesha Malik</a></p>
                                                <div class="fw-normal header-notification-text text-muted">
                                                    <span class="fw-medium fs-12 text-info">Task Completed</span> for
                                                    redesign
                                                </div>
                                                <span class="text-muted header-notification-text fs-11">2 hours
                                                    ago</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="text-muted me-1 dropdown-item-close1">
                                                    <i class="ti ti-trash fs-16"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span class="avatar avatar-md online bg-danger-transparent avatar-rounded">
                                                <img src="../assets/images/faces/14.jpg" alt="Mohan Desai">
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-medium"><a href="chat.html">Mohan Desai</a></p>
                                                <div class="fw-normal header-notification-text text-muted">
                                                    <span class="fw-medium fs-12 text-danger">New Message</span> about
                                                    client meeting
                                                </div>
                                                <span class="text-muted header-notification-text fs-11">15 mins
                                                    ago</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="text-muted me-1 dropdown-item-close1">
                                                    <i class="ti ti-trash fs-16"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span
                                                class="avatar avatar-md offline bg-warning-transparent avatar-rounded">
                                                <img src="../assets/images/faces/5.jpg" alt="Priya Sharma">
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-medium"><a href="chat.html">Priya Sharma</a></p>
                                                <div class="fw-normal header-notification-text text-muted">
                                                    <span class="fw-medium fs-12 text-warning">Meeting Reminder</span>
                                                    scheduled for 3:00 PM
                                                </div>
                                                <span class="text-muted header-notification-text fs-11">30 mins
                                                    ago</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="text-muted me-1 dropdown-item-close1">
                                                    <i class="ti ti-trash fs-16"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="p-3 empty-header-item1 border-top">
                                <div class="d-grid">
                                    <a href="chat.html" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                            <div class="p-5 empty-item1 d-none">
                                <div class="text-center">
                                    <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                        <i class="ri-notification-off-line fs-2"></i>
                                    </span>
                                    <h6 class="fw-semibold mt-3">No New Notifications</h6>
                                </div>
                            </div>
                        </div>
                        <!-- End::main-header-dropdown -->
                    </div> --}}
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element header-shortcuts-dropdown dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" id="notificationDropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon"
                                enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#5f6368">
                                <g>
                                    <rect fill="none" height="24" width="24" />
                                </g>
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M3,3v8h8V3H3z M9,9H5V5h4V9z M3,13v8h8v-8H3z M9,19H5v-4h4V19z M13,3v8h8V3H13z M19,9h-4V5h4V9z M13,13v8h8v-8H13z M19,19h-4v-4h4V19z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown header-shortcuts-dropdown dropdown-menu pb-0 dropdown-menu-end"
                            aria-labelledby="notificationDropdown">
                            <div class="p-3 bg-light bg-opacity-75">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 fw-semibold">Current Time </p>
                                    <span class="badge bg-pink"> -
                                        {{ \Carbon\Carbon::now()->format('l, F j, Y  ') }}</span>
                                </div>
                            </div>
                            <div class="dropdown-divider mb-0"></div>
                            <div class="main-header-shortcuts p-3" id="header-shortcut-scroll">
                                <div class="row g-2">
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="related-apps">
                                            <div
                                                class="text-center p-3 related-app pink bg-pink-transparent border border-pink border-opacity-10">
                                                <span
                                                    class="avatar avatar-md avatar-rounded bg-pink bg-opacity-10 border border-pink border-opacity-10 p-2 mb-2">
                                                    <img src="../assets/images/apps/figma.png" alt="">
                                                </span>
                                                <span class="d-block fs-12">Pay Bill </span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="related-apps">
                                            <div
                                                class="text-center p-3 related-app success bg-success-transparent border border-success border-opacity-10">
                                                <span
                                                    class="avatar avatar-md avatar-rounded bg-success bg-opacity-10 border border-success border-opacity-10 p-2 mb-2">
                                                    <img src="../assets/images/apps/microsoft-powerpoint.png"
                                                        alt="">
                                                </span>
                                                <span class="d-block fs-12">View Bills</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="related-apps">
                                            <div
                                                class="text-center p-3 related-app primary bg-primary-transparent border border-primary border-opacity-10">
                                                <span
                                                    class="avatar avatar-md avatar-rounded bg-primary bg-opacity-10 border border-primary border-opacity-10 p-2 mb-2">
                                                    <img src="../assets/images/apps/microsoft-word.png"
                                                        alt="">
                                                </span>
                                                <span class="d-block fs-12">Dashboard</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="related-apps">
                                            <div
                                                class="text-center p-3 related-app info bg-info-transparent border border-info border-opacity-10">
                                                <span
                                                    class="avatar avatar-md avatar-rounded bg-info bg-opacity-10 border border-info border-opacity-10 p-2 mb-2">
                                                    <img src="../assets/images/apps/calender.png" alt="">
                                                </span>
                                                <span class="d-block fs-12">Calendar</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="related-apps">
                                            <div
                                                class="text-center p-3 related-app secondary bg-secondary-transparent border border-secondary border-opacity-10">
                                                <span
                                                    class="avatar avatar-md avatar-rounded bg-secondary bg-opacity-10 border border-secondary border-opacity-10 p-2 mb-2">
                                                    <img src="../assets/images/apps/sketch.png" alt="">
                                                </span>
                                                <span class="d-block fs-12">Sketch</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="related-apps">
                                            <div
                                                class="text-center p-3 related-app danger bg-danger-transparent border border-danger border-opacity-10">
                                                <span
                                                    class="avatar avatar-md avatar-rounded bg-danger bg-opacity-10 border border-danger border-opacity-10 p-2 mb-2">
                                                    <img src="../assets/images/apps/google.png" alt="">
                                                </span>
                                                <span class="d-block fs-12">Google</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="d-grid">
                                    <a href="javascript:void(0);" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>
                        <!-- End::main-header-dropdown -->
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element header-fullscreen">
                        <!-- Start::header-link -->
                        <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="full-screen-open header-link-icon"
                                height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="full-screen-close header-link-icon d-none"
                                height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M5 16h3v3h2v-5H5v2zm3-8H5v2h5V5H8v3zm6 11h2v-3h3v-2h-5v5zm2-11V5h-2v5h5V8h-3z" />
                            </svg>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <span class="avatar avatar-sm avatar-rounded">
                                <img src="{{ asset('assets/images/arms.png') }}" alt="img" class="img-fluid">
                            </span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            <li class="p-3 bg-light bg-opacity-75 border-bottom">
                                <div class="d-flex align-items-center justify-content-between gap-4">
                                    <div>
                                        <p class="mb-0 fw-semibold lh-1">
                                        <h6>{{ auth()->user()->name ?? '' }}</h6>
                                        </p>
                                        <span class="fs-11 text-muted">{{ auth()->user()->access_level ?? '' }}</span>
                                    </div>
                                    <span
                                        class="badge bg-pink align-self-end mb-1">{{ auth()->user()->phone ?? '' }}</span>
                                </div>
                            </li>
                            {{-- <li><a class="dropdown-item d-flex align-items-center" href="profile.html"><i
                                        class="ti ti-user-circle fs-18 me-2 text-gray fw-normal"></i>My Profile</a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="mail.html"><i
                                        class="ti ti-inbox fs-18 me-2 text-gray fw-normal"></i>Mail Inbox <span
                                        class="badge bg-success ms-auto">06</span></a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="mail-settings.html"><i
                                        class="ti ti-adjustments-horizontal fs-18 me-2 text-gray fw-normal"></i>Account
                                    Settings</a></li>

                                    <li>
                                <hr class="dropdown-divider">
                            </li> --}}
                            <li><a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('auth.logout') }}"><i
                                        class="ti ti-logout fs-18 me-2 text-gray fw-normal"></i>Sign Out</a></li>
                        </ul>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    {{-- <div class="header-element">
                        <!-- Start::header-link|switcher-icon -->
                        <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas"
                            data-bs-target="#switcher-canvas">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                            </svg>
                        </a>
                        <!-- End::header-link|switcher-icon -->
                    </div> --}}
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="{{ route('dashboard.operational') }}" class="header-logo">
                    <img src="../assets/images/level10.png" alt="logo" class="desktop-logo">
                    <img src="../assets/images/level10.png" alt="logo" class="toggle-logo">
                    <img src="../assets/images/level10.png" alt="logo" class="desktop-white">
                    <img src="../assets/images/level10.png" alt="logo" class="toggle-white">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Main</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                                    <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                                </svg>
                                <span class="side-menu__label">Dashboards</span>
                                <i class="ri-arrow-right-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                @canany(['dashboards.operational'])
                                    <li class="slide side-menu__label1">
                                        @can('dashboards.operational')
                                            <a href="{{ route('dashboard.operational') }}">Dashboards</a>
                                        @endcan
                                    </li>
                                @endcanany
                                @canany(['users.view', 'roles.view', 'permissions.view'])
                                    <li class="slide">
                                        <a href="{{ route('dashboard.operational') }}"
                                            class="side-menu__item">Overview</a>
                                    </li>
                                @endcanany
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">User & Payment </span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        @canany(['users.view', 'roles.view', 'permissions.view'])
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3" />
                                        <path
                                            d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                                    </svg>
                                    <span class="side-menu__label">User Management</span>
                                    <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    @can('users.view')
                                        <li class="slide">
                                            <a href="{{ route('users.index') }}" class="side-menu__item">Users</a>
                                        </li>
                                    @endcan
                                    @can('roles.view')
                                        <li class="slide">
                                            <a href="{{ route('roles.index') }}" class="side-menu__item">Roles
                                            </a>
                                        </li>
                                    @endcan
                                    @can('permissions.view')
                                        <li class="slide">
                                            <a href="{{ route('permissions.index') }}" class="side-menu__item">
                                                Permissions</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        @canany(['customer-types.view', 'customers.view'])
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3" />
                                        <path
                                            d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                                    </svg>
                                    <span class="side-menu__label">Rate Payer Mgnt</span>
                                    <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    @can('customers.view')
                                        <li class="slide">
                                            <a href="{{ route('citizens.index') }}" class="side-menu__item">View Rate Payers
                                            </a>
                                        </li>
                                    @endcan
                                    @can('customer-types.view')
                                        <li class="slide">
                                            <a href="{{ route('customer-types.index') }}" class="side-menu__item">View
                                                Rate Payer Types</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany

                        <!-- End::slide -->

                        <!-- Start::slide -->
                        @canany(['properties.view', 'businesses.view', 'business-classes.view', 'business-types.view'])

                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <g fill="none">
                                            <path d="M0 0h24v24H0V0z" />
                                            <path d="M0 0h24v24H0V0z" opacity=".87" />
                                        </g>
                                        <path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"
                                            opacity=".3" />
                                        <path
                                            d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                                    </svg>
                                    <span class="side-menu__label">Property & Business </span>
                                    <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">

                                    @can('properties.view')
                                        <li class="slide">
                                            <a href="{{ route('properties.index') }}" class="side-menu__item">Property
                                                Management</a>
                                        </li>
                                    @endcan
                                    @can('businesses.view')
                                        <li class="slide">
                                            <a href="{{ route('businesses.index') }}" class="side-menu__item">Business
                                                Management</a>
                                        </li>
                                    @endcan
                                    @can('business-classes.view')
                                        <li class="slide">
                                            <a href="{{ route('business-classes.index') }} " class="side-menu__item">Business
                                                Class</a>
                                        </li>
                                    @endcan

                                    @can('business-types.view')
                                        <li class="slide">
                                            <a href="{{ route('business-types.index') }} " class="side-menu__item">Business
                                                Type</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        @canany(['bills.view'])
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M5 5v14h14V5H5zm4 12H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"
                                            opacity=".3" />
                                        <path
                                            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                                    </svg>
                                    <span class="side-menu__label">Bills Management</span>
                                    <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    @can('bills.view')
                                        <li class="slide">
                                            <a href="{{ route('bills.fetchBill') }} " class="side-menu__item">All Bills</a>
                                        </li>
                                    @endcan
                                    @can('bills.create')
                                        <li class="slide">
                                            <a href="{{ route('bills.index') }}" class="side-menu__item">Generate Property
                                                Bill</a>
                                        </li>
                                    @endcan
                                    @can('bills.create')
                                        <li class="slide">
                                            <a href="{{ route('bills.bus.index') }}" class="side-menu__item">Generate BoP
                                                Bill</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        <!-- End::slide -->

                        @canany(['payments.view'])
                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Payments and Reports</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            @can('payments.view')
                                <li class="slide has-sub">
                                    <a href="javascript:void(0);" class="side-menu__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                            enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                            width="24px" fill="#5f6368">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                            </g>
                                            <g>
                                                <g>
                                                    <rect height="4" opacity=".3" width="4" x="5" y="5" />
                                                    <rect height="4" opacity=".3" width="4" x="5" y="15" />
                                                    <rect height="4" opacity=".3" width="4" x="15" y="15" />
                                                    <rect height="4" opacity=".3" width="4" x="15" y="5" />
                                                    <path d="M3,21h8v-8H3V21z M5,15h4v4H5V15z" />
                                                    <path d="M3,11h8V3H3V11z M5,5h4v4H5V5z" />
                                                    <path d="M13,21h8v-8h-8V21z M15,15h4v4h-4V15z" />
                                                    <path d="M13,3v8h8V3H13z M19,9h-4V5h4V9z" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="side-menu__label">Manage Payment</span>
                                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                    </a>
                                    <ul class="slide-menu child1">
                                        <li class="slide">
                                            <a href="{{ route('payments.index') }}" class="side-menu__item">View Payments
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                            <!-- End::slide -->
                        @endcanany

                        <!-- Start::slide -->
                        @canany(['reports.view'])
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
                                        <path
                                            d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
                                    </svg>
                                    <span class="side-menu__label">Reports</span>
                                    <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    @can('reports.view')
                                        <li class="slide">

                                            <a href="{{ route('customer-reports.index') }}" class="side-menu__item">Customer
                                                reports</a>
                                        </li>
                                    @endcan
                                    @can('reports.view')
                                        <li class="slide">
                                            <a href="{{ route('business-reports.index') }}" class="side-menu__item">Business
                                                reports</a>
                                        </li>
                                    @endcan
                                    @can('reports.view')
                                        <li class="slide">
                                            <a href="{{ route('property-reports.index') }}" class="side-menu__item">Property
                                                reports</a>
                                        </li>
                                    @endcan
                                    @can('reports.view')
                                        <li class="slide">
                                            <a href="{{ route('bill-reports.index') }}" class="side-menu__item">Bills
                                                reports</a>
                                        </li>
                                    @endcan
                                    @can('reports.view')
                                        <li class="slide">
                                            <a href="{{ route('payment-reports.index') }}" class="side-menu__item">Payment
                                                reports</a>
                                        </li>
                                    @endcan
                                    @can('reports.view')
                                        <li class="slide">
                                            <a href=" {{ route('debtors-reports.index') }}" class="side-menu__item">Debtors
                                                reports</a>
                                        </li>
                                    @endcan

                                </ul>
                            </li>
                        @endcanany
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        @canany(['assemblies.view', 'divisions.view', 'blocks.view', 'zones.view', 'property-uses.view',
                            'rates.view', 'agent-assignments.view', 'task-assignments.view'])
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
                                        <path
                                            d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
                                    </svg>
                                    <span class="side-menu__label">Assembly Setup</span>
                                    <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    @can('assemblies.view')
                                        <li class="slide">
                                            <a href="{{ route('assembly.index') }}" class="side-menu__item">
                                                Manage Assembly</a>
                                        </li>
                                    @endcan
                                    @can('divisions.view')
                                        <li class="slide">
                                            <a href="{{ route('divisions.index') }}" class="side-menu__item">
                                                Manage Division</a>
                                        </li>
                                    @endcan
                                    @can('blocks.view')
                                        <li class="slide">
                                            <a href="{{ route('blocks.index') }}" class="side-menu__item">
                                                Manage Block</a>
                                        </li>
                                    @endcan
                                    @can('zones.view')
                                        <li class="slide">
                                            <a href="{{ route('zones.index') }}" class="side-menu__item">
                                                Manage Zone</a>
                                        </li>
                                    @endcan
                                    @can('property-uses.view')
                                        <li class="slide">
                                            <a href="{{ route('property-users.index') }}" class="side-menu__item">
                                                Property Uses</a>
                                        </li>
                                    @endcan
                                    @can('rates.view')
                                        <li class="slide">
                                            <a href=" {{ route('rates.index') }}" class="side-menu__item">
                                                Manage Property Rate</a>
                                        </li>



                                        <li class="slide">
                                            <a href=" {{ route('rates.bus.index') }}" class="side-menu__item">
                                                Manage Bop Rate</a>
                                        </li>
                                    @endcan

                                    @can('agent-assignments.view')
                                        <li class="slide">
                                            <a href=" {{ route('agent-assignments.index') }}" class="side-menu__item">
                                                Agent Assignment</a>
                                        </li>
                                    @endcan
                                    @can('task-assignments.view')
                                        <li class="slide">
                                            <a href=" {{ route('task-assignments.index') }}" class="side-menu__item">
                                                Task Assignment</a>
                                        </li>
                                    @endcan

                                </ul>
                            </li>
                        @endcanany
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        {{-- <li class="slide__category"><span class="category-name">Notifications & Assistance</span></li> --}}
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        {{-- <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                    enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#5f6368">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                    </g>
                                    <g>
                                        <g>
                                            <polygon opacity=".3" points="4,7 20,7 20,3.98 4,4" />
                                            <path d="M5,20h14V9H5V20z M9,12h6v2H9V12z" opacity=".3" />
                                            <path
                                                d="M20,2H4C3,2,2,2.9,2,4v3.01C2,7.73,2.43,8.35,3,8.7V20c0,1.1,1.1,2,2,2h14c0.9,0,2-0.9,2-2V8.7c0.57-0.35,1-0.97,1-1.69V4 C22,2.9,21,2,20,2z M19,20H5V9h14V20z M20,7H4V4l16-0.02V7z" />
                                            <rect height="2" width="6" x="9" y="12" />
                                        </g>
                                    </g>
                                </svg>
                                <span class="side-menu__label">Notifications</span>
                                <i class="ri-arrow-right-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1 mega-menu">

                                <li class="slide">
                                    <a href="empty.html" class="side-menu__item">Payment Alerts</a>
                                </li>
                                <li class="slide">
                                    <a href="empty.html" class="side-menu__item">System Updates</a>
                                </li>
                                <li class="slide">
                                    <a href="empty.html" class="side-menu__item">User Reminders</a>
                                </li>
                            </ul>
                        </li> --}}
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        {{-- <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                    enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#5f6368">
                                    <g>
                                        <rect fill="none" height="24" width="24" y="0" />
                                    </g>
                                    <g>
                                        <g>
                                            <polygon opacity=".3" points="12.35,16.18 7.82,11.65 5.3,18.7" />
                                            <path
                                                d="M2,22l14-5L7,8L2,22z M12.35,16.18L5.3,18.7l2.52-7.05L12.35,16.18z" />
                                            <path
                                                d="M14.53,12.53l5.59-5.59c0.49-0.49,1.28-0.49,1.77,0l0.59,0.59l1.06-1.06l-0.59-0.59c-1.07-1.07-2.82-1.07-3.89,0 l-5.59,5.59L14.53,12.53z" />
                                            <path
                                                d="M9.47,7.47l1.06,1.06l0.59-0.59c1.07-1.07,1.07-2.82,0-3.89l-0.59-0.59L9.47,4.53l0.59,0.59c0.48,0.48,0.48,1.28,0,1.76 L9.47,7.47z" />
                                            <path
                                                d="M17.06,11.88l-1.59,1.59l1.06,1.06l1.59-1.59c0.49-0.49,1.28-0.49,1.77,0l1.61,1.61l1.06-1.06l-1.61-1.61 C19.87,10.81,18.13,10.81,17.06,11.88z" />
                                            <path
                                                d="M15.06,5.88l-3.59,3.59l1.06,1.06l3.59-3.59c1.07-1.07,1.07-2.82,0-3.89l-1.59-1.59l-1.06,1.06l1.59,1.59 C15.54,4.6,15.54,5.4,15.06,5.88z" />
                                        </g>
                                    </g>
                                </svg>
                                <span class="side-menu__label">AI Assistant</span>
                                <i class="ri-arrow-right-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">


                            </ul>
                        </li> --}}
                        <!-- End::slide -->


                        <!-- Start::slide__category -->
                        {{-- <li class="slide__category"><span class="category-name">Feedback & Support</span></li> --}}
                        <!-- End::slide__category -->
                        @if (auth()->user()->access_level == 'customer')
                            <!-- Start::slide__category -->
                            {{-- <li class="slide__category"><span class="category-name">My Rate Payer Account</span></li> --}}
                            <!-- End::slide__category -->

                            <li class="slide">
                                <a href="{{ route('dashboard.operational') }}" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                        enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                        width="24px" fill="#5f6368">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <g />
                                            <g>
                                                <path
                                                    d="M6.44,9.86L7.02,5H5.05L4.04,9.36c-0.1,0.42-0.01,0.84,0.25,1.17C4.43,10.71,4.73,11,5.23,11 C5.84,11,6.36,10.51,6.44,9.86z"
                                                    opacity=".3" />
                                                <path
                                                    d="M9.71,11C10.45,11,11,10.41,11,9.69V5H9.04L8.49,9.52c-0.05,0.39,0.07,0.78,0.33,1.07 C9.05,10.85,9.37,11,9.71,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M14.22,11c0.41,0,0.72-0.15,0.96-0.41c0.25-0.29,0.37-0.68,0.33-1.07L14.96,5H13v4.69 C13,10.41,13.55,11,14.22,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M18.91,4.99L16.98,5l0.58,4.86c0.08,0.65,0.6,1.14,1.21,1.14c0.49,0,0.8-0.29,0.93-0.47 c0.26-0.33,0.35-0.76,0.25-1.17L18.91,4.99z"
                                                    opacity=".3" />
                                                <path
                                                    d="M21.9,8.89l-1.05-4.37c-0.22-0.9-1-1.52-1.91-1.52H5.05C4.15,3,3.36,3.63,3.15,4.52L2.1,8.89 c-0.24,1.02-0.02,2.06,0.62,2.88C2.8,11.88,2.91,11.96,3,12.06V19c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2v-6.94 c0.09-0.09,0.2-0.18,0.28-0.28C21.92,10.96,22.15,9.91,21.9,8.89z M13,5h1.96l0.54,4.52c0.05,0.39-0.07,0.78-0.33,1.07 C14.95,10.85,14.63,11,14.22,11C13.55,11,13,10.41,13,9.69V5z M8.49,9.52L9.04,5H11v4.69C11,10.41,10.45,11,9.71,11 c-0.34,0-0.65-0.15-0.89-0.41C8.57,10.3,8.45,9.91,8.49,9.52z M4.29,10.53c-0.26-0.33-0.35-0.76-0.25-1.17L5.05,5h1.97L6.44,9.86 C6.36,10.51,5.84,11,5.23,11C4.73,11,4.43,10.71,4.29,10.53z M19,19H5v-6.03C5.08,12.98,5.15,13,5.23,13 c0.87,0,1.66-0.36,2.24-0.95c0.6,0.6,1.4,0.95,2.31,0.95c0.87,0,1.65-0.36,2.23-0.93c0.59,0.57,1.39,0.93,2.29,0.93 c0.84,0,1.64-0.35,2.24-0.95c0.58,0.59,1.37,0.95,2.24,0.95c0.08,0,0.15-0.02,0.23-0.03V19z M19.71,10.53 C19.57,10.71,19.27,11,18.77,11c-0.61,0-1.14-0.49-1.21-1.14L16.98,5l1.93-0.01l1.05,4.37C20.06,9.78,19.97,10.21,19.71,10.53z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="side-menu__label">My Account</span>
                                </a>
                            </li>


                            <li class="slide">
                                <a href="{{ route('dashboard.mybills') }}" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                        enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                        width="24px" fill="#5f6368">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <g />
                                            <g>
                                                <path
                                                    d="M6.44,9.86L7.02,5H5.05L4.04,9.36c-0.1,0.42-0.01,0.84,0.25,1.17C4.43,10.71,4.73,11,5.23,11 C5.84,11,6.36,10.51,6.44,9.86z"
                                                    opacity=".3" />
                                                <path
                                                    d="M9.71,11C10.45,11,11,10.41,11,9.69V5H9.04L8.49,9.52c-0.05,0.39,0.07,0.78,0.33,1.07 C9.05,10.85,9.37,11,9.71,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M14.22,11c0.41,0,0.72-0.15,0.96-0.41c0.25-0.29,0.37-0.68,0.33-1.07L14.96,5H13v4.69 C13,10.41,13.55,11,14.22,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M18.91,4.99L16.98,5l0.58,4.86c0.08,0.65,0.6,1.14,1.21,1.14c0.49,0,0.8-0.29,0.93-0.47 c0.26-0.33,0.35-0.76,0.25-1.17L18.91,4.99z"
                                                    opacity=".3" />
                                                <path
                                                    d="M21.9,8.89l-1.05-4.37c-0.22-0.9-1-1.52-1.91-1.52H5.05C4.15,3,3.36,3.63,3.15,4.52L2.1,8.89 c-0.24,1.02-0.02,2.06,0.62,2.88C2.8,11.88,2.91,11.96,3,12.06V19c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2v-6.94 c0.09-0.09,0.2-0.18,0.28-0.28C21.92,10.96,22.15,9.91,21.9,8.89z M13,5h1.96l0.54,4.52c0.05,0.39-0.07,0.78-0.33,1.07 C14.95,10.85,14.63,11,14.22,11C13.55,11,13,10.41,13,9.69V5z M8.49,9.52L9.04,5H11v4.69C11,10.41,10.45,11,9.71,11 c-0.34,0-0.65-0.15-0.89-0.41C8.57,10.3,8.45,9.91,8.49,9.52z M4.29,10.53c-0.26-0.33-0.35-0.76-0.25-1.17L5.05,5h1.97L6.44,9.86 C6.36,10.51,5.84,11,5.23,11C4.73,11,4.43,10.71,4.29,10.53z M19,19H5v-6.03C5.08,12.98,5.15,13,5.23,13 c0.87,0,1.66-0.36,2.24-0.95c0.6,0.6,1.4,0.95,2.31,0.95c0.87,0,1.65-0.36,2.23-0.93c0.59,0.57,1.39,0.93,2.29,0.93 c0.84,0,1.64-0.35,2.24-0.95c0.58,0.59,1.37,0.95,2.24,0.95c0.08,0,0.15-0.02,0.23-0.03V19z M19.71,10.53 C19.57,10.71,19.27,11,18.77,11c-0.61,0-1.14-0.49-1.21-1.14L16.98,5l1.93-0.01l1.05,4.37C20.06,9.78,19.97,10.21,19.71,10.53z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="side-menu__label">My Bills</span>
                                </a>
                            </li>

                            <li class="slide">
                                <a href="{{ route('dashboard.myproperties') }}" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                        enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                        width="24px" fill="#5f6368">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <g />
                                            <g>
                                                <path
                                                    d="M6.44,9.86L7.02,5H5.05L4.04,9.36c-0.1,0.42-0.01,0.84,0.25,1.17C4.43,10.71,4.73,11,5.23,11 C5.84,11,6.36,10.51,6.44,9.86z"
                                                    opacity=".3" />
                                                <path
                                                    d="M9.71,11C10.45,11,11,10.41,11,9.69V5H9.04L8.49,9.52c-0.05,0.39,0.07,0.78,0.33,1.07 C9.05,10.85,9.37,11,9.71,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M14.22,11c0.41,0,0.72-0.15,0.96-0.41c0.25-0.29,0.37-0.68,0.33-1.07L14.96,5H13v4.69 C13,10.41,13.55,11,14.22,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M18.91,4.99L16.98,5l0.58,4.86c0.08,0.65,0.6,1.14,1.21,1.14c0.49,0,0.8-0.29,0.93-0.47 c0.26-0.33,0.35-0.76,0.25-1.17L18.91,4.99z"
                                                    opacity=".3" />
                                                <path
                                                    d="M21.9,8.89l-1.05-4.37c-0.22-0.9-1-1.52-1.91-1.52H5.05C4.15,3,3.36,3.63,3.15,4.52L2.1,8.89 c-0.24,1.02-0.02,2.06,0.62,2.88C2.8,11.88,2.91,11.96,3,12.06V19c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2v-6.94 c0.09-0.09,0.2-0.18,0.28-0.28C21.92,10.96,22.15,9.91,21.9,8.89z M13,5h1.96l0.54,4.52c0.05,0.39-0.07,0.78-0.33,1.07 C14.95,10.85,14.63,11,14.22,11C13.55,11,13,10.41,13,9.69V5z M8.49,9.52L9.04,5H11v4.69C11,10.41,10.45,11,9.71,11 c-0.34,0-0.65-0.15-0.89-0.41C8.57,10.3,8.45,9.91,8.49,9.52z M4.29,10.53c-0.26-0.33-0.35-0.76-0.25-1.17L5.05,5h1.97L6.44,9.86 C6.36,10.51,5.84,11,5.23,11C4.73,11,4.43,10.71,4.29,10.53z M19,19H5v-6.03C5.08,12.98,5.15,13,5.23,13 c0.87,0,1.66-0.36,2.24-0.95c0.6,0.6,1.4,0.95,2.31,0.95c0.87,0,1.65-0.36,2.23-0.93c0.59,0.57,1.39,0.93,2.29,0.93 c0.84,0,1.64-0.35,2.24-0.95c0.58,0.59,1.37,0.95,2.24,0.95c0.08,0,0.15-0.02,0.23-0.03V19z M19.71,10.53 C19.57,10.71,19.27,11,18.77,11c-0.61,0-1.14-0.49-1.21-1.14L16.98,5l1.93-0.01l1.05,4.37C20.06,9.78,19.97,10.21,19.71,10.53z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="side-menu__label">My Properties</span>
                                </a>
                            </li>

                            <li class="slide">
                                <a href="{{ route('dashboard.mybusiness') }}" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                        enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                        width="24px" fill="#5f6368">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <g />
                                            <g>
                                                <path
                                                    d="M6.44,9.86L7.02,5H5.05L4.04,9.36c-0.1,0.42-0.01,0.84,0.25,1.17C4.43,10.71,4.73,11,5.23,11 C5.84,11,6.36,10.51,6.44,9.86z"
                                                    opacity=".3" />
                                                <path
                                                    d="M9.71,11C10.45,11,11,10.41,11,9.69V5H9.04L8.49,9.52c-0.05,0.39,0.07,0.78,0.33,1.07 C9.05,10.85,9.37,11,9.71,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M14.22,11c0.41,0,0.72-0.15,0.96-0.41c0.25-0.29,0.37-0.68,0.33-1.07L14.96,5H13v4.69 C13,10.41,13.55,11,14.22,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M18.91,4.99L16.98,5l0.58,4.86c0.08,0.65,0.6,1.14,1.21,1.14c0.49,0,0.8-0.29,0.93-0.47 c0.26-0.33,0.35-0.76,0.25-1.17L18.91,4.99z"
                                                    opacity=".3" />
                                                <path
                                                    d="M21.9,8.89l-1.05-4.37c-0.22-0.9-1-1.52-1.91-1.52H5.05C4.15,3,3.36,3.63,3.15,4.52L2.1,8.89 c-0.24,1.02-0.02,2.06,0.62,2.88C2.8,11.88,2.91,11.96,3,12.06V19c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2v-6.94 c0.09-0.09,0.2-0.18,0.28-0.28C21.92,10.96,22.15,9.91,21.9,8.89z M13,5h1.96l0.54,4.52c0.05,0.39-0.07,0.78-0.33,1.07 C14.95,10.85,14.63,11,14.22,11C13.55,11,13,10.41,13,9.69V5z M8.49,9.52L9.04,5H11v4.69C11,10.41,10.45,11,9.71,11 c-0.34,0-0.65-0.15-0.89-0.41C8.57,10.3,8.45,9.91,8.49,9.52z M4.29,10.53c-0.26-0.33-0.35-0.76-0.25-1.17L5.05,5h1.97L6.44,9.86 C6.36,10.51,5.84,11,5.23,11C4.73,11,4.43,10.71,4.29,10.53z M19,19H5v-6.03C5.08,12.98,5.15,13,5.23,13 c0.87,0,1.66-0.36,2.24-0.95c0.6,0.6,1.4,0.95,2.31,0.95c0.87,0,1.65-0.36,2.23-0.93c0.59,0.57,1.39,0.93,2.29,0.93 c0.84,0,1.64-0.35,2.24-0.95c0.58,0.59,1.37,0.95,2.24,0.95c0.08,0,0.15-0.02,0.23-0.03V19z M19.71,10.53 C19.57,10.71,19.27,11,18.77,11c-0.61,0-1.14-0.49-1.21-1.14L16.98,5l1.93-0.01l1.05,4.37C20.06,9.78,19.97,10.21,19.71,10.53z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="side-menu__label">My Businessess</span>
                                </a>
                            </li>

                            <li class="slide">
                                <a href="{{ route('dashboard.mypaymenthistory') }}" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                        enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                        width="24px" fill="#5f6368">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <g />
                                            <g>
                                                <path
                                                    d="M6.44,9.86L7.02,5H5.05L4.04,9.36c-0.1,0.42-0.01,0.84,0.25,1.17C4.43,10.71,4.73,11,5.23,11 C5.84,11,6.36,10.51,6.44,9.86z"
                                                    opacity=".3" />
                                                <path
                                                    d="M9.71,11C10.45,11,11,10.41,11,9.69V5H9.04L8.49,9.52c-0.05,0.39,0.07,0.78,0.33,1.07 C9.05,10.85,9.37,11,9.71,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M14.22,11c0.41,0,0.72-0.15,0.96-0.41c0.25-0.29,0.37-0.68,0.33-1.07L14.96,5H13v4.69 C13,10.41,13.55,11,14.22,11z"
                                                    opacity=".3" />
                                                <path
                                                    d="M18.91,4.99L16.98,5l0.58,4.86c0.08,0.65,0.6,1.14,1.21,1.14c0.49,0,0.8-0.29,0.93-0.47 c0.26-0.33,0.35-0.76,0.25-1.17L18.91,4.99z"
                                                    opacity=".3" />
                                                <path
                                                    d="M21.9,8.89l-1.05-4.37c-0.22-0.9-1-1.52-1.91-1.52H5.05C4.15,3,3.36,3.63,3.15,4.52L2.1,8.89 c-0.24,1.02-0.02,2.06,0.62,2.88C2.8,11.88,2.91,11.96,3,12.06V19c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2v-6.94 c0.09-0.09,0.2-0.18,0.28-0.28C21.92,10.96,22.15,9.91,21.9,8.89z M13,5h1.96l0.54,4.52c0.05,0.39-0.07,0.78-0.33,1.07 C14.95,10.85,14.63,11,14.22,11C13.55,11,13,10.41,13,9.69V5z M8.49,9.52L9.04,5H11v4.69C11,10.41,10.45,11,9.71,11 c-0.34,0-0.65-0.15-0.89-0.41C8.57,10.3,8.45,9.91,8.49,9.52z M4.29,10.53c-0.26-0.33-0.35-0.76-0.25-1.17L5.05,5h1.97L6.44,9.86 C6.36,10.51,5.84,11,5.23,11C4.73,11,4.43,10.71,4.29,10.53z M19,19H5v-6.03C5.08,12.98,5.15,13,5.23,13 c0.87,0,1.66-0.36,2.24-0.95c0.6,0.6,1.4,0.95,2.31,0.95c0.87,0,1.65-0.36,2.23-0.93c0.59,0.57,1.39,0.93,2.29,0.93 c0.84,0,1.64-0.35,2.24-0.95c0.58,0.59,1.37,0.95,2.24,0.95c0.08,0,0.15-0.02,0.23-0.03V19z M19.71,10.53 C19.57,10.71,19.27,11,18.77,11c-0.61,0-1.14-0.49-1.21-1.14L16.98,5l1.93-0.01l1.05,4.37C20.06,9.78,19.97,10.21,19.71,10.53z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="side-menu__label">My Payment History</span>
                                </a>
                            </li>

                            <!-- Start::slide -->
                            {{-- <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M5 5v14h14V5H5zm4 12H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"
                                            opacity=".3" />
                                        <path
                                            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                                    </svg>
                                    <span class="side-menu__label">Feedback & Support</span>
                                    <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">

                                </ul>
                            </li> --}}
                            <!-- End::slide -->
                        @endif

                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    {{-- <h1 class="page-title fw-semibold fs-18 mb-0">Melchia Dashboard</h1> --}}
                    <div class="ms-md-1 ms-0">
                        <nav>
                            <!-- <ol class="breadcrumb mb-0"> -->
                            <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboards</a></li> -->

                            <!-- </ol> -->
                        </nav>
                    </div>
                </div>
                <!-- Page Header Close -->


                <!-- Start:: row-4 -->
                @yield('page-content')
                <!-- End:: row-4 -->



            </div>
        </div>
        <!-- End::app-content -->


        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted">
                    Copyright © <span id="year"></span>
                    <a href="javascript:void(0);" class="text-dark fw-semibold"> LEVEL10 COMMUNICATIONS TECHNOLOGIES
                        LIMITED </a>.

                    All rights reserved.
                </span>
            </div>
        </footer>
        <!-- Footer End -->
        <div class="modal fade" id="responsive-searchModal" tabindex="-1" aria-labelledby="responsive-searchModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Search Anything ..."
                                aria-label="Search Anything ..." aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="button-addon2"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Jquery Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Auto Complete JS -->
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>


    <!-- Apex Charts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Jobs-Dashboard -->
    <script src="{{ asset('assets/js/jobs-dashboard.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>


    <!-- Custom-Switcher JS -->
    <script src="{{ asset('assets/js/custom-switcher.js') }}"></script>

    <!-- JSVector Maps MapsJS -->
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/us-merc-en.js') }}"></script>
    <script src="{{ asset('assets/js/russia.js') }}"></script>
    <script src="{{ asset('assets/js/spain.js') }}"></script>
    <script src="{{ asset('assets/js/canada.js') }}"></script>
    <script src="{{ asset('assets/js/jsvectormap.js') }}"></script>


    <!-- Jquery Cdn -->

    <!-- Datatables Cdn -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- Internal Datatables JS -->
    <script src="{{ asset('assets/js/datatables.js') }}"></script>


    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('page-scripts')
</body>

</html>
