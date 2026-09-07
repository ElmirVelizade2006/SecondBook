@extends('Layout.Frontend.master')

@section('title', 'Password Reset | SecondBook')
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
                    <img src="{{ asset('main-logo.png') }}" 
                         alt="SecondBook logo" 
                         class="sb-login-logo">
                </div>



                <div class="sb-login-head text-center">

                    <h4 class="sb-login-title">
                        Reset Your Password
                    </h4>

                    <p class="sb-login-subtitle">
                        Enter your email address and we will send you a 6-digit verification code.
                    </p>

                </div>



                @if ($errors->any())

                    <div class="alert alert-danger d-flex">

                        <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>

                        <ul class="mb-0 ps-3">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif



                <form action="{{ route('frontend.auth.password.send.otp') }}" 
                      method="POST" 
                      class="sb-login-form">

                    @csrf

                    <input type="hidden" name="_redirect_to" value="{{ route('frontend.auth.password.verify') }}">

                    <div class="mb-4 sb-field">

                        <label class="form-label" for="email">
                            Email Address
                        </label>

                        <div class="input-group sb-input-group">

                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>

                            <input 
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter your email"
                                required
                                autofocus
                            >

                        </div>

                    </div>

                    <button type="submit" class="btn w-100 sb-signin-btn mt-3">

                        <i class="bi bi-send-fill me-2"></i>

                        Send Verification Code

                    </button>

                </form>



                <div class="text-center mt-4">

                    <p class="text-muted small mb-2">

                        Remember your password?

                        <a href="{{ route('frontend.auth.login') }}">
                            Sign in
                        </a>

                    </p>


                    <a href="{{ route('frontend.auth.register') }}" 
                       class="sb-register-link">

                        Create an Account

                    </a>

                </div>



            </section>

        </div>

    </div>

</div>
@endsection