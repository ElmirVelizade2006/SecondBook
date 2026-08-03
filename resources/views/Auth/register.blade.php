@extends('Layout.Frontend.master')

@section('title', 'Register | SecondBook')
@section('hideNavbar', '1')
@section('hideFooter', '1')
@section('hideScripts', '1')

@push('css')
    @include('Auth.partials.auth-styles')
    <style>

        .form-check-label a,
        .form-check-label a:visited {
            color: #8B5E3C;
            font-weight: 600;
            text-decoration: none;
        }

        .form-check-label a:hover {
            color: #6f4b34;
            text-decoration: underline;
        }
        
    </style>
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
                    <h4 class="sb-login-title">Create Account</h4>
                    <p class="sb-login-subtitle">Join SecondBook and start your reading journey.</p>
                </div>

                @if ($errors->any())

                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach
                        </ul>
                    </div>

                @endif

                <form action="{{ route('frontend.auth.register.store') }}" method="POST" class="sb-login-form">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3 sb-field">
                            <label class="form-label" for="firstName">First Name</label>
                            <div class="input-group sb-input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input
                                    type="text"
                                    id="firstName"
                                    name="first_name"
                                    class="form-control"
                                    placeholder="First Name"
                                    value="{{ old('first_name') }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3 sb-field">
                            <label class="form-label" for="lastName">Last Name</label>
                            <div class="input-group sb-input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input
                                    type="text"
                                    id="lastName"
                                    name="last_name"
                                    class="form-control"
                                    placeholder="Last Name"
                                    value="{{ old('last_name') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 sb-field">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-group sb-input-group">
                            <span class="input-group-text">
                                <i class="bi bi-at"></i>
                            </span>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                placeholder="Choose a username"
                                value="{{ old('username') }}">
                        </div>
                    </div>

                    <div class="mb-3 sb-field">
                        <label class="form-label" for="registerEmail">Email Address</label>
                        <div class="input-group sb-input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input
                                type="email"
                                id="registerEmail"
                                name="email"
                                class="form-control"
                                placeholder="name@example.com"
                                value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="mb-3 sb-field">
                        <label class="form-label" for="registerPassword">Password</label>
                        <div class="input-group sb-input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input
                                type="password"
                                id="registerPassword"
                                name="password"
                                class="form-control"
                                placeholder="Minimum 8 characters">
                        </div>
                    </div>

                    <div class="mb-3 sb-field">
                        <label class="form-label" for="registerPasswordConfirm">Confirm Password</label>
                        <div class="input-group sb-input-group">
                            <span class="input-group-text">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            <input
                                type="password"
                                id="registerPasswordConfirm"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Repeat Password">
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3 sb-row">
                        <div class="form-check sb-remember-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="termsCheck"
                                name="terms"
                                value="1"
                                {{ old('terms') ? 'checked' : '' }}>

                            <label class="form-check-label" for="termsCheck">
                                I agree to the
                                <a href="{{ route('frontend.auth.terms') }}" target="_blank">
                                    Terms and Conditions
                                </a>
                            </label>
                        </div>

                        <a href="{{ route('frontend.auth.login') }}" class="sb-forgot-link">
                            Already have an account?
                        </a>
                    </div>

                    <button type="submit" class="btn w-100 sb-signin-btn">
                        <i class="bi bi-person-check me-2"></i>
                        Create Account
                    </button>
                </form>

                <ul class="sb-login-features list-unstyled mb-3 mt-3">
                    <li><i class="bi bi-check2"></i> Save your favorite books</li>
                    <li><i class="bi bi-check2"></i> Connect with trusted readers</li>
                    <li><i class="bi bi-check2"></i> Access thousands of listings</li>
                </ul>

                <p class="mb-0 text-center sb-register-copy">
                    Already have an account?
                    <a href="{{ route('frontend.auth.login') }}" class="sb-register-link">Sign In</a>
                </p>
            </section>
        </div>
    </div>
</div>
@endsection
