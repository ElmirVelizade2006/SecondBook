@extends('layout.admin.master')

@section('title', 'Edit Payment')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/payments.css') }}">
@endpush

@section('content')

<div class="container-fluid p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-pencil-square me-2"></i>

                Edit Payment

            </h2>

            <p class="text-muted mb-0">

                Update payment information and status.

            </p>

        </div>


        <a href="{{ route('admin.payments.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-2"></i>

            Back

        </a>

    </div>


    {{-- Form --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form action="{{ route('admin.payments.update', $payment->id) }}"
                  method="POST">

                @csrf

                @method('PUT')


                <div class="row g-4">


                    {{-- Transaction ID --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Transaction ID
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $payment->transaction_id }}"
                               disabled>

                    </div>


                    {{-- Order --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Order
                        </label>

                        <select name="order_id"
                                class="form-select"
                                required>

                            @foreach($orders as $order)

                                <option value="{{ $order->id }}"
                                    {{ $payment->order_id == $order->id ? 'selected' : '' }}>

                                    {{ $order->order_number }}
                                    -
                                    {{ $order->user->first_name }}
                                    {{ $order->user->last_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Amount --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Amount
                        </label>

                        <input type="number"
                               name="amount"
                               class="form-control"
                               step="0.01"
                               min="0"
                               value="{{ $payment->amount }}"
                               required>

                    </div>


                    {{-- Payment Method --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Payment Method
                        </label>

                        <select name="payment_method"
                                class="form-select"
                                required>

                            <option value="cash_on_delivery"
                                {{ $payment->payment_method == 'cash_on_delivery' ? 'selected' : '' }}>
                                Cash On Delivery
                            </option>

                            <option value="credit_card"
                                {{ $payment->payment_method == 'credit_card' ? 'selected' : '' }}>
                                Credit Card
                            </option>

                            <option value="debit_card"
                                {{ $payment->payment_method == 'debit_card' ? 'selected' : '' }}>
                                Debit Card
                            </option>

                            <option value="paypal"
                                {{ $payment->payment_method == 'paypal' ? 'selected' : '' }}>
                                PayPal
                            </option>

                        </select>

                    </div>


                    {{-- Payment Status --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Payment Status
                        </label>

                        <select name="payment_status"
                                class="form-select"
                                required>

                            <option value="pending"
                                {{ $payment->payment_status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="paid"
                                {{ $payment->payment_status == 'paid' ? 'selected' : '' }}>
                                Paid
                            </option>

                            <option value="failed"
                                {{ $payment->payment_status == 'failed' ? 'selected' : '' }}>
                                Failed
                            </option>

                            <option value="refunded"
                                {{ $payment->payment_status == 'refunded' ? 'selected' : '' }}>
                                Refunded
                            </option>

                        </select>

                    </div>


                    {{-- Paid At --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Paid At
                        </label>

                        <input type="datetime-local"
                               name="paid_at"
                               class="form-control"
                               value="{{ $payment->paid_at ? $payment->paid_at->format('Y-m-d\TH:i') : '' }}">

                    </div>


                    {{-- Note --}}
                    <div class="col-12">

                        <label class="form-label">
                            Note
                        </label>

                        <textarea name="note"
                                  class="form-control"
                                  rows="3">{{ $payment->note }}</textarea>

                    </div>

                </div>


                <div class="mt-4 text-end">

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-check-circle me-2"></i>

                        Update Payment

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection