@extends('Layout.Frontend.master')

@section('title', 'Track Order | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/order-tracking.css') }}">
@endpush

@section('content')

<main class="sb-order-tracking-page">

    {{-- HERO --}}
    <section class="tracking-hero">
        <div class="container">

            <div class="tracking-breadcrumb">
                <a href="{{ route('frontend.home') }}">
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <a href="{{ route('frontend.orders') }}">
                    My Orders
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>Track Order</span>
            </div>

            <div class="tracking-hero-content">
                <span class="tracking-eyebrow">
                    <i class="bi bi-truck"></i>
                    Order Tracking
                </span>

                <h1>Track Your Order</h1>

                <p>
                    Follow the progress of your order from placement
                    to delivery.
                </p>
            </div>

        </div>
    </section>


    {{-- CONTENT --}}
    <section class="tracking-section">
        <div class="container">

            {{-- ORDER HEADER --}}
            <div class="tracking-order-card">

                <div class="tracking-order-info">

                    <div>
                        <span class="tracking-label">
                            Order Number
                        </span>

                        <strong>
                            #{{ $order->order_number }}
                        </strong>
                    </div>

                    <div>
                        <span class="tracking-label">
                            Order Date
                        </span>

                        <strong>
                            {{ $order->created_at->format('M d, Y') }}
                        </strong>
                    </div>

                    <div>
                        <span class="tracking-label">
                            Total
                        </span>

                        <strong>
                            ${{ number_format($order->total_price, 2) }}
                        </strong>
                    </div>

                </div>

            </div>


            {{-- TRACKING --}}
            <div class="tracking-card">

                <div class="tracking-card-header">
                    <div>
                        <span class="tracking-small-title">
                            ORDER STATUS
                        </span>

                        <h2>
                            {{ ucfirst($order->order_status) }}
                        </h2>
                    </div>

                    <span class="tracking-status-badge status-{{ $order->order_status }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>


                <div class="tracking-timeline">

                    @php
                        $statusOrder = [
                            'pending',
                            'processing',
                            'shipped',
                            'delivered'
                        ];

                        $currentIndex = array_search(
                            $order->order_status,
                            $statusOrder
                        );
                    @endphp


                    @foreach($statusOrder as $index => $status)

                        @php
                            $step = $statuses[$status];

                            $isCompleted = $currentIndex !== false
                                && $index < $currentIndex;

                            $isCurrent = $currentIndex === $index;
                        @endphp

                        <div class="tracking-step
                            {{ $isCompleted ? 'completed' : '' }}
                            {{ $isCurrent ? 'current' : '' }}
                        ">

                            <div class="tracking-step-icon">
                                <i class="bi {{ $step['icon'] }}"></i>
                            </div>

                            <div class="tracking-step-content">

                                <h3>
                                    {{ $step['label'] }}
                                </h3>

                                <p>
                                    {{ $step['description'] }}
                                </p>

                                @if($isCurrent)
                                    <span class="tracking-current">
                                        Current Status
                                    </span>
                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- CANCELLED --}}
            @if($order->order_status === 'cancelled')

                <div class="tracking-cancelled">

                    <div class="tracking-cancelled-icon">
                        <i class="bi bi-x-circle"></i>
                    </div>

                    <div>
                        <h3>Order Cancelled</h3>

                        <p>
                            This order has been cancelled and will not
                            continue through the delivery process.
                        </p>
                    </div>

                </div>

            @endif


            {{-- ORDER ITEM --}}
            <div class="tracking-product-card">

                <div class="tracking-product-image">

                    @if($order->book->cover)
                        <img
                            src="{{ asset('storage/' . $order->book->cover) }}"
                            alt="{{ $order->book->title }}"
                        >
                    @else
                        <div class="tracking-no-cover">
                            <i class="bi bi-book"></i>
                        </div>
                    @endif

                </div>

                <div class="tracking-product-content">

                    <span class="tracking-product-label">
                        ORDER ITEM
                    </span>

                    <h3>
                        {{ $order->book->title }}
                    </h3>

                    <div class="tracking-product-meta">

                        <span>
                            <i class="bi bi-box"></i>
                            Quantity: {{ $order->quantity }}
                        </span>

                        <span>
                            <i class="bi bi-tag"></i>
                            ${{ number_format($order->book_price, 2) }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- SHIPPING --}}
            <div class="tracking-shipping-card">

                <div class="tracking-section-heading">
                    <div class="tracking-heading-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <div>
                        <span>DELIVERY</span>
                        <h2>Shipping Information</h2>
                    </div>
                </div>


                <div class="tracking-shipping-grid">

                    <div>
                        <span>Full Name</span>
                        <strong>{{ $order->full_name }}</strong>
                    </div>

                    <div>
                        <span>Phone</span>
                        <strong>{{ $order->phone }}</strong>
                    </div>

                    <div>
                        <span>Country</span>
                        <strong>{{ $order->country }}</strong>
                    </div>

                    <div>
                        <span>City</span>
                        <strong>{{ $order->city }}</strong>
                    </div>

                    <div class="full-width">
                        <span>Address</span>
                        <strong>{{ $order->address }}</strong>
                    </div>

                </div>

            </div>


            {{-- ACTIONS --}}
            <div class="tracking-actions">

                <a
                    href="{{ route('frontend.orders.show', $order->id) }}"
                    class="tracking-action secondary"
                >
                    <i class="bi bi-arrow-left"></i>
                    Order Details
                </a>

                <a
                    href="{{ route('frontend.orders') }}"
                    class="tracking-action primary"
                >
                    <i class="bi bi-receipt"></i>
                    My Orders
                </a>

            </div>

        </div>
    </section>

</main>

@endsection