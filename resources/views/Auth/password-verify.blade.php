@extends('Layout.Frontend.master')

@section('title', 'Verify Code | SecondBook')
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
                        Verify Your Code
                    </h4>


                    <p class="sb-login-subtitle">
                        Enter the 6-digit code sent to your email and create a new password.
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




                @if(session('status'))

                    <div class="alert alert-success d-flex align-items-center">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        {{ session('status') }}

                    </div>

                @endif





                <form action="{{ route('frontend.auth.password.verify.otp') }}" 
                      method="POST" 
                      class="sb-login-form">

                    @csrf



                    {{-- OTP --}}

                    <div class="mb-4 sb-field">


                        <label class="form-label" for="otp_code">

                            Verification Code

                        </label>



                        <div class="input-group sb-input-group">


                            <span class="input-group-text">

                                <i class="bi bi-shield-lock-fill"></i>

                            </span>



                            <input 
                                type="text"
                                id="otp_code"
                                name="otp_code"
                                class="form-control"
                                placeholder="Enter 6 digit code"
                                maxlength="6"
                                required
                                autofocus
                            >


                        </div>


                    </div>





                    {{-- PASSWORD --}}


                    <div class="mb-4 sb-field">


                        <label class="form-label" for="password">

                            New Password

                        </label>



                        <div class="input-group sb-input-group">


                            <span class="input-group-text">

                                <i class="bi bi-lock-fill"></i>

                            </span>



                            <input 
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Create new password"
                                required
                            >


                        </div>


                    </div>





                    <button type="submit" class="btn w-100 sb-signin-btn mt-3">


                        <i class="bi bi-check-circle-fill me-2"></i>


                        Reset Password


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