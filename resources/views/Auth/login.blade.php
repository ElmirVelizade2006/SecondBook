
@extends('Layout.Frontend.master')

@section('title', 'Login | SecondBook')
@section('hideNavbar', '1')
@section('hideFooter', '1')
@section('hideScripts', '1')

@push('css')
    @include('Auth.partials.auth-styles')
@endpush

@section('content')
<div class="auth-page-bg auth-page-bg-login">
    <div class="container auth-wrapper py-0">
        <div class="auth-grid auth-grid-login w-100">
            <section class="auth-card auth-card-login auth-card-login-pro">
                <div class="sb-login-brand text-center">
                    <img src="{{ asset('main-logo.png') }}" alt="SecondBook logo" class="sb-login-logo">
                </div>

                <div class="sb-login-head text-center">
                    <h4 class="sb-login-title">Welcome Back <span aria-hidden="true">&#128075;</span></h4>
                    <p class="sb-login-subtitle">Sign in to continue your reading journey.</p>
                </div>

                @if(session('error'))

                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>

                @endif

                <form action="{{ route('frontend.auth.login.store') }}" method="POST" class="sb-login-form">
                    @csrf
                    <div class="mb-3 sb-field">
                        <label class="form-label" for="loginEmail">Email address</label>
                        <div class="input-group sb-input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" id="loginEmail" name="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="mb-3 sb-field">
                        <label class="form-label" for="loginPassword">Password</label>
                        <div class="input-group sb-input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" id="loginPassword" name="password" class="form-control" placeholder="Enter your password" value="{{ old('password') }}">
                            <button class="input-group-text sb-pass-toggle" type="button" id="toggleLoginPassword" aria-label="Toggle password visibility">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3 sb-row">
                        <div class="form-check sb-remember-check">
                            <input class="form-check-input"type="checkbox"id="rememberCheck"name="remember"value="1"{{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="rememberCheck">Remember me</label>
                        </div>
                        <a href="{{ route('frontend.auth.password.request') }}" class="sb-forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn w-100 sb-signin-btn">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Sign In
                    </button>

                    <div class="sb-divider my-3">
                        <span>OR</span>
                    </div>

                    <button type="button" class="btn w-100 sb-google-btn">
                        <i class="bi bi-google me-2"></i>
                        Continue with Google
                    </button>
                </form>

                <ul class="sb-login-features list-unstyled mb-3 mt-3">
                    <li><i class="bi bi-check2"></i> Buy &amp; Sell Books</li>
                    <li><i class="bi bi-check2"></i> Trusted Community</li>
                    <li><i class="bi bi-check2"></i> Thousands of Books</li>
                </ul>

                <p class="mb-0 text-center sb-register-copy">
                    Don't have an account?
                    <a href="{{ route('frontend.auth.register') }}" class="sb-register-link">Create Account</a>
                </p>
            </section>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    (function () {
        var toggleBtn = document.getElementById('toggleLoginPassword');
        var passwordInput = document.getElementById('loginPassword');
        if (!toggleBtn || !passwordInput) return;

        toggleBtn.addEventListener('click', function () {
            var isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            toggleBtn.innerHTML = isPassword
                ? '<i class="bi bi-eye-slash"></i>'
                : '<i class="bi bi-eye"></i>';
        });
    })();
</script>
@endpush
