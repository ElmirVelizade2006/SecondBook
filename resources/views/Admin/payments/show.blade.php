@extends('layout.admin.master')

@section('title', 'Payment Details')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/payments.css') }}">
@endpush

@section('content')

<div class="container-fluid p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-receipt me-2"></i>

                Payment Details

            </h2>

            <p class="text-muted mb-0">

                View payment and transaction information.

            </p>

        </div>


        <div>

            <a href="{{ route('admin.payments.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left me-2"></i>

                Back

            </a>

            <a href="{{ route('admin.payments.edit', $payment->id) }}"
               class="btn btn-primary">

                <i class="bi bi-pencil me-2"></i>

                Edit

            </a>

        </div>

    </div>


    <div class="row g-4">


        {{-- Payment Information --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Payment Information
                    </h5>


                    <div class="row g-4">


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Transaction ID
                            </small>

                            <strong>
                                {{ $payment->transaction_id }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Amount
                            </small>

                            <strong>
                                ${{ number_format($payment->amount, 2) }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Payment Method
                            </small>

                            <strong>

                                @switch($payment->payment_method)

                                    @case('cash_on_delivery')
                                        Cash On Delivery
                                        @break

                                    @case('credit_card')
                                        Credit Card
                                        @break

                                    @case('debit_card')
                                        Debit Card
                                        @break

                                    @case('paypal')
                                        PayPal
                                        @break

                                @endswitch

                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Payment Status
                            </small>

                            @if($payment->payment_status === 'paid')

                                <span class="badge bg-success">
                                    Paid
                                </span>

                            @elseif($payment->payment_status === 'pending')

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            @elseif($payment->payment_status === 'failed')

                                <span class="badge bg-danger">
                                    Failed
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Refunded
                                </span>

                            @endif

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Payment Date
                            </small>

                            <strong>

                                {{ $payment->created_at->format('d M Y, H:i') }}

                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Paid At
                            </small>

                            <strong>

                                {{ $payment->paid_at
                                    ? $payment->paid_at->format('d M Y, H:i')
                                    : '—'
                                }}

                            </strong>

                        </div>


                        <div class="col-12">

                            <small class="text-muted d-block">
                                Note
                            </small>

                            <p class="mb-0">

                                {{ $payment->note ?: 'No note available.' }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Order Information --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Order Information
                    </h5>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Order Number
                        </small>

                        <strong>
                            {{ $payment->order->order_number }}
                        </strong>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Customer
                        </small>

                        <strong>

                            {{ $payment->order->user->first_name }}
                            {{ $payment->order->user->last_name }}

                        </strong>

                        <small class="text-muted d-block">

                            {{ $payment->order->user->email }}

                        </small>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Book
                        </small>

                        <strong>
                            {{ $payment->order->book->title }}
                        </strong>

                    </div>


                    <div>

                        <small class="text-muted d-block">
                            Order Total
                        </small>

                        <strong>
                            ${{ number_format($payment->order->total_price, 2) }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection