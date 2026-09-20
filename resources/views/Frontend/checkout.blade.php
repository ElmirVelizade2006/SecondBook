@extends('Layout.Frontend.master')

@section('title', 'Checkout | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}">
@endpush

@section('content')

<main class="sb-checkout-page">

    {{-- =====================================================
       PAGE HEADER
    ====================================================== --}}

    <section class="checkout-hero">
        <div class="container">

            <div class="checkout-breadcrumb">
                <a href="{{ route('frontend.cart') }}">
                    Shopping Cart
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>Checkout</span>
            </div>

            <div class="checkout-header">
                <span class="checkout-eyebrow">
                    <i class="bi bi-bag-check"></i>
                    Secure Checkout
                </span>

                <h1>Complete Your Order</h1>

                <p>
                    Enter your delivery details and choose your preferred
                    payment method to complete your purchase.
                </p>
            </div>

        </div>
    </section>


    {{-- =====================================================
       CHECKOUT CONTENT
    ====================================================== --}}

    <section class="checkout-section">

        <div class="container">

            @if(session('success'))
                <div class="checkout-alert checkout-alert-success">
                    <i class="bi bi-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="checkout-alert checkout-alert-error">
                    <i class="bi bi-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif


            <form
                action="{{ route('frontend.checkout.store') }}"
                method="POST"
                class="checkout-form"
            >

                @csrf

                <div class="row g-4">


                    {{-- =================================================
                       CUSTOMER INFORMATION
                    ================================================== --}}

                    <div class="col-lg-7">

                        <div class="checkout-card">

                            <div class="checkout-card-header">

                                <div class="checkout-card-icon">
                                    <i class="bi bi-person"></i>
                                </div>

                                <div>
                                    <h2>Customer Information</h2>

                                    <p>
                                        Where should we deliver your order?
                                    </p>
                                </div>

                            </div>


                            <div class="checkout-card-body">

                                <div class="row g-3">

                                    {{-- Full Name --}}
                                    <div class="col-12">

                                        <label
                                            for="full_name"
                                            class="checkout-label"
                                        >
                                            Full Name
                                            <span>*</span>
                                        </label>

                                        <div class="checkout-input-wrapper">

                                            <i class="bi bi-person"></i>

                                            <input
                                                type="text"
                                                id="full_name"
                                                name="full_name"
                                                class="checkout-input"
                                                value="{{ old('full_name', auth()->user()->name ?? '') }}"
                                                placeholder="Enter your full name"
                                                required
                                            >

                                        </div>

                                    </div>


                                    {{-- Phone --}}
                                    <div class="col-md-6">

                                        <label
                                            for="phone"
                                            class="checkout-label"
                                        >
                                            Phone
                                            <span>*</span>
                                        </label>

                                        <div class="checkout-input-wrapper">

                                            <i class="bi bi-telephone"></i>

                                            <input
                                                type="tel"
                                                id="phone"
                                                name="phone"
                                                class="checkout-input"
                                                value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                                placeholder="Enter your phone number"
                                                required
                                            >

                                        </div>

                                    </div>


                                    {{-- Country --}}
                                    <div class="col-md-6">

                                        <label
                                            for="country"
                                            class="checkout-label"
                                        >
                                            Country
                                            <span>*</span>
                                        </label>

                                        <div class="checkout-input-wrapper">

                                            <i class="bi bi-globe2"></i>

                                            <input
                                                type="text"
                                                id="country"
                                                name="country"
                                                class="checkout-input"
                                                value="{{ old('country', 'Azerbaijan') }}"
                                                placeholder="Enter your country"
                                                required
                                            >

                                        </div>

                                    </div>


                                    {{-- City --}}
                                    <div class="col-md-6">

                                        <label
                                            for="city"
                                            class="checkout-label"
                                        >
                                            City
                                            <span>*</span>
                                        </label>

                                        <div class="checkout-input-wrapper">

                                            <i class="bi bi-buildings"></i>

                                            <input
                                                type="text"
                                                id="city"
                                                name="city"
                                                class="checkout-input"
                                                value="{{ old('city') }}"
                                                placeholder="Enter your city"
                                                required
                                            >

                                        </div>

                                    </div>


                                    {{-- Postal Code --}}
                                    <div class="col-md-6">

                                        <label
                                            for="postal_code"
                                            class="checkout-label"
                                        >
                                            Postal Code
                                        </label>

                                        <div class="checkout-input-wrapper">

                                            <i class="bi bi-mailbox"></i>

                                            <input
                                                type="text"
                                                id="postal_code"
                                                name="postal_code"
                                                class="checkout-input"
                                                value="{{ old('postal_code') }}"
                                                placeholder="Enter postal code"
                                            >

                                        </div>

                                    </div>


                                    {{-- Address --}}
                                    <div class="col-12">

                                        <label
                                            for="address"
                                            class="checkout-label"
                                        >
                                            Delivery Address
                                            <span>*</span>
                                        </label>

                                        <div class="checkout-input-wrapper checkout-textarea-wrapper">

                                            <i class="bi bi-geo-alt"></i>

                                            <textarea
                                                id="address"
                                                name="address"
                                                class="checkout-input checkout-textarea"
                                                rows="4"
                                                placeholder="Enter your complete delivery address"
                                                required
                                            >{{ old('address') }}</textarea>

                                        </div>

                                    </div>


                                    {{-- Note --}}
                                    <div class="col-12">

                                        <label
                                            for="note"
                                            class="checkout-label"
                                        >
                                            Order Note
                                            <small>(Optional)</small>
                                        </label>

                                        <div class="checkout-input-wrapper checkout-textarea-wrapper">

                                            <i class="bi bi-chat-left-text"></i>

                                            <textarea
                                                id="note"
                                                name="note"
                                                class="checkout-input checkout-textarea"
                                                rows="3"
                                                placeholder="Any special instructions?"
                                            >{{ old('note') }}</textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                           PAYMENT METHOD
                        ================================================== --}}

                        <div class="checkout-card payment-card">

                            <div class="checkout-card-header">

                                <div class="checkout-card-icon">
                                    <i class="bi bi-credit-card"></i>
                                </div>

                                <div>
                                    <h2>Payment Method</h2>

                                    <p>
                                        Choose how you would like to pay.
                                    </p>
                                </div>

                            </div>


                            <div class="checkout-card-body">

                                <div class="payment-methods">

                                    {{-- Cash --}}
                                    <label class="payment-option">

                                        <input
                                            type="radio"
                                            name="payment_method"
                                            value="cash_on_delivery"
                                            {{ old('payment_method', 'cash_on_delivery') === 'cash_on_delivery' ? 'checked' : '' }}
                                        >

                                        <span class="payment-option-content">

                                            <span class="payment-option-icon">
                                                <i class="bi bi-cash-stack"></i>
                                            </span>

                                            <span class="payment-option-text">

                                                <strong>
                                                    Cash on Delivery
                                                </strong>

                                                <small>
                                                    Pay when your order arrives.
                                                </small>

                                            </span>

                                            <span class="payment-radio"></span>

                                        </span>

                                    </label>


                                    {{-- Credit Card --}}
                                    <label class="payment-option">

                                        <input
                                            type="radio"
                                            name="payment_method"
                                            value="credit_card"
                                            {{ old('payment_method') === 'credit_card' ? 'checked' : '' }}
                                        >

                                        <span class="payment-option-content">

                                            <span class="payment-option-icon">
                                                <i class="bi bi-credit-card"></i>
                                            </span>

                                            <span class="payment-option-text">

                                                <strong>
                                                    Credit Card
                                                </strong>

                                                <small>
                                                    Pay securely with your credit card.
                                                </small>

                                            </span>

                                            <span class="payment-radio"></span>

                                        </span>

                                    </label>


                                    {{-- Debit Card --}}
                                    <label class="payment-option">

                                        <input
                                            type="radio"
                                            name="payment_method"
                                            value="debit_card"
                                            {{ old('payment_method') === 'debit_card' ? 'checked' : '' }}
                                        >

                                        <span class="payment-option-content">

                                            <span class="payment-option-icon">
                                                <i class="bi bi-wallet2"></i>
                                            </span>

                                            <span class="payment-option-text">

                                                <strong>
                                                    Debit Card
                                                </strong>

                                                <small>
                                                    Pay securely with your debit card.
                                                </small>

                                            </span>

                                            <span class="payment-radio"></span>

                                        </span>

                                    </label>


                                    {{-- PayPal --}}
                                    <label class="payment-option">

                                        <input
                                            type="radio"
                                            name="payment_method"
                                            value="paypal"
                                            {{ old('payment_method') === 'paypal' ? 'checked' : '' }}
                                        >

                                        <span class="payment-option-content">

                                            <span class="payment-option-icon">
                                                <i class="bi bi-paypal"></i>
                                            </span>

                                            <span class="payment-option-text">

                                                <strong>
                                                    PayPal
                                                </strong>

                                                <small>
                                                    Pay securely through PayPal.
                                                </small>

                                            </span>

                                            <span class="payment-radio"></span>

                                        </span>

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                       ORDER SUMMARY
                    ================================================== --}}

                    <div class="col-lg-5">

                        <div class="checkout-summary">

                            <div class="checkout-summary-header">

                                <div>

                                    <span class="summary-eyebrow">
                                        Your Order
                                    </span>

                                    <h2>Order Summary</h2>

                                </div>

                                <span class="summary-count">
                                    {{ $totalItems }}
                                    {{ $totalItems === 1 ? 'item' : 'items' }}
                                </span>

                            </div>


                            {{-- Cart Items --}}
                            <div class="checkout-items">

                                @foreach($cart as $item)

                                    <div class="checkout-item">

                                        <div class="checkout-item-image">

                                            @if(!empty($item['cover']))
                                                <img
                                                    src="{{ asset('storage/' . $item['cover']) }}"
                                                    alt="{{ $item['title'] }}"
                                                >
                                            @else
                                                <div class="checkout-item-placeholder">
                                                    <i class="bi bi-book"></i>
                                                </div>
                                            @endif

                                        </div>


                                        <div class="checkout-item-info">

                                            <h3>
                                                {{ $item['title'] }}
                                            </h3>

                                            <div class="checkout-item-meta">

                                                <span>
                                                    Qty: {{ $item['quantity'] }}
                                                </span>

                                                <span>
                                                    ×
                                                </span>

                                                <span>
                                                    ${{ number_format($item['price'], 2) }}
                                                </span>

                                            </div>

                                        </div>


                                        <div class="checkout-item-total">

                                            ${{ number_format(
                                                $item['price'] * $item['quantity'],
                                                2
                                            ) }}

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            {{-- Summary Totals --}}
                            <div class="checkout-summary-totals">

                                <div class="summary-row">

                                    <span>
                                        Subtotal
                                    </span>

                                    <strong>
                                        ${{ number_format($subtotal, 2) }}
                                    </strong>

                                </div>


                                <div class="summary-row">

                                    <span>
                                        Shipping
                                    </span>

                                    <strong class="summary-free">
                                        FREE
                                    </strong>

                                </div>


                                <div class="summary-divider"></div>


                                <div class="summary-row summary-total">

                                    <span>
                                        Total
                                    </span>

                                    <strong>
                                        ${{ number_format($subtotal, 2) }}
                                    </strong>

                                </div>

                            </div>


                            {{-- Place Order --}}
                            <button
                                type="submit"
                                class="place-order-btn"
                            >

                                <span>
                                    Place Order
                                </span>

                                <i class="bi bi-arrow-right"></i>

                            </button>


                            <a
                                href="{{ route('frontend.cart') }}"
                                class="back-cart-btn"
                            >

                                <i class="bi bi-arrow-left"></i>

                                <span>
                                    Back to Cart
                                </span>

                            </a>


                            <div class="checkout-secure">

                                <i class="bi bi-shield-check"></i>

                                <span>
                                    Your information is protected and secure.
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </section>

</main>

@endsection