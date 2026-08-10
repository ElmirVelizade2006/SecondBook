@extends('layout.admin.master')

@section('title', 'Coupon Details')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/coupons.css') }}">
@endpush

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-ticket-perforated me-2"></i>
                Coupon Details
            </h2>

            <p class="text-muted mb-0">
                View coupon information.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route(
                'admin.coupons.edit',
                $coupon->id
            ) }}"
               class="btn btn-primary">

                <i class="bi bi-pencil me-2"></i>

                Edit

            </a>

            <a href="{{ route('admin.coupons.index') }}"
               class="btn btn-light">

                <i class="bi bi-arrow-left me-2"></i>

                Back

            </a>

        </div>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="row g-4">

                <div class="col-md-6">

                    <div class="coupon-detail">

                        <span>Coupon Code</span>

                        <strong>
                            {{ $coupon->code }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="coupon-detail">

                        <span>Discount</span>

                        <strong>

                            @if($coupon->type === 'percentage')

                                {{ number_format($coupon->value, 0) }}%

                            @else

                                ${{ number_format($coupon->value, 2) }}

                            @endif

                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="coupon-detail">

                        <span>Minimum Order</span>

                        <strong>
                            ${{ number_format(
                                $coupon->minimum_order_amount,
                                2
                            ) }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="coupon-detail">

                        <span>Maximum Discount</span>

                        <strong>

                            @if($coupon->maximum_discount_amount)

                                ${{ number_format(
                                    $coupon->maximum_discount_amount,
                                    2
                                ) }}

                            @else

                                No Limit

                            @endif

                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="coupon-detail">

                        <span>Usage</span>

                        <strong>

                            {{ $coupon->used_count }}

                            /

                            {{ $coupon->usage_limit ?? 'Unlimited' }}

                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="coupon-detail">

                        <span>Status</span>

                        <strong>

                            @if(!$coupon->status)

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @elseif($coupon->expires_at->isPast())

                                <span class="badge bg-danger">
                                    Expired
                                </span>

                            @elseif($coupon->starts_at->isFuture())

                                <span class="badge bg-warning text-dark">
                                    Scheduled
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @endif

                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="coupon-detail">

                        <span>Starts At</span>

                        <strong>
                            {{ $coupon->starts_at->format('d M Y, H:i') }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="coupon-detail">

                        <span>Expires At</span>

                        <strong>
                            {{ $coupon->expires_at->format('d M Y, H:i') }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection