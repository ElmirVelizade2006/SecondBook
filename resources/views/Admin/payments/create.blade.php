@extends('layout.admin.master')

@section('title', 'Create Payment')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/admin/css/payments.css') }}">
@endpush

@section('content')

<div class="container-fluid p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-credit-card-2-front me-2"></i>

                Create Payment

            </h2>

            <p class="text-muted mb-0">

                Create a new customer payment manually.

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


            <form action="{{ route('admin.payments.store') }}"
                  method="POST">

                @csrf

                <div class="row g-4">


                    {{-- Order --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Order
                        </label>

                        <select name="order_id"
                                class="form-select"
                                required>

                            <option value="">
                                Select Order
                            </option>

                            @foreach($orders as $order)

                                <option value="{{ $order->id }}">

                                    {{ $order->order_number }}
                                    -
                                    {{ $order->user->first_name }}
                                    {{ $order->user->last_name }}
                                    -
                                    ${{ number_format($order->total_price, 2) }}

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
                               placeholder="0.00"
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

                            <option value="cash_on_delivery">
                                Cash On Delivery
                            </option>

                            <option value="credit_card">
                                Credit Card
                            </option>

                            <option value="debit_card">
                                Debit Card
                            </option>

                            <option value="paypal">
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

                            <option value="pending">
                                Pending
                            </option>

                            <option value="paid">
                                Paid
                            </option>

                            <option value="failed">
                                Failed
                            </option>

                            <option value="refunded">
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
                               class="form-control">

                    </div>


                    {{-- Note --}}
                    <div class="col-12">

                        <label class="form-label">
                            Note
                        </label>

                        <textarea name="note"
                                  class="form-control"
                                  rows="3"></textarea>

                    </div>

                </div>


                <div class="mt-4 text-end">

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-check-circle me-2"></i>

                        Create Payment

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection