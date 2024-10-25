<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ asset('assets/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ERMS App">
    <meta property="og:title" content="ERMS App">
    <meta property="og:description" content="ERMS App">
    <meta property="og:image" content="https://yeshadmin.dexignzone.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>iTax System</title>
    <!-- FAVICONS ICON -->

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css') }}">
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

    <!-- tagify-css -->
    <link href="{{ asset('assets/vendor/tagify/dist/tagify.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('page-styles')
</head>

<body>

    <style>
        .content-body1 {
            /* Center the background image */
            background-position: center center;
            /* Make the background image cover the entire container */
            background-size: cover;
            /* Set the background image */
            background-image: url('{{ asset('assets/images/arms.png') }}');
            /* Apply opacity to the background image */
            opacity: 0.5;
            /* Adjust the opacity value as needed */
            /* Other styles for the container */
            /* For example, set the height of the container to fit its content */
            min-height: 100vh;
            /* Add other styles as needed */
        }
    </style>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div>
            <img src="images/pre.gif" alt="">
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('dashboard.operational') }}" class="brand-logo">

                {{-- <img class="brand-title" src="{{ asset('assets/images/west.png') }}" alt="Your Brand Logo"> --}}

            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line">
                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.7468 5.58925C11.0722 5.26381 11.0722 4.73617 10.7468 4.41073C10.4213 4.0853 9.89369 4.0853 9.56826 4.41073L4.56826 9.41073C4.25277 9.72622 4.24174 10.2342 4.54322 10.5631L9.12655 15.5631C9.43754 15.9024 9.96468 15.9253 10.3039 15.6143C10.6432 15.3033 10.6661 14.7762 10.3551 14.4369L6.31096 10.0251L10.7468 5.58925Z"
                                fill="#452B90" />
                            <path opacity="0.3"
                                d="M16.5801 5.58924C16.9056 5.26381 16.9056 4.73617 16.5801 4.41073C16.2547 4.0853 15.727 4.0853 15.4016 4.41073L10.4016 9.41073C10.0861 9.72622 10.0751 10.2342 10.3766 10.5631L14.9599 15.5631C15.2709 15.9024 15.798 15.9253 16.1373 15.6143C16.4766 15.3033 16.4995 14.7762 16.1885 14.4369L12.1443 10.0251L16.5801 5.58924Z"
                                fill="#452B90" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>
                        <div class="header-right d-flex align-items-center">

                            <ul class="navbar-nav">
                                <li class="nav-item dropdown notification_dropdown">
                                    <a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
                                        <svg id="icon-light" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                                <path
                                                    d="M19.5,10.5 L21,10.5 C21.8284271,10.5 22.5,11.1715729 22.5,12 C22.5,12.8284271 21.8284271,13.5 21,13.5 L19.5,13.5 C18.6715729,13.5 18,12.8284271 18,12 C18,11.1715729 18.6715729,10.5 19.5,10.5 Z M16.0606602,5.87132034 L17.1213203,4.81066017 C17.7071068,4.22487373 18.6568542,4.22487373 19.2426407,4.81066017 C19.8284271,5.39644661 19.8284271,6.34619408 19.2426407,6.93198052 L18.1819805,7.99264069 C17.5961941,8.57842712 16.6464466,8.57842712 16.0606602,7.99264069 C15.4748737,7.40685425 15.4748737,6.45710678 16.0606602,5.87132034 Z M16.0606602,18.1819805 C15.4748737,17.5961941 15.4748737,16.6464466 16.0606602,16.0606602 C16.6464466,15.4748737 17.5961941,15.4748737 18.1819805,16.0606602 L19.2426407,17.1213203 C19.8284271,17.7071068 19.8284271,18.6568542 19.2426407,19.2426407 C18.6568542,19.8284271 17.7071068,19.8284271 17.1213203,19.2426407 L16.0606602,18.1819805 Z M3,10.5 L4.5,10.5 C5.32842712,10.5 6,11.1715729 6,12 C6,12.8284271 5.32842712,13.5 4.5,13.5 L3,13.5 C2.17157288,13.5 1.5,12.8284271 1.5,12 C1.5,11.1715729 2.17157288,10.5 3,10.5 Z M12,1.5 C12.8284271,1.5 13.5,2.17157288 13.5,3 L13.5,4.5 C13.5,5.32842712 12.8284271,6 12,6 C11.1715729,6 10.5,5.32842712 10.5,4.5 L10.5,3 C10.5,2.17157288 11.1715729,1.5 12,1.5 Z M12,18 C12.8284271,18 13.5,18.6715729 13.5,19.5 L13.5,21 C13.5,21.8284271 12.8284271,22.5 12,22.5 C11.1715729,22.5 10.5,21.8284271 10.5,21 L10.5,19.5 C10.5,18.6715729 11.1715729,18 12,18 Z M4.81066017,4.81066017 C5.39644661,4.22487373 6.34619408,4.22487373 6.93198052,4.81066017 L7.99264069,5.87132034 C8.57842712,6.45710678 8.57842712,7.40685425 7.99264069,7.99264069 C7.40685425,8.57842712 6.45710678,8.57842712 5.87132034,7.99264069 L4.81066017,6.93198052 C4.22487373,6.34619408 4.22487373,5.39644661 4.81066017,4.81066017 Z M4.81066017,19.2426407 C4.22487373,18.6568542 4.22487373,17.7071068 4.81066017,17.1213203 L5.87132034,16.0606602 C6.45710678,15.4748737 7.40685425,15.4748737 7.99264069,16.0606602 C8.57842712,16.6464466 8.57842712,17.5961941 7.99264069,18.1819805 L6.93198052,19.2426407 C6.34619408,19.8284271 5.39644661,19.8284271 4.81066017,19.2426407 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <svg id="icon-dark" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </a>
                                </li>

                                <li class="nav-item ps-3">
                                    <div class="dropdown header-profile2">
                                        <a class="nav-link" href="javascript:void(0);" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="header-info2 d-flex align-items-center">
                                                <div class="header-media">
                                                    <img src="{{ asset('assets/images/user2.jpg') }}" alt="">
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <div class="card border-0 mb-0">
                                                <div class="card-header py-2">
                                                    <div class="products">
                                                        <img src="{{ asset('assets/images/user2.jpg') }}"
                                                            class="avatar avatar-md" alt="">
                                                        <div>
                                                            <h6>{{ auth()->user()->name ?? '' }}</h6>
                                                            <span>{{ auth()->user()->access_level ?? '' }}</span>
                                                            <span>{{ auth()->user()->phone ?? '' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer px-0 py-2">

                                                    <!-- Logout Link -->
                                                    <a href="{{ route('auth.logout') }}"
                                                        class="dropdown-item ai-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                            height="18" viewBox="0 0 24 24" fill="none"
                                                            stroke="var(--primary)" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                            <polyline points="16 17 21 12 16 7"></polyline>
                                                            <line x1="21" y1="12" x2="9"
                                                                y2="12"></line>
                                                        </svg>
                                                        <span class="ms-2">Logout</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>


        <div class="deznav">
            <div style="display: flex; align-items: center; margin-top: -50px; margin-left: 20px;margin-bottom: 30px">
                <img src="{{ asset('assets/images/arms.png') }}" class="rounded-circle" alt=""
                    style="width: 50px; height: 50px;">

                <h5 style="color: white; margin-left: 10px;">ERMS PLUS</h5>
            </div>
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    @canany(['dashboards.operational'])
                        <li><a class="has-arrow " href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
                                            fill="#90959F" />
                                    </svg>
                                </div>
                                <span class="nav-text">Dashboard</span>
                            </a>
                            <ul>
                                @can('dashboards.operational')
                                    <li><a href="{{ route('dashboard.operational') }}">Operations </a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['users.view', 'roles.view', 'permissions.view'])
                        <li>
                            <a class="has-arrow " href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path
                                                d="M9.34933 14.8577C5.38553 14.8577 2 15.47 2 17.9174C2 20.3666 5.364 21 9.34933 21C13.3131 21 16.6987 20.3877 16.6987 17.9404C16.6987 15.4911 13.3347 14.8577 9.34933 14.8577Z"
                                                fill="white" />
                                            <path opacity="0.4"
                                                d="M9.34935 12.5248C12.049 12.5248 14.2124 10.4062 14.2124 7.76241C14.2124 5.11865 12.049 3 9.34935 3C6.65072 3 4.48633 5.11865 4.48633 7.76241C4.48633 10.4062 6.65072 12.5248 9.34935 12.5248Z"
                                                fill="white" />
                                            <path opacity="0.4"
                                                d="M16.1734 7.84876C16.1734 9.19508 15.7605 10.4513 15.0364 11.4948C14.9611 11.6022 15.0276 11.7468 15.1587 11.7698C15.3407 11.7996 15.5276 11.8178 15.7184 11.8216C17.6167 11.8705 19.3202 10.6736 19.7908 8.87119C20.4885 6.19677 18.4415 3.79544 15.8339 3.79544C15.5511 3.79544 15.2801 3.82419 15.0159 3.87689C14.9797 3.88456 14.9405 3.9018 14.921 3.93247C14.8955 3.97176 14.9141 4.02254 14.9395 4.05608C15.7233 5.13217 16.1734 6.44208 16.1734 7.84876Z"
                                                fill="white" />
                                            <path
                                                d="M21.7791 15.1693C21.4318 14.444 20.5932 13.9466 19.3173 13.7023C18.7155 13.5586 17.0854 13.3545 15.5697 13.3832C15.5472 13.3861 15.5345 13.4014 15.5325 13.411C15.5296 13.4263 15.5365 13.4493 15.5658 13.4656C16.2664 13.8048 18.9738 15.2805 18.6333 18.3928C18.6187 18.5289 18.7292 18.6439 18.8672 18.6247C19.5335 18.5318 21.2478 18.1705 21.7791 17.0475C22.0737 16.4534 22.0737 15.7634 21.7791 15.1693Z"
                                                fill="white" />
                                        </g>
                                    </svg>

                                </div>
                                <span class="nav-text">User Management</span>
                            </a>
                            <ul>
                                @can('users.view')
                                    <li><a class="has-arrow" href="javascript:void(0);">User Accounts</a>
                                        <ul>
                                            <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                                        </ul>
                                    </li>
                                @endcan

                                @can('roles.view')
                                    <li><a class="has-arrow" href="javascript:void(0);">Roles and Permission</a>
                                        <ul>
                                            @can('roles.view')
                                                <li><a href="{{ route('roles.index') }}">Manage Role</a></li>
                                            @endcan

                                            @can('permissions.view')
                                                <li><a href="{{ route('permissions.index') }}">Manage Permission</a></li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['customer-types.view', 'customers.view'])
                        <li>
                            <a class="has-arrow" href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_115_172)">
                                            <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 4.25933C12.1489 4.25921 12.3 4.29247 12.4426 4.36281C12.6398 4.46014 12.7994 4.61977 12.8967 4.81698L14.9389 8.95491L19.5054 9.61846C20.0519 9.69788 20.4306 10.2053 20.3512 10.7519C20.3196 10.9695 20.2171 11.1706 20.0596 11.3242L16.7553 14.5451L17.5353 19.0931C17.6287 19.6374 17.2631 20.1544 16.7188 20.2478C16.502 20.2849 16.279 20.2496 16.0844 20.1473L12 18V4.25933Z"
                                                fill="#4E5566" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 4.25933V18L7.91559 20.1473C7.42675 20.4043 6.82212 20.2163 6.56512 19.7275C6.46278 19.5328 6.42746 19.3099 6.46464 19.0931L7.24469 14.5451L3.94036 11.3242C3.54487 10.9387 3.53678 10.3055 3.92228 9.91006C4.07579 9.75258 4.27693 9.65009 4.49457 9.61846L9.06104 8.95492L11.1032 4.81699C11.2773 4.46426 11.6316 4.25961 12 4.25933Z"
                                                fill="#90959F" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_115_172">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <span class="nav-text">Customer Mgmt</span>
                            </a>
                            <ul>
                                @can('customer-types.view')
                                    <li><a href="{{ route('customer-types.index') }}">Manage Customer Types</a></li>
                                @endcan

                                @can('customers.view')
                                    <li><a href="{{ route('citizens.index') }}">Manage Customers</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['property-types.view', 'properties.view'])
                        <li>
                            <a class="has-arrow " href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M15.2428 4.73756C15.2428 6.95855 17.0459 8.75902 19.2702 8.75902C19.5151 8.75782 19.7594 8.73431 20 8.68878V16.6615C20 20.0156 18.0215 22 14.6624 22H7.34636C3.97851 22 2 20.0156 2 16.6615V9.3561C2 6.00195 3.97851 4 7.34636 4H15.3131C15.2659 4.243 15.2423 4.49001 15.2428 4.73756ZM13.15 14.8966L16.0078 11.2088V11.1912C16.2525 10.8625 16.1901 10.3989 15.8671 10.1463C15.7108 10.0257 15.5122 9.97345 15.3167 10.0016C15.1211 10.0297 14.9453 10.1358 14.8295 10.2956L12.4201 13.3951L9.6766 11.2351C9.51997 11.1131 9.32071 11.0592 9.12381 11.0856C8.92691 11.1121 8.74898 11.2166 8.63019 11.3756L5.67562 15.1863C5.57177 15.3158 5.51586 15.4771 5.51734 15.6429C5.5002 15.9781 5.71187 16.2826 6.03238 16.3838C6.35288 16.485 6.70138 16.3573 6.88031 16.0732L9.35125 12.8771L12.0948 15.0283C12.2508 15.1541 12.4514 15.2111 12.6504 15.1863C12.8494 15.1615 13.0297 15.0569 13.15 14.8966Z"
                                                fill="white" />
                                            <circle opacity="0.4" cx="19.5" cy="4.5" r="2.5"
                                                fill="white" />
                                        </g>
                                    </svg>
                                </div>
                                <span class="nav-text">Properties</span>
                            </a>
                            <ul>
                                @can('property-types.view')
                                    <li><a href="{{ route('business-class-types.index') }}">Property Class Type</a></li>
                                @endcan

                                @can('properties.view')
                                    <li><a href="{{ route('properties.index') }}">Manage Property</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['business-types.view', 'business-classes.view', 'businesses.view'])
                        <li><a class="has-arrow " href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path opacity="0.4"
                                                d="M11.776 21.8374C9.49292 20.4273 7.37062 18.7645 5.44789 16.8796C4.0905 15.5338 3.05386 13.8905 2.41716 12.0753C1.27953 8.53523 2.60381 4.48948 6.30111 3.2884C8.25262 2.67553 10.375 3.05175 12.007 4.29983C13.6396 3.05315 15.7614 2.67705 17.713 3.2884C21.4103 4.48948 22.7435 8.53523 21.6058 12.0753C20.9743 13.8888 19.9438 15.5319 18.5929 16.8796C16.6684 18.7625 14.5463 20.4251 12.2648 21.8374L12.0159 22L11.776 21.8374Z"
                                                fill="white" />
                                            <path
                                                d="M12.0109 22L11.776 21.8374C9.49013 20.4274 7.36487 18.7647 5.43902 16.8796C4.0752 15.5356 3.03238 13.8922 2.39052 12.0753C1.26177 8.53523 2.58605 4.48948 6.28335 3.2884C8.23486 2.67553 10.3853 3.05204 12.0109 4.31057V22Z"
                                                fill="white" />
                                            <path
                                                d="M18.2304 9.99922C18.0296 9.98629 17.8425 9.8859 17.7131 9.72157C17.5836 9.55723 17.5232 9.3434 17.5459 9.13016C17.5677 8.4278 17.168 7.78851 16.5517 7.53977C16.1609 7.43309 15.9243 7.00987 16.022 6.59249C16.1148 6.18182 16.4993 5.92647 16.8858 6.0189C16.9346 6.027 16.9816 6.04468 17.0244 6.07105C18.2601 6.54658 19.0601 7.82641 18.9965 9.22576C18.9944 9.43785 18.9117 9.63998 18.7673 9.78581C18.6229 9.93164 18.4291 10.0087 18.2304 9.99922Z"
                                                fill="white" />
                                        </g>
                                    </svg>
                                </div>
                                <span class="nav-text">Businesses</span>
                            </a>
                            <ul>
                                @can('business-types.view')
                                    <li><a href="{{ route('business-types.index') }}">Business Types</a></li>
                                @endcan

                                @can('business-classes.view')
                                    <li><a href="{{ route('business-classes.index') }}">Business Classes</a></li>
                                @endcan

                                @can('businesses.view')
                                    <li><a href=" {{ route('businesses.index') }}">Manage Business</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['bills.view'])
                        <li><a class="has-arrow " href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path opacity="0.4"
                                                d="M10.0833 15.9579H3.50777C2.67555 15.9579 2 16.6217 2 17.4393C2 18.2558 2.67555 18.9206 3.50777 18.9206H10.0833C10.9155 18.9206 11.5911 18.2558 11.5911 17.4393C11.5911 16.6217 10.9155 15.9579 10.0833 15.9579Z"
                                                fill="white" />
                                            <path opacity="0.4"
                                                d="M22 6.37855C22 5.56202 21.3244 4.89832 20.4933 4.89832H13.9178C13.0856 4.89832 12.41 5.56202 12.41 6.37855C12.41 7.19617 13.0856 7.85988 13.9178 7.85988H20.4933C21.3244 7.85988 22 7.19617 22 6.37855Z"
                                                fill="white" />
                                            <path
                                                d="M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z"
                                                fill="white" />
                                            <path
                                                d="M22 17.3992C22 19.2648 20.4611 20.7778 18.5611 20.7778C16.6622 20.7778 15.1223 19.2648 15.1223 17.3992C15.1223 15.5325 16.6622 14.0196 18.5611 14.0196C20.4611 14.0196 22 15.5325 22 17.3992Z"
                                                fill="white" />
                                        </g>
                                    </svg>
                                </div>
                                <span class="nav-text">Bill Management</span>
                            </a>
                            <ul>
                                @can('bills.create')
                                    <li><a href="{{ route('bills.index') }}">Generate Bill (Property)</a></li>
                                @endcan

                                @can('bills.create')
                                    <li><a href="{{ route('bills.bus.index') }}">Generate Bill (Business)</a></li>
                                @endcan

                                @can('bills.view')
                                    <li><a href="{{ route('bills.fetchBill') }}">Manage bills</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['payments.view'])
                        <li><a class="has-arrow " href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path opacity="0.4"
                                                d="M16.191 2H7.81C4.77 2 3 3.78 3 6.83V17.16C3 20.26 4.77 22 7.81 22H16.191C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.08002 6.64999V6.65999C7.64902 6.65999 7.30002 7.00999 7.30002 7.43999C7.30002 7.86999 7.64902 8.21999 8.08002 8.21999H11.069C11.5 8.21999 11.85 7.86999 11.85 7.42899C11.85 6.99999 11.5 6.64999 11.069 6.64999H8.08002ZM15.92 12.74H8.08002C7.64902 12.74 7.30002 12.39 7.30002 11.96C7.30002 11.53 7.64902 11.179 8.08002 11.179H15.92C16.35 11.179 16.7 11.53 16.7 11.96C16.7 12.39 16.35 12.74 15.92 12.74ZM15.92 17.31H8.08002C7.78002 17.35 7.49002 17.2 7.33002 16.95C7.17002 16.69 7.17002 16.36 7.33002 16.11C7.49002 15.85 7.78002 15.71 8.08002 15.74H15.92C16.319 15.78 16.62 16.12 16.62 16.53C16.62 16.929 16.319 17.27 15.92 17.31Z"
                                                fill="white" />
                                        </g>
                                    </svg>
                                </div>

                                <span class="nav-text">Payments</span>
                            </a>
                            <ul>
                                {{-- <li><a href="{{ route('payments.index') }}">Ablekuma North Quick Payment
                                    Payment</a></li> --}}
                                @can('payments.view')
                                    <li><a href="{{ route('payments.index') }}">Manage Payment</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['assemblies.view', 'divisions.view', 'blocks.view', 'zones.view', 'property-uses.view',
                        'rates.view', 'agent-assignments.view', 'task-assignments.view'])
                        <li><a class="has-arrow " href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path opacity="0.4"
                                                d="M6.70555 12.8905C6.18944 12.8905 5.77163 13.3145 5.77163 13.8383L5.51416 18.4171C5.51416 19.0846 6.04783 19.625 6.70555 19.625C7.36328 19.625 7.89577 19.0846 7.89577 18.4171L7.63947 13.8383C7.63947 13.3145 7.22167 12.8905 6.70555 12.8905Z"
                                                fill="white" />
                                            <path
                                                d="M7.98037 3.67345C7.98037 3.67345 7.71236 3.39789 7.54618 3.27793C7.30509 3.09264 7.00783 3 6.71173 3C6.37936 3 6.07039 3.10452 5.81877 3.30169C5.77313 3.34801 5.57886 3.5226 5.41852 3.68532C4.41204 4.6367 2.76539 7.12026 2.26215 8.42083C2.18257 8.618 2.01053 9.11685 2 9.38409C2 9.63827 2.05618 9.88294 2.17087 10.1145C2.3312 10.4044 2.58282 10.6372 2.88009 10.7642C3.08606 10.8462 3.70282 10.9733 3.71453 10.9733C4.38981 11.1016 5.48757 11.1704 6.70003 11.1704C7.85514 11.1704 8.90727 11.1016 9.59308 10.997C9.60478 10.9852 10.3702 10.8581 10.6335 10.7179C11.1133 10.4626 11.4118 9.96371 11.4118 9.43041V9.38409C11.4001 9.03608 11.1016 8.30444 11.0911 8.30444C10.5879 7.07394 9.02079 4.64858 7.98037 3.67345Z"
                                                fill="white" />
                                            <path opacity="0.4"
                                                d="M17.2947 11.1096C17.8108 11.1096 18.2286 10.6856 18.2286 10.1618L18.4849 5.58296C18.4849 4.91543 17.9524 4.375 17.2947 4.375C16.637 4.375 16.1033 4.91543 16.1033 5.58296L16.3608 10.1618C16.3608 10.6856 16.7786 11.1096 17.2947 11.1096Z"
                                                fill="white" />
                                            <path
                                                d="M21.8292 13.8853C21.6688 13.5955 21.4172 13.3639 21.1199 13.2356C20.914 13.1536 20.296 13.0265 20.2855 13.0265C19.6102 12.8983 18.5124 12.8294 17.3 12.8294C16.1449 12.8294 15.0928 12.8983 14.4069 13.0028C14.3952 13.0147 13.6298 13.1429 13.3665 13.2819C12.8855 13.5373 12.5883 14.0361 12.5883 14.5706V14.617C12.6 14.965 12.8972 15.6954 12.9089 15.6954C13.4122 16.926 14.9781 19.3526 16.0197 20.3265C16.0197 20.3265 16.2877 20.6021 16.4538 20.7209C16.6938 20.9074 16.991 21 17.2895 21C17.6207 21 17.9285 20.8955 18.1812 20.6983C18.2269 20.652 18.4212 20.4774 18.5815 20.3158C19.5868 19.3633 21.2346 16.8796 21.7367 15.5802C21.8175 15.3831 21.9895 14.883 22 14.617C22 14.3616 21.9438 14.1169 21.8292 13.8853Z"
                                                fill="white" />
                                        </g>
                                    </svg>
                                </div>
                                <span class="nav-text">Assembly Mgmt </span>
                            </a>
                            <ul>
                                @can('assemblies.view')
                                    <li><a href="{{ route('assembly.index') }}">Manage Assembly</a></li>
                                @endcan

                                @can('divisions.view')
                                    <li><a href="{{ route('divisions.index') }}">Manage Divisions</a></li>
                                @endcan

                                @can('blocks.view')
                                    <li><a href="{{ route('blocks.index') }}">Manage Blocks</a></li>
                                @endcan

                                @can('zones.view')
                                    <li><a href="{{ route('zones.index') }}">Manage Zones</a></li>
                                @endcan

                                @can('property-uses.view')
                                    <li><a href="{{ route('property-users.index') }}">Property Uses</a></li>
                                @endcan

                                @can('rates.view')
                                    <li><a href="{{ route('rates.index') }}">Manage Rates (Property)</a></li>
                                    <li><a href="{{ route('rates.bus.index') }}">Manage Rates (Business)</a></li>
                                @endcan

                                @can('agent-assignments.view')
                                    <li><a href="{{ route('agent-assignments.index') }}">Agent Assignment</a></li>
                                @endcan

                                @can('task-assignments.view')
                                    <li><a href="{{ route('task-assignments.index') }}">Task Assignment</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['reports.view'])
                        <li><a class="has-arrow " href="javascript:void(0);">
                                <div class="menu-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path opacity="0.4"
                                                d="M2.00018 11.0785C2.05018 13.4165 2.19018 17.4155 2.21018 17.8565C2.28118 18.7995 2.64218 19.7525 3.20418 20.4245C3.98618 21.3675 4.94918 21.7885 6.29218 21.7885C8.14818 21.7985 10.1942 21.7985 12.1812 21.7985C14.1762 21.7985 16.1122 21.7985 17.7472 21.7885C19.0712 21.7885 20.0642 21.3565 20.8362 20.4245C21.3982 19.7525 21.7592 18.7895 21.8102 17.8565C21.8302 17.4855 21.9302 13.1445 21.9902 11.0785H2.00018Z"
                                                fill="white" />
                                            <path
                                                d="M11.2454 15.3842V16.6782C11.2454 17.0922 11.5814 17.4282 11.9954 17.4282C12.4094 17.4282 12.7454 17.0922 12.7454 16.6782V15.3842C12.7454 14.9702 12.4094 14.6342 11.9954 14.6342C11.5814 14.6342 11.2454 14.9702 11.2454 15.3842Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10.2113 14.5564C10.1113 14.9194 9.7623 15.1514 9.38431 15.1014C6.8333 14.7454 4.39531 13.8404 2.33731 12.4814C2.12631 12.3434 2.00031 12.1074 2.00031 11.8554V8.3894C2.00031 6.2894 3.71231 4.5814 5.81731 4.5814H7.78431C7.97231 3.1294 9.20231 2.0004 10.7043 2.0004H13.2863C14.7873 2.0004 16.0183 3.1294 16.2063 4.5814H18.1833C20.2823 4.5814 21.9903 6.2894 21.9903 8.3894V11.8554C21.9903 12.1074 21.8633 12.3424 21.6543 12.4814C19.5923 13.8464 17.1443 14.7554 14.5763 15.1104C14.5413 15.1154 14.5073 15.1174 14.4733 15.1174C14.1343 15.1174 13.8313 14.8884 13.7463 14.5524C13.5443 13.7564 12.8213 13.1994 11.9903 13.1994C11.1483 13.1994 10.4333 13.7444 10.2113 14.5564ZM13.2863 3.5004H10.7043C10.0313 3.5004 9.46931 3.9604 9.30131 4.5814H14.6883C14.5203 3.9604 13.9583 3.5004 13.2863 3.5004Z"
                                                fill="white" />
                                        </g>
                                    </svg>
                                </div>
                                <span class="nav-text">Reports</span>
                            </a>
                            <ul>
                                @can('reports.view')
                                    <li><a href="{{ route('customer-reports.index') }}">Customers Report</a></li>
                                @endcan

                                @can('reports.view')
                                    <li><a href="{{ route('business-reports.index') }}">Businessess Report</a></li>
                                @endcan

                                @can('reports.view')
                                    <li><a href="{{ route('property-reports.index') }}">Property Report</a></li>
                                @endcan

                                @can('reports.view')
                                    <li><a href="{{ route('bill-reports.index') }}">Bills Report</a></li>
                                @endcan

                                @can('reports.view')
                                    <li><a href="{{ route('payment-reports.index') }}">Payment Report</a></li>
                                @endcan

                                @can('reports.view')
                                    <li><a href="{{ route('debtors-reports.index') }}">Debtors Report</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </div>
        </div>

        <div class="content-body">
            @yield('page-content')
        </div>

        <div class="footer">
            <div class="copyright">
                <p>Copyright © Developed by <a href="" target="_blank"> Assets Circle Network
                    </a> 2024
                </p>
            </div>
        </div>
    </div>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/src/assets/js/dashboard/dash_1.js') }}"></script>

    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('assets/vendor/draggable/draggable.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/js/swiper-bundle.min.js') }}"></script>


    <!-- tagify -->
    <script src="{{ asset('assets/vendor/tagify/dist/tagify.js') }}"></script>

    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>

    <!-- Apex Chart -->

    <script src="{{ asset('assets/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>
    @yield('page-scripts')
</body>

</html>
