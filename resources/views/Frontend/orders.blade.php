@extends('Layout.Frontend.master')

@section('title', 'My Orders | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/orders.css') }}">
@endpush

@section('content')

<main class="sb-orders-page">

    {{-- =====================================================
       HERO
    ====================================================== --}}

    <section class="orders-hero">

        <div class="container">

            <div class="orders-breadcrumb">

                <a href="{{ route('frontend.home') }}">
                    <i class="bi bi-house-door"></i>
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>
                    Orders
                </span>

            </div>


            <div class="orders-intro">

                <div class="orders-intro-content">

                    <span class="orders-label">
                        <i class="bi bi-box-seam"></i>
                        Order History
                    </span>

                    <h1>
                        Your Orders
                    </h1>

                    <p>
                        Keep track of your purchases, delivery status,
                        and order details all in one place.
                    </p>

                </div>


                <div class="orders-intro-card">

                    <div class="orders-intro-icon">
                        <i class="bi bi-bag-heart"></i>
                    </div>

                    <div class="orders-intro-info">

                        <span>
                            Everything you've ordered
                        </span>

                        <strong>
                            My Purchases
                        </strong>

                    </div>

                    <i class="bi bi-arrow-up-right orders-intro-arrow"></i>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
       CONTENT
    ====================================================== --}}

    <section class="orders-section">

        <div class="container">

            {{-- Alerts --}}

            @if(session('success'))

                <div class="orders-alert orders-alert-success">

                    <div class="orders-alert-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if(session('error'))

                <div class="orders-alert orders-alert-error">

                    <div class="orders-alert-icon">
                        <i class="bi bi-exclamation-lg"></i>
                    </div>

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

                        @php

                            $statusClass = match($order->order_status) {

                                'pending' =>
                                    'status-pending',

                                'processing' =>
                                    'status-processing',

                                'shipped' =>
                                    'status-shipped',

                                'delivered' =>
                                    'status-delivered',

                                'cancelled' =>
                                    'status-cancelled',

                                default =>
                                    'status-pending',
                            };


                            $paymentMethod = $order->payment_method
                                ? ucwords(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $order->payment_method
                                    )
                                )
                                : 'Not selected';


                            $paymentStatus = $order->payment_status
                                ? ucfirst($order->payment_status)
                                : 'Pending';


                            /*
                             * Order can be cancelled only when:
                             * - Cancellation period is enabled
                             * - Order is pending or processing
                             * - Cancellation period has not expired
                             */

                            $canCancelOrder =
                                $cancelOrderPeriod > 0 &&
                                in_array(
                                    $order->order_status,
                                    ['pending', 'processing']
                                ) &&
                                $order->created_at
                                    ->copy()
                                    ->addDays($cancelOrderPeriod)
                                    ->isFuture();

                        @endphp


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

                                {{-- BOOK --}}

                                <div class="order-book">

                                    <div class="order-book-image">

                                        @if($order->book && !empty($order->book->cover))

                                            @php

                                                $cover = $order->book->cover;

                                                $coverUrl = filter_var(
                                                    $cover,
                                                    FILTER_VALIDATE_URL
                                                )
                                                    ? $cover
                                                    : asset(
                                                        'storage/' .
                                                        ltrim($cover, '/')
                                                    );

                                            @endphp


                                            <img
                                                src="{{ $coverUrl }}"
                                                alt="{{ $order->book->title }}"
                                                loading="lazy"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                            >


                                            <div
                                                class="order-book-placeholder"
                                                style="display: none;"
                                            >
                                                <i class="bi bi-book"></i>
                                            </div>

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
                                                <i class="bi bi-box-seam"></i>
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


                                {{-- ORDER INFO --}}

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
                                            {{ $paymentMethod }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- STATUS --}}

                                <div class="order-status-wrapper">

                                    <span class="order-status-label">
                                        Status
                                    </span>

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

                                {{-- PAYMENT STATUS --}}

                                <div class="order-payment-status">

                                    <div class="order-payment-icon">
                                        <i class="bi bi-credit-card-2-front"></i>
                                    </div>

                                    <div>

                                        <span>
                                            Payment Status
                                        </span>

                                        <strong>
                                            {{ $paymentStatus }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- ACTIONS --}}

                                <div class="order-actions">

                                    {{-- VIEW DETAILS --}}

                                    <a
                                        href="{{ route('frontend.orders.show', $order->id) }}"
                                        class="order-details-btn"
                                    >

                                        <span>
                                            View Details
                                        </span>

                                        <i class="bi bi-arrow-right"></i>

                                    </a>


                                    {{-- CANCEL ORDER --}}

                                    @if($canCancelOrder)

                                        <form
                                            action="{{ route('frontend.orders.cancel', $order->id) }}"
                                            method="POST"
                                            class="cancel-order-form"
                                        >

                                            @csrf

                                            <button
                                                type="button"
                                                class="order-cancel-btn js-cancel-order"
                                                data-order="{{ $order->order_number }}"
                                            >

                                                <i class="bi bi-x-circle"></i>

                                                <span>
                                                    Cancel Order
                                                </span>

                                            </button>

                                        </form>

                                    @endif


                                    {{-- WRITE REVIEW --}}

                                    @if(
                                        $order->order_status === 'delivered' &&
                                        $order->book &&
                                        !in_array(
                                            $order->book_id,
                                            $reviewedBookIds
                                        )
                                    )

                                        <a
                                            href="{{ route('frontend.reviews.create', $order->id) }}"
                                            class="order-review-btn"
                                        >

                                            <i class="bi bi-star"></i>

                                            <span>
                                                Write Review
                                            </span>

                                        </a>

                                    @endif

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

                    <span class="orders-empty-label">
                        Your shopping journey starts here
                    </span>

                    <h2>
                        No Orders Yet
                    </h2>

                    <p>
                        You haven't placed any orders yet.
                        Explore our collection and find your next book.
                    </p>

                    <a
                        href="{{ route('frontend.books') }}"
                        class="orders-shop-btn"
                    >

                        <i class="bi bi-book"></i>

                        <span>
                            Browse Books
                        </span>

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            @endif

        </div>

    </section>

</main>

@endsection


{{-- =========================================================
   CANCEL ORDER - SWEETALERT
========================================================= --}}

@push('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    document
        .querySelectorAll('.js-cancel-order')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const form = this.closest('.cancel-order-form');

                const orderNumber = this.dataset.order;


                Swal.fire({

                    title: 'Cancel Order?',

                    text:
                        `Are you sure you want to cancel order #${orderNumber}?`,

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonText: 'Yes, Cancel Order',

                    cancelButtonText: 'Keep Order',

                    reverseButtons: true,

                    customClass: {

                        confirmButton: 'swal-confirm-btn',

                        cancelButton: 'swal-cancel-btn'

                    }

                }).then(function (result) {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            });

        });

});

</script>

@endpush