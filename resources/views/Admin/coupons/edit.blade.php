@extends('layout.admin.master')

@section('title', 'Edit Coupon')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/coupons.css') }}">
@endpush

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Coupon
            </h2>

            <p class="text-muted mb-0">
                Update coupon information.
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
                  action="{{ route(
                      'admin.coupons.update',
                      $coupon->id
                  ) }}">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Coupon Code
                        </label>

                        <input type="text"
                               name="code"
                               value="{{ old('code', $coupon->code) }}"
                               class="form-control @error('code') is-invalid @enderror">

                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Discount Type
                        </label>

                        <select name="type"
                                class="form-select">

                            <option value="percentage"
                                {{ old('type', $coupon->type) === 'percentage' ? 'selected' : '' }}>
                                Percentage (%)
                            </option>

                            <option value="fixed"
                                {{ old('type', $coupon->type) === 'fixed' ? 'selected' : '' }}>
                                Fixed Amount ($)
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Discount Value
                        </label>

                        <input type="number"
                               name="value"
                               value="{{ old('value', $coupon->value) }}"
                               step="0.01"
                               min="0.01"
                               class="form-control @error('value') is-invalid @enderror">

                        @error('value')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Minimum Order Amount
                        </label>

                        <input type="number"
                               name="minimum_order_amount"
                               value="{{ old(
                                   'minimum_order_amount',
                                   $coupon->minimum_order_amount
                               ) }}"
                               step="0.01"
                               min="0"
                               class="form-control">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Maximum Discount Amount
                        </label>

                        <input type="number"
                               name="maximum_discount_amount"
                               value="{{ old(
                                   'maximum_discount_amount',
                                   $coupon->maximum_discount_amount
                               ) }}"
                               step="0.01"
                               min="0"
                               class="form-control">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Usage Limit
                        </label>

                        <input type="number"
                               name="usage_limit"
                               value="{{ old(
                                   'usage_limit',
                                   $coupon->usage_limit
                               ) }}"
                               min="1"
                               class="form-control">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Starts At
                        </label>

                        <input type="datetime-local"
                               name="starts_at"
                               value="{{ old(
                                   'starts_at',
                                   $coupon->starts_at->format('Y-m-d\TH:i')
                               ) }}"
                               class="form-control">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Expires At
                        </label>

                        <input type="datetime-local"
                               name="expires_at"
                               value="{{ old(
                                   'expires_at',
                                   $coupon->expires_at->format('Y-m-d\TH:i')
                               ) }}"
                               class="form-control">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="1"
                                {{ old('status', $coupon->status) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status', $coupon->status) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


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

                                Update Coupon

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection