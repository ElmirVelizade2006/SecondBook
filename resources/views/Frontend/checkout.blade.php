@extends('Layout.Frontend.master')

@section('title', 'Checkout | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}">
@endpush

@section('content')

<main class="sb-checkout-page">

    {{-- =====================================================
        HERO
    ====================================================== --}}
    <section class="checkout-hero">
        <div class="container">

            <div class="checkout-breadcrumb">

                <a href="{{ route('frontend.cart') }}">
                    <i class="bi bi-arrow-left"></i>
                    Shopping Cart
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>Checkout</span>

            </div>

            <div class="checkout-hero-content">

                <div class="checkout-hero-copy">

                    <span class="checkout-eyebrow">

                        <span class="checkout-eyebrow-icon">
                            <i class="bi bi-shield-check"></i>
                        </span>

                        Secure Checkout

                    </span>

                    <h1>
                        Complete Your
                        <span>Order</span>
                    </h1>

                    <p>
                        You're just a few steps away from getting your books.
                        Enter your delivery details and choose your preferred
                        payment method.
                    </p>

                </div>

                <div class="checkout-progress">

                    <div class="checkout-progress-step is-complete">

                        <span class="checkout-step-icon">
                            <i class="bi bi-check2"></i>
                        </span>

                        <span>Cart</span>

                    </div>

                    <span class="checkout-progress-line is-active"></span>

                    <div class="checkout-progress-step is-active">

                        <span class="checkout-step-icon">
                            <i class="bi bi-bag-check"></i>
                        </span>

                        <span>Checkout</span>

                    </div>

                    <span class="checkout-progress-line"></span>

                    <div class="checkout-progress-step">

                        <span class="checkout-step-icon">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>Complete</span>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =====================================================
        CHECKOUT CONTENT
    ====================================================== --}}
    <section class="checkout-section">

        <div class="container">

            {{-- Alerts --}}

            @if(session('success'))

                <div class="checkout-alert checkout-alert-success">

                    <span class="checkout-alert-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if(session('error'))

                <div class="checkout-alert checkout-alert-error">

                    <span class="checkout-alert-icon">
                        <i class="bi bi-exclamation-circle-fill"></i>
                    </span>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            @if($errors->any())

                <div class="checkout-alert checkout-alert-error">

                    <span class="checkout-alert-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </span>

                    <div>

                        <strong>
                            Please check the following:
                        </strong>

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif


            <form
                action="{{ route('frontend.checkout.store') }}"
                method="POST"
                class="checkout-form"
            >

                @csrf

                <div class="row g-4 g-xl-5">

                    {{-- =================================================
                        LEFT COLUMN
                    ================================================== --}}
                    <div class="col-lg-7">


                        {{-- =================================================
                            CUSTOMER INFORMATION
                        ================================================== --}}
                        <div class="checkout-card">

                            <div class="checkout-card-header">

                                <div class="checkout-card-heading">

                                    <div class="checkout-card-icon">
                                        <i class="bi bi-person-vcard"></i>
                                    </div>

                                    <div>

                                        <span class="checkout-card-kicker">
                                            Delivery Details
                                        </span>

                                        <h2>
                                            Customer Information
                                        </h2>

                                        <p>
                                            Tell us where you'd like your
                                            order delivered.
                                        </p>

                                    </div>

                                </div>

                                <span class="required-badge">
                                    * Required
                                </span>

                            </div>


                            <div class="checkout-card-body">

                                <div class="row g-3 g-md-4">


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

                                            <span class="checkout-input-icon">
                                                <i class="bi bi-person"></i>
                                            </span>

                                            <input
                                                type="text"
                                                id="full_name"
                                                name="full_name"
                                                class="checkout-input"
                                                value="{{ old('full_name', auth()->user()->name ?? '') }}"
                                                placeholder="Enter your full name"
                                                autocomplete="name"
                                                required
                                            >

                                        </div>

                                        @error('full_name')

                                            <small class="checkout-field-error">
                                                {{ $message }}
                                            </small>

                                        @enderror

                                    </div>


                                    {{-- Phone --}}
                                    <div class="col-md-6">

                                        <label
                                            for="phone"
                                            class="checkout-label"
                                        >
                                            Phone Number
                                            <span>*</span>
                                        </label>

                                        <div class="checkout-input-wrapper">

                                            <span class="checkout-input-icon">
                                                <i class="bi bi-telephone"></i>
                                            </span>

                                            <input
                                                type="tel"
                                                id="phone"
                                                name="phone"
                                                class="checkout-input"
                                                value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                                placeholder="+994 XX XXX XX XX"
                                                autocomplete="tel"
                                                required
                                            >

                                        </div>

                                        @error('phone')

                                            <small class="checkout-field-error">
                                                {{ $message }}
                                            </small>

                                        @enderror

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

                                            <span class="checkout-input-icon">
                                                <i class="bi bi-globe2"></i>
                                            </span>

                                            <input
                                                type="text"
                                                id="country"
                                                name="country"
                                                class="checkout-input"
                                                value="{{ old('country') }}"
                                                placeholder="Enter your country"
                                                autocomplete="country-name"
                                                required
                                            >

                                        </div>

                                        @error('country')

                                            <small class="checkout-field-error">
                                                {{ $message }}
                                            </small>

                                        @enderror

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

                                            <span class="checkout-input-icon">
                                                <i class="bi bi-buildings"></i>
                                            </span>

                                            <input
                                                type="text"
                                                id="city"
                                                name="city"
                                                class="checkout-input"
                                                value="{{ old('city') }}"
                                                placeholder="Enter your city"
                                                autocomplete="address-level2"
                                                required
                                            >

                                        </div>

                                        @error('city')

                                            <small class="checkout-field-error">
                                                {{ $message }}
                                            </small>

                                        @enderror

                                    </div>


                                    {{-- Postal Code --}}
                                    <div class="col-md-6">

                                        <label
                                            for="postal_code"
                                            class="checkout-label"
                                        >
                                            Postal Code
                                            <small>Optional</small>
                                        </label>

                                        <div class="checkout-input-wrapper">

                                            <span class="checkout-input-icon">
                                                <i class="bi bi-mailbox"></i>
                                            </span>

                                            <input
                                                type="text"
                                                id="postal_code"
                                                name="postal_code"
                                                class="checkout-input"
                                                value="{{ old('postal_code') }}"
                                                placeholder="Enter postal code"
                                                autocomplete="postal-code"
                                            >

                                        </div>

                                        @error('postal_code')

                                            <small class="checkout-field-error">
                                                {{ $message }}
                                            </small>

                                        @enderror

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

                                            <span class="checkout-input-icon">
                                                <i class="bi bi-geo-alt"></i>
                                            </span>

                                            <textarea
                                                id="address"
                                                name="address"
                                                class="checkout-input checkout-textarea"
                                                rows="4"
                                                placeholder="Street, building, apartment and other delivery details"
                                                autocomplete="street-address"
                                                required
                                            >{{ old('address') }}</textarea>

                                        </div>

                                        @error('address')

                                            <small class="checkout-field-error">
                                                {{ $message }}
                                            </small>

                                        @enderror

                                    </div>


                                    {{-- Note --}}
                                    <div class="col-12">

                                        <label
                                            for="note"
                                            class="checkout-label"
                                        >
                                            Order Note
                                            <small>Optional</small>
                                        </label>

                                        <div class="checkout-input-wrapper checkout-textarea-wrapper">

                                            <span class="checkout-input-icon">
                                                <i class="bi bi-chat-left-text"></i>
                                            </span>

                                            <textarea
                                                id="note"
                                                name="note"
                                                class="checkout-input checkout-textarea"
                                                rows="3"
                                                placeholder="Any special instructions for your order?"
                                            >{{ old('note') }}</textarea>

                                        </div>

                                        @error('note')

                                            <small class="checkout-field-error">
                                                {{ $message }}
                                            </small>

                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            SHIPPING METHOD
                        ================================================== --}}
                        @if($shippingEnabled && $shippingMethods->isNotEmpty())

                            <div class="checkout-card shipping-card">

                                <div class="checkout-card-header">

                                    <div class="checkout-card-heading">

                                        <div class="checkout-card-icon">
                                            <i class="bi bi-truck"></i>
                                        </div>

                                        <div>

                                            <span class="checkout-card-kicker">
                                                Delivery
                                            </span>

                                            <h2>
                                                Shipping Method
                                            </h2>

                                            <p>
                                                Choose how you'd like your
                                                order delivered.
                                            </p>

                                        </div>

                                    </div>

                                    <span class="required-badge">
                                        * Required
                                    </span>

                                </div>


                                <div class="checkout-card-body">

                                    <div class="shipping-methods">

                                        @foreach($shippingMethods as $shipping)

                                            @php

                                                $isSelected =
                                                    (int) $selectedShippingId ===
                                                    (int) $shipping->id;

                                                $isFreeByThreshold =
                                                    $freeShippingThreshold > 0 &&
                                                    $subtotal >= $freeShippingThreshold;

                                            @endphp


                                            <label
                                                class="shipping-option {{ $isSelected ? 'is-selected' : '' }}"
                                            >

                                                <input
                                                    type="radio"
                                                    name="shipping_id"
                                                    value="{{ $shipping->id }}"
                                                    data-price="{{ $shipping->price }}"
                                                    data-delivery="{{ $shipping->delivery_time }}"
                                                    {{ $isSelected ? 'checked' : '' }}
                                                    required
                                                >


                                                <span class="shipping-option-content">

                                                    <span class="shipping-option-icon">

                                                        @if($shipping->price <= 0)

                                                            <i class="bi bi-gift"></i>

                                                        @elseif(str_contains(
                                                            strtolower($shipping->name),
                                                            'express'
                                                        ))

                                                            <i class="bi bi-lightning-charge"></i>

                                                        @else

                                                            <i class="bi bi-truck"></i>

                                                        @endif

                                                    </span>


                                                    <span class="shipping-option-text">

                                                        <strong>
                                                            {{ $shipping->name }}
                                                        </strong>

                                                        @if($shipping->description)

                                                            <small>
                                                                {{ $shipping->description }}
                                                            </small>

                                                        @endif

                                                        @if($shipping->delivery_time)

                                                            <span class="shipping-delivery-time">

                                                                <i class="bi bi-clock"></i>

                                                                {{ $shipping->delivery_time }}

                                                            </span>

                                                        @endif

                                                    </span>


                                                    <span class="shipping-option-price">

                                                        @if($isFreeByThreshold)

                                                            <strong class="shipping-free-price">
                                                                FREE
                                                            </strong>

                                                            @if($shipping->price > 0)

                                                                <small>
                                                                    Free shipping applied
                                                                </small>

                                                            @endif

                                                        @elseif($shipping->price <= 0)

                                                            <strong class="shipping-free-price">
                                                                FREE
                                                            </strong>

                                                        @else

                                                            <strong>
                                                                ${{ number_format(
                                                                    $shipping->price,
                                                                    2
                                                                ) }}
                                                            </strong>

                                                        @endif

                                                    </span>


                                                    <span class="shipping-radio">
                                                        <span></span>
                                                    </span>

                                                </span>

                                            </label>

                                        @endforeach

                                    </div>


                                    @error('shipping_id')

                                        <small class="checkout-field-error">
                                            {{ $message }}
                                        </small>

                                    @enderror

                                </div>

                            </div>

                        @elseif($shippingEnabled)

                            <div class="checkout-alert checkout-alert-error">

                                <span class="checkout-alert-icon">
                                    <i class="bi bi-truck"></i>
                                </span>

                                <span>
                                    No shipping methods are currently available.
                                </span>

                            </div>

                        @endif


                        {{-- =================================================
                            PAYMENT METHOD
                        ================================================== --}}
                        @if($paymentsEnabled)

                            <div class="checkout-card payment-card">

                                <div class="checkout-card-header">

                                    <div class="checkout-card-heading">

                                        <div class="checkout-card-icon">
                                            <i class="bi bi-credit-card-2-front"></i>
                                        </div>

                                        <div>

                                            <span class="checkout-card-kicker">
                                                Payment
                                            </span>

                                            <h2>
                                                Payment Method
                                            </h2>

                                            <p>
                                                Choose your preferred way to pay.
                                            </p>

                                        </div>

                                    </div>

                                    <span class="secure-payment-badge">
                                        <i class="bi bi-shield-lock"></i>
                                        Secure
                                    </span>

                                </div>


                                <div class="checkout-card-body">

                                    <div class="payment-methods">


                                        {{-- Cash on Delivery --}}
                                        @if(in_array('cash_on_delivery', $paymentMethods))

                                            <label class="payment-option">

                                                <input
                                                    type="radio"
                                                    name="payment_method"
                                                    value="cash_on_delivery"
                                                    {{ old('payment_method', $defaultPaymentMethod) === 'cash_on_delivery' ? 'checked' : '' }}
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

                                                    <span class="payment-radio">
                                                        <span></span>
                                                    </span>

                                                </span>

                                            </label>

                                        @endif


                                        {{-- Credit Card --}}
                                        @if(in_array('credit_card', $paymentMethods))

                                            <label class="payment-option">

                                                <input
                                                    type="radio"
                                                    name="payment_method"
                                                    value="credit_card"
                                                    {{ old('payment_method', $defaultPaymentMethod) === 'credit_card' ? 'checked' : '' }}
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

                                                    <span class="payment-radio">
                                                        <span></span>
                                                    </span>

                                                </span>

                                            </label>

                                        @endif


                                        {{-- Debit Card --}}
                                        @if(in_array('debit_card', $paymentMethods))

                                            <label class="payment-option">

                                                <input
                                                    type="radio"
                                                    name="payment_method"
                                                    value="debit_card"
                                                    {{ old('payment_method', $defaultPaymentMethod) === 'debit_card' ? 'checked' : '' }}
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

                                                    <span class="payment-radio">
                                                        <span></span>
                                                    </span>

                                                </span>

                                            </label>

                                        @endif


                                        {{-- PayPal --}}
                                        @if(in_array('paypal', $paymentMethods))

                                            <label class="payment-option">

                                                <input
                                                    type="radio"
                                                    name="payment_method"
                                                    value="paypal"
                                                    {{ old('payment_method', $defaultPaymentMethod) === 'paypal' ? 'checked' : '' }}
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

                                                    <span class="payment-radio">
                                                        <span></span>
                                                    </span>

                                                </span>

                                            </label>

                                        @endif


                                    </div>

                                </div>

                            </div>

                        @else

                            <div class="checkout-alert checkout-alert-error">

                                <span class="checkout-alert-icon">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>

                                <span>
                                    Payments are currently disabled.
                                </span>

                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                        RIGHT COLUMN
                    ================================================== --}}
                    <div class="col-lg-5">

                        <div class="checkout-summary">


                            {{-- Summary Header --}}
                            <div class="checkout-summary-header">

                                <div>

                                    <span class="summary-eyebrow">
                                        <i class="bi bi-bag"></i>
                                        Your Cart
                                    </span>

                                    <h2>
                                        Order Summary
                                    </h2>

                                </div>

                                <span class="summary-count">

                                    {{ $totalItems }}

                                    {{ $totalItems === 1 ? 'item' : 'items' }}

                                </span>

                            </div>


                            {{-- Items --}}
                            <div class="checkout-items">

                                @foreach($cart as $item)

                                    @php

                                        $checkoutCover = null;

                                        if (!empty($item['cover'])) {

                                            $checkoutCover = filter_var(
                                                $item['cover'],
                                                FILTER_VALIDATE_URL
                                            )
                                                ? $item['cover']
                                                : asset(
                                                    'storage/' .
                                                    $item['cover']
                                                );

                                        }

                                    @endphp


                                    <div class="checkout-item">

                                        <div class="checkout-item-image">

                                            @if($checkoutCover)

                                                <img
                                                    src="{{ $checkoutCover }}"
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
                                                    Qty {{ $item['quantity'] }}
                                                </span>

                                                <span class="meta-dot"></span>

                                                <span>
                                                    ${{ number_format($item['price'], 2) }}
                                                </span>

                                            </div>

                                        </div>


                                        <strong class="checkout-item-total">

                                            ${{ number_format(
                                                $item['price'] *
                                                $item['quantity'],
                                                2
                                            ) }}

                                        </strong>

                                    </div>

                                @endforeach

                            </div>


                            {{-- =================================================
                                TOTALS
                            ================================================== --}}
                            <div class="checkout-summary-totals">


                                {{-- Subtotal --}}
                                <div class="summary-row">

                                    <span>
                                        Subtotal
                                    </span>

                                    <strong>
                                        ${{ number_format($subtotal, 2) }}
                                    </strong>

                                </div>


                                {{-- Shipping --}}
                                @if($shippingEnabled)

                                    <div class="summary-row">

                                        <span>
                                            Shipping
                                        </span>

                                        <strong
                                            id="checkout-shipping-fee"
                                            class="{{ $shippingFee <= 0 ? 'summary-free' : '' }}"
                                        >

                                            @if($shippingFee <= 0)

                                                FREE

                                            @else

                                                ${{ number_format(
                                                    $shippingFee,
                                                    2
                                                ) }}

                                            @endif

                                        </strong>

                                    </div>

                                @else

                                    <div class="summary-row">

                                        <span>
                                            Shipping
                                        </span>

                                        <strong class="summary-free">
                                            Disabled
                                        </strong>

                                    </div>

                                @endif


                                {{-- Free Shipping Notice --}}
                                @if(
                                    $shippingEnabled &&
                                    $freeShippingThreshold > 0 &&
                                    $subtotal < $freeShippingThreshold
                                )

                                    <div class="shipping-threshold-note">

                                        <i class="bi bi-truck"></i>

                                        <span>
                                            Free shipping on orders over
                                            ${{ number_format(
                                                $freeShippingThreshold,
                                                2
                                            ) }}.
                                        </span>

                                    </div>

                                @elseif(
                                    $shippingEnabled &&
                                    $freeShippingThreshold > 0 &&
                                    $subtotal >= $freeShippingThreshold
                                )

                                    <div class="shipping-threshold-note">

                                        <i class="bi bi-check-circle"></i>

                                        <span>
                                            You qualify for free shipping.
                                        </span>

                                    </div>

                                @endif


                                <div class="summary-divider"></div>


                                {{-- Total --}}
                                <div class="summary-row summary-total">

                                    <span>
                                        Total
                                    </span>

                                    <strong id="checkout-grand-total">
                                        ${{ number_format(
                                            $grandTotal,
                                            2
                                        ) }}
                                    </strong>

                                </div>

                            </div>


                            {{-- Estimated Delivery --}}
                            @if(
                                $shippingEnabled &&
                                !empty($checkoutDeliveryEstimate)
                            )

                                <div class="delivery-estimate">

                                    <div class="delivery-estimate-icon">
                                        <i class="bi bi-truck"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            Estimated Delivery
                                        </strong>

                                        <span id="checkout-delivery-estimate">
                                            {{ $checkoutDeliveryEstimate }}
                                        </span>

                                    </div>

                                </div>

                            @endif


                            {{-- Place Order --}}
                            <button
                                type="submit"
                                class="place-order-btn"
                                @disabled(!$paymentsEnabled)
                            >

                                <span class="place-order-main">

                                    <i class="bi bi-lock-fill"></i>

                                    Place Order

                                </span>

                                <span
                                    class="place-order-price"
                                    id="checkout-place-order-price"
                                >

                                    ${{ number_format(
                                        $grandTotal,
                                        2
                                    ) }}

                                </span>

                            </button>


                            {{-- Back to Cart --}}
                            <a
                                href="{{ route('frontend.cart') }}"
                                class="back-cart-btn"
                            >

                                <i class="bi bi-arrow-left"></i>

                                <span>
                                    Back to Cart
                                </span>

                            </a>


                            {{-- Security --}}
                            <div class="checkout-security">

                                <div class="security-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>

                                <div>

                                    <strong>
                                        Secure & Protected
                                    </strong>

                                    <span>
                                        Your personal information is encrypted
                                        and securely processed.
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            TRUST FEATURES
                        ================================================== --}}
                        <div class="checkout-trust">

                            <div class="trust-item">

                                <i class="bi bi-truck"></i>

                                <div>

                                    <strong id="checkout-trust-shipping-title">

                                        @if($shippingEnabled)

                                            {{ $shippingFee <= 0
                                                ? 'Free Shipping'
                                                : 'Shipping Available'
                                            }}

                                        @else

                                            Shipping

                                        @endif

                                    </strong>

                                    <span id="checkout-trust-shipping-text">

                                        @if(!$shippingEnabled)

                                            Currently unavailable

                                        @elseif($shippingFee <= 0)

                                            Available on this order

                                        @else

                                            Delivery available

                                        @endif

                                    </span>

                                </div>

                            </div>


                            <div class="trust-item">

                                <i class="bi bi-arrow-repeat"></i>

                                <div>

                                    <strong>
                                        Easy Returns
                                    </strong>

                                    <span>
                                        Simple return process
                                    </span>

                                </div>

                            </div>


                            <div class="trust-item">

                                <i class="bi bi-headset"></i>

                                <div>

                                    <strong>
                                        Support
                                    </strong>

                                    <span>
                                        We're here to help
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </section>

</main>

@endsection


{{-- =====================================================
    SHIPPING METHOD JAVASCRIPT
====================================================== --}}

@push('js')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const shippingOptions = document.querySelectorAll(
        'input[name="shipping_id"]'
    );

    const shippingFeeElement = document.getElementById(
        'checkout-shipping-fee'
    );

    const grandTotalElement = document.getElementById(
        'checkout-grand-total'
    );

    const placeOrderPriceElement = document.getElementById(
        'checkout-place-order-price'
    );

    const deliveryEstimateElement = document.getElementById(
        'checkout-delivery-estimate'
    );

    const trustShippingTitle = document.getElementById(
        'checkout-trust-shipping-title'
    );

    const trustShippingText = document.getElementById(
        'checkout-trust-shipping-text'
    );

    const subtotal = {{ (float) $subtotal }};

    const freeShippingThreshold =
        {{ (float) $freeShippingThreshold }};


    function formatPrice(value) {

        return '$' + Number(value).toFixed(2);

    }


    function updateShipping() {

        const selected = document.querySelector(
            'input[name="shipping_id"]:checked'
        );

        if (!selected) {
            return;
        }

        const shippingPrice =
            parseFloat(selected.dataset.price) || 0;

        const delivery =
            selected.dataset.delivery || '';

        let shippingFee = shippingPrice;


        /*
        |--------------------------------------------------------------------------
        | Free Shipping Threshold
        |--------------------------------------------------------------------------
        */

        if (
            freeShippingThreshold > 0 &&
            subtotal >= freeShippingThreshold
        ) {
            shippingFee = 0;
        }


        const grandTotal =
            subtotal + shippingFee;


        /*
        |--------------------------------------------------------------------------
        | Shipping Summary
        |--------------------------------------------------------------------------
        */

        if (shippingFee <= 0) {

            shippingFeeElement.textContent = 'FREE';

            shippingFeeElement.classList.add(
                'summary-free'
            );

        } else {

            shippingFeeElement.textContent =
                formatPrice(shippingFee);

            shippingFeeElement.classList.remove(
                'summary-free'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Grand Total
        |--------------------------------------------------------------------------
        */

        if (grandTotalElement) {

            grandTotalElement.textContent =
                formatPrice(grandTotal);

        }


        /*
        |--------------------------------------------------------------------------
        | Place Order Price
        |--------------------------------------------------------------------------
        */

        if (placeOrderPriceElement) {

            placeOrderPriceElement.textContent =
                formatPrice(grandTotal);

        }


        /*
        |--------------------------------------------------------------------------
        | Delivery Estimate
        |--------------------------------------------------------------------------
        */

        if (deliveryEstimateElement) {

            deliveryEstimateElement.textContent =
                delivery;

        }


        /*
        |--------------------------------------------------------------------------
        | Trust Section
        |--------------------------------------------------------------------------
        */

        if (trustShippingTitle) {

            trustShippingTitle.textContent =
                shippingFee <= 0
                    ? 'Free Shipping'
                    : 'Shipping Available';

        }

        if (trustShippingText) {

            trustShippingText.textContent =
                shippingFee <= 0
                    ? 'Available on this order'
                    : 'Delivery available';

        }


        /*
        |--------------------------------------------------------------------------
        | Selected Shipping Card
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.shipping-option')
            .forEach(function (option) {

                option.classList.remove(
                    'is-selected'
                );

            });

        const selectedOption =
            selected.closest('.shipping-option');

        if (selectedOption) {

            selectedOption.classList.add(
                'is-selected'
            );

        }

    }


    shippingOptions.forEach(function (option) {

        option.addEventListener(
            'change',
            updateShipping
        );

    });


    updateShipping();

});
</script>

@endpush

