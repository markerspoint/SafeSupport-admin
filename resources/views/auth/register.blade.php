<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeSupport | Register</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Poppins', sans-serif !important;
    }

    html,
    body {
        height: 100%;
        overflow: hidden;
    }

    #particles-js {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        background: linear-gradient(135deg, #7ecfb0 0%, #6fc9a2 50%, #5fc49a 100%);
    }

    .middle-box {
        max-width: clamp(20rem, 70%, 28rem) !important;
        margin-top: 8rem;
        background-color: #fff !important;
        padding: 2rem !important;
        border-radius: 0.75rem !important;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-floating input {
        height: 3rem;
        padding: 1rem 0.75rem 0.25rem 0.75rem;
    }

    .form-floating label {
        position: absolute;
        top: 0.9rem;
        left: 0.75rem;
        color: #999;
        font-size: 0.9rem;
        pointer-events: none;
        transition: all 0.2s ease-in-out;
    }

    .form-floating input:focus+label,
    .form-floating input:not(:placeholder-shown)+label {
        top: -0.5rem;
        left: 0.65rem;
        font-size: 0.75rem;
        color: #555;
        background: #fff;
        padding: 0 0.25rem;
    }

    button,
    .btn {
        width: 100%;
        padding: 0.7rem;
    }

    #login:hover {
        border-color: #1ab394;
    }
</style>

<div id="particles-js"></div>

<body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
        <div>
            <!-- Logo -->
            <a href="#">
                <span class="brand-text-left font-weight-bold" style="color: #0b6043; font-size: 2rem;">SafeSupp</span>
                <img src="{{ asset('template/img/safecenter-logo.png') }}" alt="SafeCenter Logo"
                    class="brand-image img-circle elevation-1"
                    style="opacity: .8; height: 28px; width: 28px; margin: -11px 1px 0;">
                <span class="brand-text-right font-weight-bold" style="color: #0b6043; font-size: 2rem;">rt</span>
            </a>
            <p class="login-box-msg">Create your SafeSupport account</p>
        </div>

        <form class="m-t" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-floating form-group">
                <input type="email" class="form-control b-r-lg" id="email" name="email" placeholder="" required>
                <label for="email">Email</label>
            </div>

            <div class="form-floating form-group">
                <input type="password" class="form-control b-r-lg" id="password" name="password" placeholder=""
                    required>
                <label for="password">Password</label>
            </div>

            <div class="form-floating form-group">
                <input type="password" class="form-control b-r-lg" id="password_confirmation"
                    name="password_confirmation" placeholder="" required>
                <label for="password_confirmation">Confirm Password</label>
            </div>

            <button type="submit" class="b-r-lg btn btn-primary m-b">Register</button>

            <p class="text-muted text-center"><small>Already have an account?</small></p>
            <a class="b-r-lg btn btn-white" id="login" href="{{ route('login') }}">Login</a>
        </form>

        <p class="m-t"> <small>SafeSupport web application &copy; 2025</small> </p>
    </div>

    <!-- particles.js -->
    <script src="{{ asset('particle/js/particles.js') }}"></script>
    <script src="{{ asset('particle/js/app.js') }}"></script>

    <!-- stats.js -->
    <script src="{{ asset('particle/js/lib/stats.js') }}"></script>

    <!-- Mainly scripts -->
    <script src="{{ asset('template/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('template/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap.js') }}"></script>
</body>

</html>