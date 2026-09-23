@extends('Layout.Frontend.master')

@section('title', 'Order Details | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/order-details.css') }}">
@endpush

@section('content')

@php
    $paymentMethod = $order->payment_method
        ? ucwords(str_replace('_', ' ', $order->payment_method))
        : 'Not selected';

    $paymentStatus = $order->payment_status ?? 'pending';

    $orderStatus = $order->order_status ?? 'pending';

    $coverUrl = null;

    if ($order->book && !empty($order->book->cover)) {
        $coverUrl = filter_var($order->book->cover, FILTER_VALIDATE_URL)
            ? $order->book->cover
            : asset('storage/' . ltrim($order->book->cover, '/'));
    }
@endphp


<main class="sb-order-details-page">

    {{-- =========================================================
        HERO
    ========================================================== --}}
    <section class="order-details-hero">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="order-details-breadcrumb">

                <a href="{{ route('frontend.home') }}">
                    <i class="bi bi-house"></i>
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <a href="{{ route('frontend.orders') }}">
                    My Orders
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>
                    Order Details
                </span>

            </div>


            {{-- Hero Content --}}
            <div class="order-details-heading">

                <div class="order-details-heading-content">

                    <span class="order-details-eyebrow">
                        <i class="bi bi-receipt"></i>
                        ORDER INFORMATION
                    </span>

                    <h1>
                        Order Details
                    </h1>

                    <p>
                        Review your order, shipping information and payment status.
                    </p>

                </div>


                <a
                    href="{{ route('frontend.orders') }}"
                    class="order-back-btn"
                >
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Orders</span>
                </a>

            </div>

        </div>

    </section>


    {{-- =========================================================
        CONTENT
    ========================================================== --}}
    <section class="order-details-section">

        <div class="container">

            {{-- =================================================
                ALERTS
            ================================================== --}}

            @if(session('success'))

                <div class="order-alert order-alert-success">

                    <div class="order-alert-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <div>
                        <strong>Success</strong>

                        <span>
                            {{ session('success') }}
                        </span>
                    </div>

                </div>

            @endif


            @if(session('error'))

                <div class="order-alert order-alert-error">

                    <div class="order-alert-icon">
                        <i class="bi bi-exclamation-lg"></i>
                    </div>

                    <div>
                        <strong>Something went wrong</strong>

                        <span>
                            {{ session('error') }}
                        </span>
                    </div>

                </div>

            @endif


            {{-- =================================================
                ORDER OVERVIEW
            ================================================== --}}
            <div class="order-main-card">

                <div class="order-main-header">

                    <div class="order-number-area">

                        <span class="order-label">
                            ORDER NUMBER
                        </span>

                        <div class="order-number-row">

                            <h2>
                                #{{ $order->order_number }}
                            </h2>

                            <span class="order-copy-badge">
                                <i class="bi bi-hash"></i>
                                Order
                            </span>

                        </div>

                    </div>


                    <div class="order-status-area">

                        <span class="order-label">
                            ORDER STATUS
                        </span>

                        <span class="order-status status-{{ $orderStatus }}">

                            <span class="status-dot"></span>

                            {{ ucfirst(str_replace('_', ' ', $orderStatus)) }}

                        </span>

                    </div>

                </div>


                <div class="order-meta-grid">

                    {{-- Order Date --}}
                    <div class="order-meta-item">

                        <span class="order-label">
                            <i class="bi bi-calendar3"></i>
                            ORDER DATE
                        </span>

                        <strong>
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </strong>

                    </div>


                    {{-- Payment Method --}}
                    <div class="order-meta-item">

                        <span class="order-label">
                            <i class="bi bi-wallet2"></i>
                            PAYMENT METHOD
                        </span>

                        <strong>
                            {{ $paymentMethod }}
                        </strong>

                    </div>


                    {{-- Payment Status --}}
                    <div class="order-meta-item">

                        <span class="order-label">
                            <i class="bi bi-shield-check"></i>
                            PAYMENT STATUS
                        </span>

                        <span class="payment-status payment-{{ $paymentStatus }}">

                            <span class="status-dot"></span>

                            {{ ucfirst(str_replace('_', ' ', $paymentStatus)) }}

                        </span>

                    </div>


                    {{-- Total --}}
                    <div class="order-meta-item">

                        <span class="order-label">
                            <i class="bi bi-cash-stack"></i>
                            TOTAL
                        </span>

                        <strong class="order-total">
                            ₼{{ number_format($order->total_price, 2) }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                MAIN GRID
            ================================================== --}}
            <div class="order-details-grid">

                {{-- =================================================
                    PRODUCT
                ================================================== --}}
                <div class="order-product-card">

                    <div class="section-card-header">

                        <div class="section-card-heading">

                            <div class="section-card-icon">
                                <i class="bi bi-book-half"></i>
                            </div>

                            <div>
                                <h3>
                                    Ordered Book
                                </h3>

                                <p>
                                    Product information
                                </p>
                            </div>

                        </div>

                        <span class="section-card-number">
                            01
                        </span>

                    </div>


                    <div class="order-product">

                        {{-- Book Cover --}}
                        <div class="order-product-image">

                            @if($coverUrl)

                                <img
                                    src="{{ $coverUrl }}"
                                    alt="{{ $order->book->title }}"
                                >

                            @else

                                <div class="order-product-placeholder">

                                    <i class="bi bi-book"></i>

                                </div>

                            @endif

                        </div>


                        {{-- Book Info --}}
                        <div class="order-product-info">

                            @if($order->book)

                                <span class="product-eyebrow">
                                    BOOK
                                </span>

                                <h4>
                                    {{ $order->book->title }}
                                </h4>


                                @if($order->book->author)

                                    <p class="order-product-author">

                                        <span class="author-icon">
                                            <i class="bi bi-person"></i>
                                        </span>

                                        <span>
                                            {{ $order->book->author->name }}
                                        </span>

                                    </p>

                                @endif

                            @else

                                <span class="product-eyebrow">
                                    PRODUCT
                                </span>

                                <h4>
                                    Book no longer available
                                </h4>

                            @endif


                            <div class="product-info-list">

                                <div class="product-info-row">

                                    <span>
                                        Unit Price
                                    </span>

                                    <strong>
                                        ₼{{ number_format($order->book_price, 2) }}
                                    </strong>

                                </div>


                                <div class="product-info-row">

                                    <span>
                                        Quantity
                                    </span>

                                    <strong>
                                        ×{{ $order->quantity }}
                                    </strong>

                                </div>


                                <div class="product-info-row product-total-row">

                                    <span>
                                        Product Total
                                    </span>

                                    <strong>
                                        ₼{{ number_format($order->total_price, 2) }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    SHIPPING INFORMATION
                ================================================== --}}
                <div class="order-shipping-card">

                    <div class="section-card-header">

                        <div class="section-card-heading">

                            <div class="section-card-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>

                            <div>
                                <h3>
                                    Shipping Information
                                </h3>

                                <p>
                                    Delivery details
                                </p>
                            </div>

                        </div>

                        <span class="section-card-number">
                            02
                        </span>

                    </div>


                    <div class="shipping-info">

                        <div class="shipping-row">

                            <span>
                                <i class="bi bi-person"></i>
                                Full Name
                            </span>

                            <strong>
                                {{ $order->full_name }}
                            </strong>

                        </div>


                        <div class="shipping-row">

                            <span>
                                <i class="bi bi-telephone"></i>
                                Phone
                            </span>

                            <strong>
                                {{ $order->phone }}
                            </strong>

                        </div>


                        <div class="shipping-row">

                            <span>
                                <i class="bi bi-globe2"></i>
                                Country
                            </span>

                            <strong>
                                {{ $order->country }}
                            </strong>

                        </div>


                        <div class="shipping-row">

                            <span>
                                <i class="bi bi-building"></i>
                                City
                            </span>

                            <strong>
                                {{ $order->city }}
                            </strong>

                        </div>


                        @if($order->postal_code)

                            <div class="shipping-row">

                                <span>
                                    <i class="bi bi-mailbox"></i>
                                    Postal Code
                                </span>

                                <strong>
                                    {{ $order->postal_code }}
                                </strong>

                            </div>

                        @endif


                        <div class="shipping-row shipping-address">

                            <span>
                                <i class="bi bi-house"></i>
                                Address
                            </span>

                            <strong>
                                {{ $order->address }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                BOTTOM GRID
            ================================================== --}}
            <div class="order-bottom-grid">

                {{-- =================================================
                    ORDER SUMMARY
                ================================================== --}}
                <div class="order-summary-card">

                    <div class="section-card-header">

                        <div class="section-card-heading">

                            <div class="section-card-icon">
                                <i class="bi bi-receipt"></i>
                            </div>

                            <div>
                                <h3>
                                    Order Summary
                                </h3>

                                <p>
                                    Payment breakdown
                                </p>
                            </div>

                        </div>

                        <span class="section-card-number">
                            03
                        </span>

                    </div>


                    <div class="summary-list">

                        <div class="summary-row">

                            <span>
                                Book Price
                            </span>

                            <strong>
                                ₼{{ number_format($order->book_price, 2) }}
                            </strong>

                        </div>


                        <div class="summary-row">

                            <span>
                                Quantity
                            </span>

                            <strong>
                                ×{{ $order->quantity }}
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

                            <div>
                                <span>
                                    Total Amount
                                </span>

                                <small>
                                    Including shipping
                                </small>
                            </div>

                            <strong>
                                ₼{{ number_format($order->total_price, 2) }}
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    CUSTOMER ORDER NOTE
                ================================================== --}}
                <div class="order-note-card">

                    <div class="section-card-header">

                        <div class="section-card-heading">

                            <div class="section-card-icon">
                                <i class="bi bi-chat-left-text"></i>
                            </div>

                            <div>
                                <h3>
                                    Customer Order Note
                                </h3>

                                <p>
                                    Additional information
                                </p>
                            </div>

                        </div>

                        <span class="section-card-number">
                            04
                        </span>

                    </div>


                    @if($order->note)

                        <div class="order-note-content">

                            <div class="order-note-quote">
                                <i class="bi bi-quote"></i>
                            </div>

                            <p>
                                {{ $order->note }}
                            </p>

                        </div>

                    @else

                        <div class="order-note-empty">

                            <div class="order-note-empty-icon">
                                <i class="bi bi-chat-square-text"></i>
                            </div>

                            <div>
                                <strong>
                                    No additional note
                                </strong>

                                <span>
                                    No additional note was provided for this order.
                                </span>
                            </div>

                        </div>

                    @endif

                </div>


                {{-- =================================================
                    STORE ORDER NOTE
                ================================================== --}}
                @if($order->order_note)

                    <div class="order-note-card">

                        <div class="section-card-header">

                            <div class="section-card-heading">

                                <div class="section-card-icon">
                                    <i class="bi bi-shop"></i>
                                </div>

                                <div>
                                    <h3>
                                        Store Order Note
                                    </h3>

                                    <p>
                                        Information provided by the seller
                                    </p>
                                </div>

                            </div>

                            <span class="section-card-number">
                                05
                            </span>

                        </div>


                        <div class="order-note-content">

                            <div class="order-note-quote">
                                <i class="bi bi-info-circle"></i>
                            </div>

                            <p>
                                {{ $order->order_note }}
                            </p>

                        </div>

                    </div>

                @endif

            </div>


            {{-- =================================================
                PAYMENT REMINDER
            ================================================== --}}
            @if($paymentStatus !== 'paid')

                <div class="order-payment-banner">

                    <div class="order-payment-banner-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>

                    <div class="order-payment-banner-content">

                        <strong>
                            Payment is still pending
                        </strong>

                        <span>
                            Complete your payment to confirm this order.
                        </span>

                    </div>

                </div>

            @else

                <div class="order-payment-complete">

                    <div class="order-payment-complete-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <div>
                        <strong>
                            Payment completed
                        </strong>

                        <span>
                            Your payment for this order has been successfully completed.
                        </span>
                    </div>

                </div>

            @endif


            {{-- =================================================
                ACTIONS
            ================================================== --}}
            <div class="order-details-actions">

                {{-- Back to Orders --}}
                <a
                    href="{{ route('frontend.orders') }}"
                    class="order-action secondary"
                >
                    <i class="bi bi-arrow-left"></i>

                    <span>
                        Back to My Orders
                    </span>
                </a>


                {{-- Pay Now --}}
                @if($paymentStatus !== 'paid')

                    <a
                        href="{{ url('/frontend/payment/' . $order->id) }}"
                        class="order-action payment"
                    >
                        <i class="bi bi-credit-card"></i>

                        <span>
                            Pay Now
                        </span>
                    </a>

                @endif


                {{-- Write a Review --}}
                @if($orderStatus === 'delivered' && !$reviewed)

                    <a
                        href="{{ route('frontend.reviews.create', $order->id) }}"
                        class="order-action review"
                    >
                        <i class="bi bi-star"></i>

                        <span>
                            Write a Review
                        </span>
                    </a>

                @endif


                {{-- Track Order --}}
                <a
                    href="{{ route('frontend.order-tracking', $order->id) }}"
                    class="order-action primary"
                >
                    <i class="bi bi-truck"></i>

                    <span>
                        Track Order
                    </span>
                </a>

            </div>

        </div>

    </section>

</main>

@endsection

