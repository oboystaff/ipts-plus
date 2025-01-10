<!DOCTYPE html>
<html lang="en" data-theme-mode="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Activate Account - IPTS</title>
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
                <h2 class="form-title">Activate Your IPTS Account </h2>

                <form action="{{ route('citizens.activateCitizen') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="code" class="form-label">Activation Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                            name="code" placeholder="Enter your activation code">
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom w-100">Activate Account</button>
                    </div>
                </form>
                <div class="auth-footer">
                    <p>Already have an account? <a href="{{ route('auth.index') }}">Sign In</a> or <a
                            href="{{ route('auth.register') }}">Create Account </a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
