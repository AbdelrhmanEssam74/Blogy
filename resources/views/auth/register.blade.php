@extends('app.layout')
@section('description')
    Register to join our community and start your journey with us. Create an account to access exclusive features and stay connected.
@endsection
@section('title', 'Register')
@section('content')
    <div class="full-width-auth-container">
        <!-- Image Section -->
        <div class="auth-image-section">
            <img fetchpriority="high"
                 src="{{asset('images/auth-background.png')}}"
                 alt="Auth Background">
        </div>

        <!-- Form Section -->
        <div class="auth-form-section">
            <div class="auth-form-content">
                <h2 class="auth-title">Create Account</h2>
                <p class="text-center text-muted mb-4">
                    Join our bold community in just a few seconds!
                </p>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="form-floating mb-3">
                        <input id="full_name" type="text" name="full_name"
                               class="form-control @error('full_name') is-invalid @enderror"
                               placeholder="Your Full Name" value="{{ old('full_name') }}">
                        <label for="full_name"><i class="bi bi-person-fill me-2"></i>Full Name</label>
                        @error('full_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input id="email" type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="email"><i class="bi bi-envelope-fill me-2"></i>Email address</label>
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input id="password" type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Password">
                        <label for="password"><i class="bi bi-lock-fill me-2"></i>Password</label>
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-floating mb-4">
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="form-control" placeholder="Confirm Password">
                        <label for="password-confirm"><i class="bi bi-shield-lock-fill me-2"></i>Confirm Password</label>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn-auth">
                            <i class="bi bi-person-plus-fill me-1"></i> Register
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="divider">Or sign up with</div>

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
                    <!-- Already have an account -->
                    <div class="text-center mt-4">
                        <small class="text-muted">Already have an account?</small>
                        <a href="{{ route('login') }}" class="fw-bold login-link">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Container */
        .full-width-auth-container {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(135deg, #eef2f3, #ffffff);
        }

        /* Left Image */
        .auth-image-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .auth-image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Right Form */
        .auth-form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(15px);
        }

        .auth-form-content {
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            padding: 2.5rem;
            animation: fadeInUp 0.6s ease;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }

        /* Input fields */
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 4px rgba(74,144,226,0.15);
        }

        /* Button */
        .btn-auth {
            padding: 0.9rem;
            background: linear-gradient(135deg, #4a90e2, #007aff);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-auth:hover {
            background: linear-gradient(135deg, #007aff, #4a90e2);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(74,144,226,0.3);
        }

        /* Links */
        .login-link {
            color: #007aff;
            transition: color 0.2s;
        }
        .login-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
        /* Responsive */
        @media (max-width: 992px) {
            .full-width-auth-container {
                flex-direction: column;
            }
            .auth-image-section {
                height: 220px;
            }
            .auth-image-section img {
                height: 100%;
            }
        }
    </style>

@endsection
