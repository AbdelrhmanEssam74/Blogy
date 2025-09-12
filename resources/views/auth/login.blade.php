@extends('app.layout')

@section('title', 'Login')
@section('header')
    <x-upper_navbar></x-upper_navbar>
@endsection
@section('content')
    <div class="full-width-auth-container" role="main" aria-label="Login Page">
        <!-- Image Section -->
        <div class="auth-image-section" aria-hidden="true">
            <img fetchpriority="high"
                 src="{{ asset('images/auth-background.jpg') }}"
                 alt="Background image showing a welcoming environment">
            <div class="image-overlay"></div>
        </div>
        <!-- Form Section -->
        <div class="auth-form-section">
            <div class="auth-form-content" role="form" aria-labelledby="loginTitle">
                <h1 id="loginTitle" class="auth-title">Welcome Back</h1>

                <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    {{-- Email --}}
                    <div class="form-floating mb-3">
                        <input id="email" type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="name@example.com" value="{{ old('email') }}"
                               aria-describedby="emailHelp" aria-required="true" required>
                        <label for="email"><i class="bi bi-envelope-fill me-2"></i>Email address</label>
                        @error('email')
                        <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-floating mb-3">
                        <input id="password" type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Password" aria-required="true" required>
                        <label for="password"><i class="bi bi-lock-fill me-2"></i>Password</label>
                        @error('password')
                        <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember Me and Forgot Password --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot Password?</a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg" aria-label="Login">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </button>
                    </div>

                    {{-- Divider --}}
                    <div class="divider">or continue with</div>

                    {{-- Social Login Buttons --}}
                    <div class="sso-buttons" role="group" aria-label="Social login options">
                        <a href="" class="sso-button" aria-label="Login with Google">
                            <img src="{{ asset('icons/google.svg') }}" alt="" class="sso-icon" aria-hidden="true">
                            Google
                        </a>
                        <a href="" class="sso-button" aria-label="Login with Facebook">
                            <img src="{{ asset('icons/facebook.svg') }}" alt="" class="sso-icon" aria-hidden="true">
                            Facebook
                        </a>
                    </div>

                    {{-- create an account --}}
                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: #333;
        }

        /* Full Width Container */
        .full-width-auth-container {
            display: flex;
            min-height: 100vh;
            background-color: #fff;
        }

        /* Image Section */
        .auth-image-section {
            flex: 1;
            position: relative;
            height: 100vh;
            max-width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .auth-image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            filter: brightness(0.85);
            transition: filter 0.3s ease;
        }

        .auth-image-section:hover img {
            filter: brightness(0.75);
        }

        /* Form Section */
        .auth-form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 3rem;
            background-color: #fff;
        }

        .auth-form-content {
            width: 100%;
            max-width: 420px;
            padding: 2rem 1rem;
            border-radius: 12px;
            background-color: #fff;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            color: #004080;
        }

        /* Form Elements */
        .form-floating > input.form-control {
            border-radius: 8px;
            padding: 1.25rem 1rem 0.5rem 1rem;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-floating > label {
            padding-left: 0.75rem;
            color: #666;
            font-weight: 500;
            user-select: none;
        }

        .form-floating > input.form-control:focus {
            border-color: #0066cc;
            box-shadow: 0 0 8px rgba(0, 102, 204, 0.3);
        }

        .form-floating > input.form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 8px rgba(220, 53, 69, 0.3);
        }

        .invalid-feedback {
            font-size: 0.875rem;
            color: #dc3545;
            margin-top: 0.25rem;
        }

        /* Remember Me and Forgot Password */
        .form-check {
            user-select: none;
        }

        .form-check-input {
            cursor: pointer;
            width: 1.25rem;
            height: 1.25rem;
            margin-top: 0.2rem;
        }

        .form-check-label {
            cursor: pointer;
            font-size: 0.9rem;
            color: #555;
        }

        .forgot-password-link {
            font-size: 0.9rem;
            color: #0066cc;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-password-link:hover,
        .forgot-password-link:focus {
            color: #004080;
            text-decoration: underline;
        }

        /* Buttons */
        .btn-primary {
            background-color: #0066cc;
            border: none;
            border-radius: 8px;
            font-size: 1.125rem;
            font-weight: 600;
            padding: 0.75rem 1rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #004a99;
            box-shadow: 0 6px 16px rgba(0, 74, 153, 0.5);
            outline: none;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #999;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #eee;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        /* SSO Buttons */
        .sso-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .sso-button {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 0;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            color: #444;
            background-color: #fafafa;
            transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .sso-button:hover,
        .sso-button:focus {
            background-color: #f0f4f8;
            border-color: #0066cc;
            color: #0066cc;
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.2);
            outline: none;
        }

        .sso-icon {
            width: 20px;
            height: 20px;
            display: inline-block;
        }

        /* Create Account Text */
        .text-center p {
            font-size: 0.95rem;
            color: #666;
        }

        .text-center a {
            color: #0066cc;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .text-center a:hover,
        .text-center a:focus {
            color: #004080;
            text-decoration: underline;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .full-width-auth-container {
                flex-direction: column;
            }

            .auth-image-section {
                height: 250px;
                max-height: 250px;
            }

            .auth-form-section {
                padding: 2rem 1.5rem;
            }

            .auth-form-content {
                box-shadow: none;
                border-radius: 0;
                padding: 1.5rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .auth-form-content {
                padding: 1rem 0.5rem;
            }

            .btn-primary {
                font-size: 1rem;
            }

            .sso-button {
                font-size: 0.9rem;
                padding: 0.6rem 0;
            }
        }
    </style>
@endsection
