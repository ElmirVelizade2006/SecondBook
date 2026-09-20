@extends('Layout.Frontend.master')

@section('title', 'Order Details | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/order-details.css') }}">
@endpush

@section('content')

<main class="sb-order-details-page">

    {{-- =========================================================
        HERO
    ========================================================== --}}
    <section class="order-details-hero">

        <div class="container">

            <div class="order-details-breadcrumb">

                <a href="{{ route('frontend.home') }}">
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

            <div class="order-details-heading">

                <div>
                    <span class="order-details-eyebrow">
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

            {{-- Success Message --}}
            @if(session('success'))

                <div class="order-alert order-alert-success">
                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>
                </div>

            @endif


            {{-- Error Message --}}
            @if(session('error'))

                <div class="order-alert order-alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>

                    <span>
                        {{ session('error') }}
                    </span>
                </div>

            @endif


            {{-- =================================================
                ORDER HEADER
            ================================================== --}}
            <div class="order-main-card">

                <div class="order-main-header">

                    <div class="order-number-area">

                        <span class="order-label">
                            ORDER NUMBER
                        </span>

                        <h2>
                            #{{ $order->order_number }}
                        </h2>

                    </div>

                    <div class="order-status-area">

                        <span class="order-label">
                            ORDER STATUS
                        </span>

                        <span class="order-status status-{{ $order->order_status }}">
                            {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                        </span>

                    </div>

                </div>


                <div class="order-meta-grid">

                    <div class="order-meta-item">

                        <span class="order-label">
                            ORDER DATE
                        </span>

                        <strong>
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </strong>

                    </div>


                    <div class="order-meta-item">

                        <span class="order-label">
                            PAYMENT METHOD
                        </span>

                        <strong>
                            {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}
                        </strong>

                    </div>


                    <div class="order-meta-item">

                        <span class="order-label">
                            PAYMENT STATUS
                        </span>

                        <span class="payment-status payment-{{ $order->payment_status }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>

                    </div>


                    <div class="order-meta-item">

                        <span class="order-label">
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

                        <div class="section-card-icon">
                            <i class="bi bi-book"></i>
                        </div>

                        <div>
                            <h3>Ordered Book</h3>
                            <p>Product information</p>
                        </div>

                    </div>


                    <div class="order-product">

                        <div class="order-product-image">

                            @if($order->book && $order->book->cover)

                                <img
                                    src="{{ asset('storage/' . $order->book->cover) }}"
                                    alt="{{ $order->book->title }}"
                                >

                            @else

                                <div class="order-product-placeholder">
                                    <i class="bi bi-book"></i>
                                </div>

                            @endif

                        </div>


                        <div class="order-product-info">

                            @if($order->book)

                                <h4>
                                    {{ $order->book->title }}
                                </h4>

                                @if($order->book->author)

                                    <p class="order-product-author">
                                        <i class="bi bi-person"></i>
                                        {{ $order->book->author->name }}
                                    </p>

                                @endif

                            @else

                                <h4>
                                    Book no longer available
                                </h4>

                            @endif

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
                                    {{ $order->quantity }}
                                </strong>

                            </div>


                            <div class="product-info-row product-total-row">

                                <span>
                                    Total
                                </span>

                                <strong>
                                    ₼{{ number_format($order->total_price, 2) }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    SHIPPING INFORMATION
                ================================================== --}}
                <div class="order-shipping-card">

                    <div class="section-card-header">

                        <div class="section-card-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>
                            <h3>Shipping Information</h3>
                            <p>Delivery details</p>
                        </div>

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
                                <i class="bi bi-globe"></i>
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
                ORDER SUMMARY + NOTE
            ================================================== --}}
            <div class="order-bottom-grid">

                {{-- Order Summary --}}
                <div class="order-summary-card">

                    <div class="section-card-header">

                        <div class="section-card-icon">
                            <i class="bi bi-receipt"></i>
                        </div>

                        <div>
                            <h3>Order Summary</h3>
                            <p>Payment breakdown</p>
                        </div>

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


                        <div class="summary-divider"></div>


                        <div class="summary-row summary-total">

                            <span>
                                Total
                            </span>

                            <strong>
                                ₼{{ number_format($order->total_price, 2) }}
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- Customer Note --}}
                <div class="order-note-card">

                    <div class="section-card-header">

                        <div class="section-card-icon">
                            <i class="bi bi-chat-left-text"></i>
                        </div>

                        <div>
                            <h3>Order Note</h3>
                            <p>Additional information</p>
                        </div>

                    </div>


                    @if($order->note)

                        <div class="order-note-content">
                            <i class="bi bi-quote"></i>

                            <p>
                                {{ $order->note }}
                            </p>
                        </div>

                    @else

                        <div class="order-note-empty">

                            <i class="bi bi-chat-square-text"></i>

                            <span>
                                No additional note was provided for this order.
                            </span>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                ACTIONS
            ================================================== --}}
            <div class="order-details-actions">

                <a
                    href="{{ route('frontend.orders') }}"
                    class="order-action secondary"
                >
                    <i class="bi bi-arrow-left"></i>
                    Back to My Orders
                </a>

                <a
                    href="{{ route('frontend.order-tracking', $order->id) }}"
                    class="order-action primary"
                >
                    <i class="bi bi-truck"></i>
                    Track Order
                </a>

            </div>

        </div>

    </section>

</main>

@endsection