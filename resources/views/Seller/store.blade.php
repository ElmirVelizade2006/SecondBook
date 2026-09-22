@extends('Layout.Seller.master')

@section('title', 'My Store')

@push('css')
    <link rel="stylesheet" href="{{ asset('seller/css/store.css') }}">
@endpush

@section('content')

<div class="seller-store-page">


{{-- Page Header --}}
<div class="seller-page-heading">

    <div>
        <h1>My Store</h1>
        <p>Manage your store information and profile.</p>
    </div>

    <a href="{{ route('frontend.home') }}" class="seller-outline-button">
        <i class="bi bi-shop"></i>
        View Store
    </a>

</div>


{{-- Success Message --}}
@if(session('success'))
    <div class="seller-alert seller-alert-success">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif


{{-- Validation Errors --}}
@if($errors->any())
    <div class="seller-alert seller-alert-danger">
        <i class="bi bi-exclamation-circle-fill"></i>

        <div>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    </div>
@endif


<form action="{{ route('seller.store.update') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="row g-4">

        {{-- Store Preview --}}
        <div class="col-xl-4">

            <div class="seller-store-card">

                <div class="seller-store-cover"></div>

                <div class="seller-store-profile">

                    <div class="seller-store-logo">

                        @if($store->logo)
                            <img
                                src="{{ asset('storage/' . $store->logo) }}"
                                alt="{{ $store->name }}"
                            >
                        @else
                            <i class="bi bi-shop"></i>
                        @endif

                    </div>

                    <div class="seller-store-info">

                        <h4>{{ $store->name }}</h4>

                        <span>
                            <i class="bi bi-link-45deg"></i>
                            /{{ $store->slug }}
                        </span>

                    </div>

                </div>

                <div class="seller-store-meta">

                    <div>
                        <span>Status</span>

                        <strong class="{{ $store->isActive() ? 'active' : 'inactive' }}">
                            <i class="bi bi-circle-fill"></i>
                            {{ ucfirst($store->status) }}
                        </strong>
                    </div>

                    <div>
                        <span>Created</span>

                        <strong>
                            {{ $store->created_at?->format('M d, Y') }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>


        {{-- Store Settings --}}
        <div class="col-xl-8">

            <div class="seller-store-form-card">

                <div class="seller-form-header">

                    <div>
                        <h5>Store Information</h5>
                        <p>Update your public store information.</p>
                    </div>

                </div>


                <div class="seller-form-body">

                    {{-- Store Name --}}
                    <div class="seller-form-group">

                        <label for="name">
                            Store Name
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $store->name) }}"
                            placeholder="Enter store name"
                            required
                        >

                    </div>


                    {{-- Description --}}
                    <div class="seller-form-group">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Tell customers about your store..."
                        >{{ old('description', $store->description) }}</textarea>

                    </div>


                    <div class="row g-3">

                        {{-- Phone --}}
                        <div class="col-md-6">

                            <div class="seller-form-group">

                                <label for="phone">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone', $store->phone) }}"
                                    placeholder="Enter phone number"
                                >

                            </div>

                        </div>


                        {{-- Address --}}
                        <div class="col-md-6">

                            <div class="seller-form-group">

                                <label for="address">
                                    Address
                                </label>

                                <input
                                    type="text"
                                    id="address"
                                    name="address"
                                    value="{{ old('address', $store->address) }}"
                                    placeholder="Enter store address"
                                >

                            </div>

                        </div>

                    </div>


                    {{-- Logo --}}
                    <div class="seller-form-group">

                        <label for="logo">
                            Store Logo
                        </label>

                        <div class="seller-logo-upload">

                            <div class="seller-logo-preview">

                                @if($store->logo)

                                    <img
                                        src="{{ asset('storage/' . $store->logo) }}"
                                        alt="Store Logo"
                                    >

                                @else

                                    <i class="bi bi-image"></i>

                                @endif

                            </div>

                            <div class="seller-logo-content">

                                <label for="logo" class="seller-upload-button">
                                    <i class="bi bi-upload"></i>
                                    Choose Logo
                                </label>

                                <input
                                    type="file"
                                    id="logo"
                                    name="logo"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                <p>
                                    JPG, JPEG, PNG or WEBP. Maximum 2MB.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="seller-form-actions">

                        <a href="{{ route('seller.dashboard') }}"
                           class="seller-cancel-button">
                            Cancel
                        </a>

                        <button type="submit"
                                class="seller-save-button">
                            <i class="bi bi-check2"></i>
                            Save Changes
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>


</div>

@endsection
