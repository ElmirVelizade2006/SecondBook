@extends('Layout.Frontend.master')

@section('title', 'Become a Seller | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/seller-application.css') }}">
@endpush

@section('content')

<div class="seller-application-page">

    <div class="container py-5">

        {{-- Page Header --}}
        <div class="text-center mb-5">
            <span class="seller-application-badge">
                <i class="bi bi-shop"></i>
                SELLER PROGRAM
            </span>

            <h1 class="seller-application-title mt-3">
                Become a Seller
            </h1>

            <p class="seller-application-subtitle">
                Open your own store on SecondBook and start selling books
                to readers around the world.
            </p>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success seller-alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info seller-alert">
                <i class="bi bi-info-circle-fill me-2"></i>
                {{ session('info') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger seller-alert">
                <div class="fw-semibold mb-2">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    Please fix the following errors:
                </div>

                <ul class="mb-0 ps-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Pending Application --}}
        @if($application && $application->status === 'pending')

            <div class="seller-status-card">

                <div class="seller-status-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div class="seller-status-content">
                    <span class="seller-status-label">
                        Application Status
                    </span>

                    <h3>
                        Application Under Review
                    </h3>

                    <p>
                        Your seller application has been submitted successfully.
                        Our admin team will review your application soon.
                    </p>

                    <span class="seller-status-badge pending">
                        <i class="bi bi-clock me-1"></i>
                        Pending
                    </span>
                </div>

            </div>

        {{-- Rejected Application --}}
        @elseif($application && $application->status === 'rejected')

            <div class="seller-status-card rejected">

                <div class="seller-status-icon">
                    <i class="bi bi-x-circle"></i>
                </div>

                <div class="seller-status-content">

                    <span class="seller-status-label">
                        Application Status
                    </span>

                    <h3>
                        Application Rejected
                    </h3>

                    <p>
                        Your previous seller application was rejected.
                        You can review the information and submit a new application.
                    </p>

                    @if($application->rejection_reason)
                        <div class="rejection-reason">
                            <strong>Reason:</strong>
                            {{ $application->rejection_reason }}
                        </div>
                    @endif

                </div>

            </div>

        {{-- Application Form --}}
        @else

            <div class="row g-4 align-items-start">

                {{-- Information --}}
                <div class="col-lg-5">

                    <div class="seller-info-card">

                        <div class="seller-info-icon">
                            <i class="bi bi-shop-window"></i>
                        </div>

                        <h3>
                            Start Your Store
                        </h3>

                        <p>
                            Turn your books into a business. Create your own
                            SecondBook store and manage your books, orders and sales
                            from one place.
                        </p>

                        <div class="seller-benefits">

                            <div class="seller-benefit">
                                <div class="benefit-icon">
                                    <i class="bi bi-book"></i>
                                </div>

                                <div>
                                    <h6>Sell Your Books</h6>
                                    <span>
                                        List your books and reach new readers.
                                    </span>
                                </div>
                            </div>

                            <div class="seller-benefit">
                                <div class="benefit-icon">
                                    <i class="bi bi-shop"></i>
                                </div>

                                <div>
                                    <h6>Your Own Store</h6>
                                    <span>
                                        Build your own store on SecondBook.
                                    </span>
                                </div>
                            </div>

                            <div class="seller-benefit">
                                <div class="benefit-icon">
                                    <i class="bi bi-bar-chart"></i>
                                </div>

                                <div>
                                    <h6>Manage Your Sales</h6>
                                    <span>
                                        Track orders and sales from your seller panel.
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- Form --}}
                <div class="col-lg-7">

                    <div class="seller-form-card">

                        <div class="seller-form-header">
                            <h3>
                                Seller Application
                            </h3>

                            <p>
                                Tell us a little about your store.
                            </p>
                        </div>

                        <form
                            action="{{ route('frontend.seller-application.store') }}"
                            method="POST"
                        >

                            @csrf

                            {{-- Store Name --}}
                            <div class="mb-4">

                                <label for="store_name" class="form-label">
                                    Store Name
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="seller-input-wrapper">

                                    <i class="bi bi-shop"></i>

                                    <input
                                        type="text"
                                        id="store_name"
                                        name="store_name"
                                        class="form-control"
                                        value="{{ old('store_name') }}"
                                        placeholder="Enter your store name"
                                        required
                                    >

                                </div>

                                @error('store_name')
                                    <small class="text-danger d-block mt-2">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            {{-- Description --}}
                            <div class="mb-4">

                                <label for="description" class="form-label">
                                    Store Description
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control seller-textarea"
                                    rows="5"
                                    placeholder="Tell customers about your store and the books you sell..."
                                >{{ old('description') }}</textarea>

                                @error('description')
                                    <small class="text-danger d-block mt-2">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <div class="row">

                                {{-- Phone --}}
                                <div class="col-md-6 mb-4">

                                    <label for="phone" class="form-label">
                                        Phone Number
                                    </label>

                                    <div class="seller-input-wrapper">

                                        <i class="bi bi-telephone"></i>

                                        <input
                                            type="text"
                                            id="phone"
                                            name="phone"
                                            class="form-control"
                                            value="{{ old('phone', auth()->user()->phone) }}"
                                            placeholder="Enter your phone number"
                                        >

                                    </div>

                                    @error('phone')
                                        <small class="text-danger d-block mt-2">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                {{-- Address --}}
                                <div class="col-md-6 mb-4">

                                    <label for="address" class="form-label">
                                        Address
                                    </label>

                                    <div class="seller-input-wrapper">

                                        <i class="bi bi-geo-alt"></i>

                                        <input
                                            type="text"
                                            id="address"
                                            name="address"
                                            class="form-control"
                                            value="{{ old('address', auth()->user()->address) }}"
                                            placeholder="Enter your address"
                                        >

                                    </div>

                                    @error('address')
                                        <small class="text-danger d-block mt-2">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                            </div>

                            {{-- Footer --}}
                            <div class="seller-form-footer">

                                <div class="seller-privacy">
                                    <i class="bi bi-shield-check"></i>

                                    <span>
                                        Your application will be reviewed by our
                                        administration team.
                                    </span>
                                </div>

                                <button
                                    type="submit"
                                    class="seller-submit-btn"
                                >
                                    <i class="bi bi-send me-2"></i>
                                    Submit Application
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection