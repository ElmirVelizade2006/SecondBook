@extends('layout.admin.master')

@section('title', 'Add Coupon')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/coupons.css') }}">
@endpush

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-ticket-perforated me-2"></i>
                Add Coupon
            </h2>

            <p class="text-muted mb-0">
                Create a new discount coupon.
            </p>

        </div>

        <a href="{{ route('admin.coupons.index') }}"
           class="btn btn-light">

            <i class="bi bi-arrow-left me-2"></i>

            Back

        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('admin.coupons.store') }}" class="coupon-form">

                @csrf

                <div class="row g-4">

                    {{-- Code --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Coupon Code
                        </label>

                        <input type="text"
                               name="code"
                               value="{{ old('code') }}"
                               class="form-control @error('code') is-invalid @enderror"
                               placeholder="WELCOME10">

                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Type --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Discount Type
                        </label>

                        <select name="type"
                                id="couponType"
                                class="form-select @error('type') is-invalid @enderror">

                            <option value="">
                                Select Type
                            </option>

                            <option value="percentage"
                                {{ old('type') == 'percentage' ? 'selected' : '' }}>
                                Percentage (%)
                            </option>

                            <option value="fixed"
                                {{ old('type') == 'fixed' ? 'selected' : '' }}>
                                Fixed Amount ($)
                            </option>

                        </select>

                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Value --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Discount Value
                        </label>

                        <input type="number"
                               name="value"
                               value="{{ old('value') }}"
                               step="0.01"
                               min="0.01"
                               class="form-control @error('value') is-invalid @enderror"
                               placeholder="10">

                        @error('value')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Minimum Order --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Minimum Order Amount
                        </label>

                        <input type="number"
                               name="minimum_order_amount"
                               value="{{ old('minimum_order_amount', 0) }}"
                               step="0.01"
                               min="0"
                               class="form-control @error('minimum_order_amount') is-invalid @enderror"
                               placeholder="20">

                        @error('minimum_order_amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Maximum Discount --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Maximum Discount Amount
                        </label>

                        <input type="number"
                               name="maximum_discount_amount"
                               value="{{ old('maximum_discount_amount') }}"
                               step="0.01"
                               min="0"
                               class="form-control @error('maximum_discount_amount') is-invalid @enderror"
                               placeholder="50">

                        <small class="text-muted">
                            Mainly useful for percentage coupons.
                        </small>

                        @error('maximum_discount_amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Usage Limit --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Usage Limit
                        </label>

                        <input type="number"
                               name="usage_limit"
                               value="{{ old('usage_limit') }}"
                               min="1"
                               class="form-control @error('usage_limit') is-invalid @enderror"
                               placeholder="100">

                        <small class="text-muted">
                            Leave empty for unlimited usage.
                        </small>

                        @error('usage_limit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Starts --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Starts At
                        </label>

                        <input type="datetime-local"
                               name="starts_at"
                               value="{{ old('starts_at') }}"
                               class="form-control @error('starts_at') is-invalid @enderror">

                        @error('starts_at')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Expires --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Expires At
                        </label>

                        <input type="datetime-local"
                               name="expires_at"
                               value="{{ old('expires_at') }}"
                               class="form-control @error('expires_at') is-invalid @enderror">

                        @error('expires_at')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="1"
                                {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status') == '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-12">

                        <hr>

                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('admin.coupons.index') }}"
                               class="btn btn-light">

                                Cancel

                            </a>

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-check-lg me-2"></i>

                                Create Coupon

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection