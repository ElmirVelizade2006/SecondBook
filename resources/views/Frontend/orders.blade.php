@extends('Layout.Frontend.master')

@section('title', 'My Orders | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/orders.css') }}">
@endpush

@section('content')

<main class="sb-orders-page">

    {{-- =====================================================
       PAGE HEADER
    ====================================================== --}}

    <section class="orders-hero">

        <div class="container">

            <div class="orders-breadcrumb">

                <a href="{{ route('frontend.home') }}">
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>My Orders</span>

            </div>


            <div class="orders-header">

                <span class="orders-eyebrow">
                    <i class="bi bi-bag-check"></i>
                    Your Purchases
                </span>

                <h1>My Orders</h1>

                <p>
                    View and manage all your SecondBook orders in one place.
                </p>

            </div>

        </div>

    </section>


    {{-- =====================================================
       ORDERS CONTENT
    ====================================================== --}}

    <section class="orders-section">

        <div class="container">

            {{-- =================================================
               ALERTS
            ================================================== --}}

            @if(session('success'))

                <div class="orders-alert orders-alert-success">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if(session('error'))

                <div class="orders-alert orders-alert-error">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            {{-- =================================================
               ORDERS
            ================================================== --}}

            @if($orders->count())

                <div class="orders-list">

                    @foreach($orders as $order)

                        <article class="order-card">

                            {{-- =================================================
                               ORDER HEADER
                            ================================================== --}}

                            <div class="order-card-header">

                                <div class="order-number">

                                    <span class="order-label">
                                        Order
                                    </span>

                                    <strong>
                                        #{{ $order->order_number }}
                                    </strong>

                                </div>


                                <div class="order-date">

                                    <i class="bi bi-calendar3"></i>

                                    <span>
                                        {{ $order->created_at->format('M d, Y') }}
                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                               ORDER BODY
                            ================================================== --}}

                            <div class="order-card-body">

                                {{-- Book --}}
                                <div class="order-book">

                                    <div class="order-book-image">

                                        @if($order->book && !empty($order->book->cover))

                                            <img
                                                src="{{ asset('storage/' . $order->book->cover) }}"
                                                alt="{{ $order->book->title }}"
                                            >

                                        @else

                                            <div class="order-book-placeholder">

                                                <i class="bi bi-book"></i>

                                            </div>

                                        @endif

                                    </div>


                                    <div class="order-book-info">

                                        <span class="order-book-label">
                                            Book
                                        </span>

                                        <h2>
                                            {{ $order->book->title ?? 'Book unavailable' }}
                                        </h2>

                                        <div class="order-book-meta">

                                            <span>
                                                Qty: {{ $order->quantity }}
                                            </span>

                                            <span class="meta-dot"></span>

                                            <span>
                                                ${{ number_format($order->book_price, 2) }}
                                                each
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                {{-- Order Info --}}
                                <div class="order-info">

                                    <div class="order-info-item">

                                        <span>
                                            Total
                                        </span>

                                        <strong>
                                            ${{ number_format($order->total_price, 2) }}
                                        </strong>

                                    </div>


                                    <div class="order-info-item">

                                        <span>
                                            Payment
                                        </span>

                                        <strong class="payment-method">

                                            {{ ucwords(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $order->payment_method
                                                )
                                            ) }}

                                        </strong>

                                    </div>

                                </div>


                                {{-- Status --}}
                                <div class="order-status-wrapper">

                                    <span class="order-status-label">
                                        Status
                                    </span>

                                    @php
                                        $statusClass = match($order->order_status) {
                                            'pending' => 'status-pending',
                                            'processing' => 'status-processing',
                                            'shipped' => 'status-shipped',
                                            'delivered' => 'status-delivered',
                                            'cancelled' => 'status-cancelled',
                                            default => 'status-pending',
                                        };
                                    @endphp

                                    <span class="order-status {{ $statusClass }}">

                                        <span class="status-dot"></span>

                                        {{ ucfirst($order->order_status) }}

                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                               ORDER FOOTER
                            ================================================== --}}

                            <div class="order-card-footer">

                                <div class="order-payment-status">

                                    <i class="bi bi-credit-card"></i>

                                    <span>
                                        Payment:
                                    </span>

                                    <strong>
                                        {{ ucfirst($order->payment_status) }}
                                    </strong>

                                </div>


                                <div class="order-actions">

                                    <a
                                        href="{{ route('frontend.orders.show', $order->id) }}"
                                        class="order-details-btn"
                                    >

                                        <span>
                                            View Details
                                        </span>

                                        <i class="bi bi-arrow-right"></i>

                                    </a>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>


                {{-- =================================================
                   PAGINATION
                ================================================== --}}

                @if($orders->hasPages())

                    <div class="orders-pagination">

                        {{ $orders->links() }}

                    </div>

                @endif


            @else

                {{-- =================================================
                   EMPTY STATE
                ================================================== --}}

                <div class="orders-empty">

                    <div class="orders-empty-icon">

                        <i class="bi bi-bag-x"></i>

                    </div>

                    <h2>No Orders Yet</h2>

                    <p>
                        You haven't placed any orders yet.
                        Start exploring our collection and find your next book.
                    </p>

                    <a
                        href="{{ route('frontend.books') }}"
                        class="orders-shop-btn"
                    >

                        <i class="bi bi-book"></i>

                        <span>
                            Browse Books
                        </span>

                    </a>

                </div>

            @endif

        </div>

    </section>

</main>

@endsection