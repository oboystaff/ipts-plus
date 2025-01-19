@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">FAQs</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: row-2 -->
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div
                            class="row justify-content-center border-bottom border-block-end-dashed mb-4 p-3 mx-0 bg-primary rounded text-fixed-white">
                            <div class="col-xxl-12">
                                <div class="py-2">
                                    <div class="text-center">
                                        <h3 class="text-fixed-white mb-3">Frequently Asked </h3>
                                        <h5 class="d-block text-fixed-white op-8">Require assistance? Here are some of our
                                            commonly asked questions!</h5>
                                        <p class="op-7 mb-2 px-4 text-fixed-white">Discover answers to common queries and
                                            find solutions to your concerns with our comprehensive list of frequently asked
                                            questions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gy-3 gy-xxl-0">
                            <div class="col-xxl-12">
                                <ul class="nav nav-tabs tab-style-1 d-sm-flex d-block bg-transparent border border-dashed"
                                    role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#account-settings" aria-selected="false" tabindex="-1">Account
                                            Settings</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#privacy-and-security" aria-selected="true">Billing & Security</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#billing-and-payments" aria-selected="false" tabindex="-1">Support and
                                            Enquiry
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane border-0 bg-primary-transparent show active" id="account-settings"
                                        role="tabpanel">
                                        <div class="accordion accordion-customicon1 faq-accordion accordion-primary accordions-items-separate"
                                            id="accordionFAQ5">
                                            <div class="accordion-item shadow-sm">
                                                <h2 class="accordion-header" id="headingcustomicon2TwentyOne">
                                                    <button
                                                        class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapsecustomicon2TwentyOne" aria-expanded="true"
                                                        aria-controls="collapsecustomicon2TwentyOne">
                                                        1. What is the IPTS software?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2TwentyOne"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="headingcustomicon2TwentyOne"
                                                    data-bs-parent="#accordionFAQ5">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        IPTS (Integrated Property Tax System) is a digital platform that
                                                        helps assemblies manage property rates efficiently. As a Rate Payer,
                                                        you can use the system to view and pay your property bills
                                                        conveniently.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow-sm">
                                                <h2 class="accordion-header" id="headingcustomicon2TwentyTwo">
                                                    <button
                                                        class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapsecustomicon2TwentyTwo" aria-expanded="false"
                                                        aria-controls="collapsecustomicon2TwentyTwo">
                                                        2.Who can use the IPTS software?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2TwentyTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="headingcustomicon2TwentyTwo"
                                                    data-bs-parent="#accordionFAQ5">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        The IPTS software is designed for property owners, businesses, and
                                                        individuals responsible for paying property rates.
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
                                                        3. How do I create an account?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2TwentyThree" class="accordion-collapse collapse"
                                                    aria-labelledby="headingcustomicon2TwentyThree"
                                                    data-bs-parent="#accordionFAQ5">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        You can create an account by downloading the IPTS mobile app or
                                                        visiting the IPTS portal. Follow the registration process, providing
                                                        accurate details like your property or business identification
                                                        number.
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
                                                        4. What should I do if I forget my password?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2TwentyFour"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="headingcustomicon2TwentyFour"
                                                    data-bs-parent="#accordionFAQ5">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        Click the "Forgot Password" link on the login page. Enter your
                                                        registered email address, and a password reset link will be sent to
                                                        you.
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane border-0 bg-primary-transparent" id="privacy-and-security"
                                        role="tabpanel">
                                        <div class="accordion accordion-customicon1 faq-accordion accordion-primary accordions-items-separate"
                                            id="accordionFAQ1">
                                            <div class="accordion-item shadow-sm">
                                                <h2 class="accordion-header" id="headingcustomicon2One">
                                                    <button
                                                        class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapsecustomicon2One" aria-expanded="true"
                                                        aria-controls="collapsecustomicon2One">
                                                        1.How can I view my bill?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2One" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingcustomicon2One"
                                                    data-bs-parent="#accordionFAQ1">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        Log in to your account on the mobile app or portal, and your current
                                                        bill will be displayed on the dashboard.
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
                                                        2. What payment methods are available?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2Two" class="accordion-collapse collapse"
                                                    aria-labelledby="headingcustomicon2Two"
                                                    data-bs-parent="#accordionFAQ1">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        IPTS supports multiple payment methods, including mobile money and
                                                        Cash Collections
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
                                                        3. Will I receive a receipt after making a payment?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2Three" class="accordion-collapse collapse"
                                                    aria-labelledby="headingcustomicon2Three"
                                                    data-bs-parent="#accordionFAQ1">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        Yes, an electronic receipt will be sent to your registered email and
                                                        will also be available in your account for download.
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
                                                        4. Can I pay for multiple properties under one account?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2Four" class="accordion-collapse collapse"
                                                    aria-labelledby="headingcustomicon2Four"
                                                    data-bs-parent="#accordionFAQ1">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        Yes, you can link multiple properties to a single account and manage
                                                        all payments in one place.You will need to ContactThe Assembly to
                                                        link the properties.
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane border-0 bg-primary-transparent" id="billing-and-payments"
                                        role="tabpanel">
                                        <div class="accordion accordion-customicon1 faq-accordion accordion-primary accordions-items-separate"
                                            id="accordionFAQ3">
                                            <div class="accordion-item shadow-sm">
                                                <h2 class="accordion-header" id="headingcustomicon2Eleven">
                                                    <button
                                                        class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapsecustomicon2Eleven" aria-expanded="true"
                                                        aria-controls="collapsecustomicon2Eleven">
                                                        1. What should I do if I encounter issues with my account or
                                                        payment?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2Eleven"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="headingcustomicon2Eleven"
                                                    data-bs-parent="#accordionFAQ3">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        You can contact customer support through the mobile app, email, or
                                                        the helpline provided on the IPTS portal.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow-sm">
                                                <h2 class="accordion-header" id="headingcustomicon2Twelve">
                                                    <button
                                                        class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapsecustomicon2Twelve" aria-expanded="false"
                                                        aria-controls="collapsecustomicon2Twelve">
                                                        2. How can I contact my local assembly for specific inquiries?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2Twelve" class="accordion-collapse collapse"
                                                    aria-labelledby="headingcustomicon2Twelve"
                                                    data-bs-parent="#accordionFAQ3">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        Use the "Contact Assembly" feature in your account to send inquiries
                                                        directly to your assembly.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow-sm">
                                                <h2 class="accordion-header" id="headingcustomicon2Thirteen">
                                                    <button
                                                        class="accordion-button fs-14 fw-medium pt-3 pb-2 bg-transparent collapsed"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapsecustomicon2Thirteen"
                                                        aria-expanded="false" aria-controls="collapsecustomicon2Thirteen">
                                                        3. Is my personal and payment information secure?
                                                    </button>
                                                </h2>
                                                <div id="collapsecustomicon2Thirteen" class="accordion-collapse collapse"
                                                    aria-labelledby="headingcustomicon2Thirteen"
                                                    data-bs-parent="#accordionFAQ3">
                                                    <div
                                                        class="accordion-body ps-3 m-3 my-3 border-success border-3 border-start text-default bg-success bg-opacity-10">
                                                        Yes, IPTS uses advanced security measures, including encryption, to
                                                        protect your data and ensure secure transactions.
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: row-2 -->

    </div>
@endsection

@section('page-scripts')
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
    <!--End of Tawk.to Script-->
    <script src="{{ asset('assets/js/general/app.js?t=1234') }}"></script>
@endsection
