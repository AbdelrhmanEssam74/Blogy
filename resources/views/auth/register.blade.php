@extends('app.layout')

@section('title', 'Register')
@section('header')
    <x-upper_navbar></x-upper_navbar>
@endsection
@section('content')
    <div class="full-width-auth-container">
        <!-- Image Section -->
        <div class="auth-image-section">
            <img fetchpriority="high"
                 src="{{asset('images/auth-background.png')}}"
                 alt="">
        </div>
        <!-- Form Section -->
        <div class="auth-form-section">
            <div class="auth-form-content">
                <p class="text-center text-muted mb-4">Join our bold community in just a few seconds!</p>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <div class="form-floating mb-3">
                        <input id="full_name" type="text" name="full_name"
                               class="form-control @error('full_name') is-invalid @enderror"
                               placeholder="Your Full Name" value="{{ old('full_name') }}"  >
                        <label for="full_name"><i class="bi bi-person-fill me-2"></i>Full Name</label>
                        @error('full_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-floating mb-3">
                        <input id="email" type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="name@example.com" value="{{ old('email') }}"  >
                        <label for="email"><i class="bi bi-envelope-fill me-2"></i>Email address</label>
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-floating mb-3">
                        <input id="password" type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Password"  >
                        <label for="password"><i class="bi bi-lock-fill me-2"></i>Password</label>
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-floating mb-4">
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="form-control" placeholder="Confirm Password"  >
                        <label for="password-confirm"><i class="bi bi-shield-lock-fill me-2"></i>Confirm Password</label>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg ">
                            <i class="bi bi-person-plus-fill me-1"></i> Register
                        </button>
                    </div>

                    {{-- Already have an account --}}
                    <div class="text-center mt-4">
                        <small class="text-muted">Already have an account?</small>
                        <a href="{{ route('login') }}" class="fw-bold">Login</a>
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
        }

        /* Full Width Container */
        .full-width-auth-container {
            display: flex;
        }

        /* Image Section */
        .auth-image-section {
            flex: 1;
            height: 100vh;
            max-width: 100%;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .auth-image-section img {
            width: 100%;
            height: auto;
            -o-object-fit: cover;
            object-fit: cover;
        }

        /* Form Section */
        .auth-form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
        }

        .auth-form-content {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
        }

        .auth-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #1a1a1a;
        }

        /* Form Elements */
        .auth-form {
            width: 100%;
        }

        .disclaimer {
            font-size: 0.75rem;
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .disclaimer a {
            color: #0066cc;
            text-decoration: none;
        }

        .disclaimer a:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.1);
        }

        /* Buttons */
        .primary-button {
            width: 100%;
            padding: 0.875rem;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 1.5rem;
        }

        .primary-button:hover {
            background-color: #0052a3;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #999;
            font-size: 0.875rem;
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
            flex-direction: row;
            gap: 0.75rem;
        }

        .sso-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.9375rem;
            font-weight: 500;
            text-decoration: none;
            color: #333;
            transition: background-color 0.2s;
        }

        .sso-button:hover {
            background-color: #f5f5f5;
        }

        .sso-icon {
            width: 20px;
            height: 20px;
            margin-right: 0.75rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .full-width-auth-container {
                flex-direction: column;
            }

            .auth-image-section {
                height: 200px;
            }

            .auth-form-content {
                padding: 1.5rem;
            }
        }
    </style>
@endsection
