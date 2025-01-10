<!DOCTYPE html>
<html lang="en" data-theme-mode="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Create Account - IPTS</title>
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(to bottom, #0052D4, #65C7F7, #9CECFB);
            font-family: 'Poppins', sans-serif;
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .container {
            max-width: 100%;
        }

        .row {
            height: 100%;
        }

        .card-left {
            background: transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-right: 20px;
            text-align: center;
        }

        .card-left img {
            max-width: 80%;
            height: auto;
        }

        .card-left h3 {
            color: #fff;
            margin-top: 20px;
            font-weight: bold;
        }

        .form-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            font-family: 'Times New Roman', serif;
            font-size: 12px;
        }

        .form-title {
            font-weight: bold;
            color: #0052D4;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn-custom {
            background: #0052D4;
            color: #fff;
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 14px;
            transition: all 0.3s ease;
            width: auto;
        }

        .btn-custom:hover {
            background: #003a9f;
        }

        .auth-footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }

        .auth-footer a {
            color: #0052D4;
            text-decoration: underline;
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 card-left">
                <img src="{{ asset('assets/images/arms.png') }}" alt="Arms">
                <h3>Integrated Property Tax System (IPTS)</h3>
            </div>
            <div class="col-md-6 form-container">
                <h2 class="form-title">Create Account </h2>

                <form action="{{ route('citizens.frontstore') }}" method="POST">
                    @csrf
                    <div class="row row-cols-3 g-3">
                        <div class="col">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                id="first_name" name="first_name" placeholder="Enter your first name">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                id="last_name" name="last_name" placeholder="Enter your last name">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="email" class="form-label">Email Address (Optional)</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email address">
                        </div>

                        <div class="col">
                            <label for="prefix" class="form-label">Prefix</label>
                            <select class="form-select @error('prefix') is-invalid @enderror" id="prefix"
                                name="prefix">
                                <option disabled selected>Select Prefix</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>
                                <option value="Dr">Dr</option>
                            </select>
                            @error('prefix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                id="date_of_birth" name="date_of_birth">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="telephone_number" class="form-label">Telephone Number</label>
                            <div class="input-group">
                                <span class="input-group-text">+233</span>
                                <input type="tel"
                                    class="form-control @error('telephone_number') is-invalid @enderror"
                                    id="telephone_number" name="telephone_number" placeholder="Enter Number">
                            </div>
                            @error('telephone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="country_of_citizenship" class="form-label">Country of Citizenship</label>
                            <select class="form-select @error('country_of_citizenship') is-invalid @enderror"
                                id="country_of_citizenship" name="country_of_citizenship">
                                <option disabled selected>Select Country</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Togo">Togo</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Mali">Mali</option>
                            </select>
                            @error('country_of_citizenship')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="telephone_number" class="form-label">. </label>
                            <button type="submit" class="btn btn-custom w-40" style="margin-top:20px">Create
                                Account</button>
                        </div>
                    </div>

                    <div class="auth-footer">
                        <p>Already have an account? <a href="{{ route('auth.index') }}">Sign In</a> or <a
                                href="{{ route('citizens.activate') }}">Activate Account with OTP</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
