<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light"
    data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> IPTS </title>
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
                background-image: url("{{ asset('assets/assetsfront/images/banner/image1.jpeg') }}");
            }

            25% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/image2.jpeg') }}");
            }

            50% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/image3.jpeg') }}");
            }

            75% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/image4.jpeg') }}");
            }

            100% {
                background-image: url("{{ asset('assets/assetsfront/images/banner/image5.jpeg') }}");
            }
        }
    </style>

    <div class="authentication-background">
        <div class="container-lg">
            <form action="{{ route('citizens.frontstore') }}" method="POST">
                @csrf <!-- This is for CSRF protection if you're using Laravel -->
                <div class="row justify-content-center authentication authentication-basic align-items-center h-100">
                    <div class="col-xxl-8 col-lg-8 col-md-8 col-8"> <!-- Adjusted width classes -->
                        <div class="card custom-card my-4 border">
                            <div class="card-body">
                                <!-- Registration Form -->
                                <div class="mb-4 text-center">
                                    <h4 class="mb-3">Registration Portal</h4>
                                    <p class="text-muted">Please fill in the details to register.</p>
                                </div>

                                <!-- Registration Type Selector -->
                                <div class="mb-3">
                                    <label for="registration-type" class="form-label">Registration Type</label>
                                    <select class="form-select" id="registration-type" name="registration_type">
                                        <option value="">Select Registration Type</option>
                                        <option value="individual">Individual Rate Payer</option>
                                        <option value="organization">Organization</option>
                                    </select>
                                </div>

                                <!-- Individual Rate Payer Fields -->
                                <div id="individual-fields" class="d-none">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="first-name" class="form-label">First Name</label>
                                            <input type="text" id="first-name" name="first_name"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="last-name" class="form-label">Last Name</label>
                                            <input type="text" id="last-name" name="last_name" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="id-type" class="form-label">ID Type</label>
                                            <select class="form-select" id="id-type" name="id_type">
                                                <option value="">Select ID Type</option>
                                                <option value="passport">Passport</option>
                                                <option value="voters_id">Voters ID</option>
                                                <option value="ghana_card">Ghana Card</option>
                                                <option value="ssnit">SSNIT</option>
                                                <option value="drivers_license">Driver's License</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="id-number" class="form-label">ID Number</label>
                                            <input type="text" id="id-number" name="id_number" class="form-control">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="Phone" class="form-label">Phone</label>
                                            <input type="text" id="Phone" name="Phone" class="form-control">
                                        </div>


                                    </div>

                                </div>

                                <!-- Organization Fields -->
                                <div id="organization-fields" class="d-none">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="business-name" class="form-label">Business Name</label>
                                            <input type="text" id="business-name" name="business_name"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="date-of-commencement" class="form-label">
                                                Commencement</label>
                                            <input type="date" id="date-of-commencement"
                                                name="date_of_commencement" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="org-first-name" class="form-label">First Name</label>
                                            <input type="text" id="org-first-name" name="org_first_name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="org-last-name" class="form-label">Last Name</label>
                                            <input type="text" id="org-last-name" name="org_last_name"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" id="phone" name="phone"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" name="email"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <!-- Security Question -->
                                    <div class="col-md-12 mb-3">
                                        <label for="security-question-select" class="form-label">Security
                                            Question</label>
                                        <select class="form-select" id="security-question-select"
                                            name="security_question">
                                            <option value="">Select a Security Question</option>
                                            <option value="mothers_maiden_name">What is Your Mother's Maiden Name?
                                            </option>
                                            <option value="pet_name">What is Your Pet's Name?</option>
                                            <option value="favorite_color">What is Your Favorite Color?</option>
                                            <option value="place_of_birth">What is Your Place of Birth?</option>
                                            <option value="school_name">What is Your Name of School?</option>
                                        </select>
                                    </div>
                                    <!-- Security Question Answer -->
                                    <div class="col-md-12 mb-3">
                                        <label for="security-answer" class="form-label">Answer</label>
                                        <input type="text" id="security-answer" name="security_answer"
                                            class="form-control" placeholder="Enter your answer">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="tin_number" class="form-label">TIN Number</label>
                                        <input type="text" id="tin_number" name="tin_number"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Register Button -->
                                <div id="register-button" class="mt-3 d-none">
                                    <button type="submit" class="text-white btn btn-custom w-100">Register</button>
                                </div>
                                <div class="mt-3 text-center">
                                    <p>Already have an account? <a href="{{ route('auth.index') }}"
                                            style="color: #f37429;">Click here to
                                            Login.</a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Registration Link -->

            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Show Password JS -->
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the Registration Type dropdown and sections
            const registrationTypeSelect = document.getElementById('registration-type');
            const individualFields = document.getElementById('individual-fields');
            const organizationFields = document.getElementById('organization-fields');
            const registerButton = document.getElementById('register-button');

            // Function to handle displaying fields based on the registration type
            function toggleFields() {
                const selectedType = registrationTypeSelect.value;

                // Show or hide fields based on the selected type
                if (selectedType === 'individual') {
                    individualFields.classList.remove('d-none');
                    organizationFields.classList.add('d-none');
                    registerButton.classList.remove('d-none');
                } else if (selectedType === 'organization') {
                    organizationFields.classList.remove('d-none');
                    individualFields.classList.add('d-none');
                    registerButton.classList.remove('d-none');
                } else {
                    individualFields.classList.add('d-none');
                    organizationFields.classList.add('d-none');
                    registerButton.classList.add('d-none');
                }
            }

            // Run the toggleFields function when the Registration Type changes
            registrationTypeSelect.addEventListener('change', toggleFields);

            // Initial run to ensure correct fields are shown on page load
            toggleFields();
        });
    </script>


</body>

</html>
