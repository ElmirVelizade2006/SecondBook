@extends('Layout.Seller.master')

@section('title', 'Order Details')

@push('css')
    <link rel="stylesheet" href="{{ asset('seller/css/orders.css') }}">
@endpush

@section('content')

<div class="seller-orders-page seller-order-details-page">

    {{-- Success Alert --}}
    @if(session('success'))

        <div class="seller-order-success-alert">
            <div class="seller-order-success-icon">
                <i class="bi bi-check-lg"></i>
            </div>

            <div>
                <strong>Success</strong>
                <span>{{ session('success') }}</span>
            </div>
        </div>

    @endif


    {{-- Page Header --}}
    <div class="seller-page-heading">

        <div>
            <h2>Order Details</h2>

            <p>
                Order #{{ $order->order_number }}
            </p>
        </div>

        <a
            href="{{ route('seller.orders.index') }}"
            class="seller-outline-button"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Orders
        </a>

    </div>


    {{-- Main Grid --}}
    <div class="seller-order-details-grid">

        {{-- Left Column --}}
        <div class="seller-order-details-main">

            {{-- Order Information --}}
            <div class="seller-order-details-card">

                <div class="seller-order-details-card-header">

                    <div>
                        <h5>Order Information</h5>

                        <p>
                            Order #{{ $order->order_number }}
                        </p>
                    </div>

                    @php
                        $statusClass = match($order->order_status) {
                            'processing' => 'processing',
                            'shipped' => 'shipped',
                            'delivered' => 'delivered',
                            'cancelled' => 'cancelled',
                            default => 'pending',
                        };
                    @endphp

                    <span class="seller-order-status-badge {{ $statusClass }}">
                        {{ ucfirst($order->order_status ?? 'pending') }}
                    </span>

                </div>


                <div class="seller-order-details-body">

                    {{-- Book --}}
                    <div class="seller-order-detail-book">

                        <div class="seller-order-detail-cover">

                            @if($order->book?->cover)

                                <img
                                    src="{{ asset('storage/' . $order->book->cover) }}"
                                    alt="{{ $order->book->title }}"
                                >

                            @else

                                <div class="seller-order-detail-no-cover">
                                    <i class="bi bi-book"></i>
                                </div>

                            @endif

                        </div>


                        <div class="seller-order-detail-book-info">

                            <span class="seller-order-detail-label">
                                BOOK
                            </span>

                            <h3>
                                {{ $order->book->title ?? 'Deleted Book' }}
                            </h3>

                            @if($order->book?->isbn)

                                <p>
                                    ISBN: {{ $order->book->isbn }}
                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- Order Summary --}}
                    <div class="seller-order-summary">

                        <div class="seller-order-summary-item">

                            <span>Book Price</span>

                            <strong>
                                ${{ number_format($order->book_price, 2) }}
                            </strong>

                        </div>


                        <div class="seller-order-summary-item">

                            <span>Quantity</span>

                            <strong>
                                {{ $order->quantity }}
                            </strong>

                        </div>


                        <div class="seller-order-summary-item total">

                            <span>Total</span>

                            <strong>
                                ${{ number_format($order->total_price, 2) }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Customer Information --}}
            <div class="seller-order-details-card">

                <div class="seller-order-details-card-header">

                    <div>
                        <h5>Customer Information</h5>

                        <p>
                            Buyer details
                        </p>
                    </div>

                </div>


                <div class="seller-order-customer-details">

                    <div class="seller-order-customer-large">

                        <div class="seller-order-customer-large-avatar">

                            @if($order->user?->profile_photo)

                                <img
                                    src="{{ asset('storage/' . $order->user->profile_photo) }}"
                                    alt="{{ $order->user->name }}"
                                >

                            @else

                                <span>
                                    {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                </span>

                            @endif

                        </div>


                        <div>

                            <strong>
                                {{ $order->user->name ?? 'Unknown Customer' }}
                            </strong>

                            @if($order->user?->email)

                                <span>
                                    {{ $order->user->email }}
                                </span>

                            @endif

                            @if($order->user?->phone)

                                <span>
                                    {{ $order->user->phone }}
                                </span>

                            @endif

                        </div>

                    </div>


                    <div class="seller-order-info-grid">

                        <div>
                            <span>Full Name</span>

                            <strong>
                                {{ $order->full_name ?? 'Not provided' }}
                            </strong>
                        </div>


                        <div>
                            <span>Phone</span>

                            <strong>
                                {{ $order->phone ?? 'Not provided' }}
                            </strong>
                        </div>


                        <div>
                            <span>Country</span>

                            <strong>
                                {{ $order->country ?? 'Not provided' }}
                            </strong>
                        </div>


                        <div>
                            <span>City</span>

                            <strong>
                                {{ $order->city ?? 'Not provided' }}
                            </strong>
                        </div>


                        <div>
                            <span>Postal Code</span>

                            <strong>
                                {{ $order->postal_code ?? 'Not provided' }}
                            </strong>
                        </div>


                        <div class="full-width">
                            <span>Address</span>

                            <strong>
                                {{ $order->address ?? 'Not provided' }}
                            </strong>
                        </div>


                        {{-- Customer Order Note --}}
                        @if($order->note)

                            <div class="full-width">
                                <span>Customer Order Note</span>

                                <strong>
                                    {{ $order->note }}
                                </strong>
                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Store Order Note --}}
            @if($order->order_note)

                <div class="seller-order-details-card">

                    <div class="seller-order-details-card-header">

                        <div>
                            <h5>Store Order Note</h5>

                            <p>
                                Instructions provided by your store
                            </p>
                        </div>

                        <div class="seller-order-note-icon">
                            <i class="bi bi-sticky"></i>
                        </div>

                    </div>


                    <div class="seller-order-note-body">
                        {{ $order->order_note }}
                    </div>

                </div>

            @endif


            {{-- Payment Information --}}
            <div class="seller-order-details-card">

                <div class="seller-order-details-card-header">

                    <div>
                        <h5>Payment Information</h5>

                        <p>
                            Payment details for this order
                        </p>
                    </div>

                </div>


                <div class="seller-order-payment-grid">

                    <div>

                        <span>Payment Method</span>

                        <strong>
                            {{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'Not selected')) }}
                        </strong>

                    </div>


                    <div>

                        <span>Payment Status</span>

                        @php
                            $paymentClass = match($order->payment_status) {
                                'paid' => 'paid',
                                'failed' => 'failed',
                                'refunded' => 'refunded',
                                default => 'pending',
                            };
                        @endphp

                        <strong>
                            <span class="seller-payment-badge {{ $paymentClass }}">
                                {{ ucfirst($order->payment_status ?? 'pending') }}
                            </span>
                        </strong>

                    </div>


                    @if($order->payment)

                        @if($order->payment->transaction_id)

                            <div>

                                <span>Transaction ID</span>

                                <strong>
                                    {{ $order->payment->transaction_id }}
                                </strong>

                            </div>

                        @endif


                        @if($order->payment->paid_at)

                            <div>

                                <span>Paid At</span>

                                <strong>
                                    {{ $order->payment->paid_at->format('M d, Y H:i') }}
                                </strong>

                            </div>

                        @endif

                    @endif

                </div>

            </div>

        </div>


        {{-- Right Column --}}
        <div class="seller-order-details-sidebar">

            {{-- Update Status --}}
            <div class="seller-order-details-card seller-order-status-card">

                <div class="seller-order-details-card-header">

                    <div>
                        <h5>Update Status</h5>

                        <p>
                            Change the order status
                        </p>
                    </div>

                </div>


                <div class="seller-order-status-form-body">

                    <form
                        action="{{ route('seller.orders.update-status', $order) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')


                        <div class="seller-order-status-current">

                            <span>Current Status</span>

                            <strong class="{{ $statusClass }}">
                                {{ ucfirst($order->order_status ?? 'pending') }}
                            </strong>

                        </div>


                        <div class="seller-order-status-select">

                            <label for="order_status">
                                New Status
                            </label>

                            <select
                                name="order_status"
                                id="order_status"
                                required
                            >

                                <option
                                    value="pending"
                                    {{ $order->order_status === 'pending' ? 'selected' : '' }}
                                >
                                    Pending
                                </option>

                                <option
                                    value="processing"
                                    {{ $order->order_status === 'processing' ? 'selected' : '' }}
                                >
                                    Processing
                                </option>

                                <option
                                    value="shipped"
                                    {{ $order->order_status === 'shipped' ? 'selected' : '' }}
                                >
                                    Shipped
                                </option>

                                <option
                                    value="delivered"
                                    {{ $order->order_status === 'delivered' ? 'selected' : '' }}
                                >
                                    Delivered
                                </option>

                                <option
                                    value="cancelled"
                                    {{ $order->order_status === 'cancelled' ? 'selected' : '' }}
                                >
                                    Cancelled
                                </option>

                            </select>

                        </div>


                        @error('order_status')

                            <div class="seller-order-validation-error">
                                {{ $message }}
                            </div>

                        @enderror


                        <button
                            type="submit"
                            class="seller-save-button seller-order-update-button"
                        >
                            <i class="bi bi-check2-circle"></i>
                            Update Status
                        </button>

                    </form>

                </div>

            </div>


            {{-- Order Timeline --}}
            <div class="seller-order-details-card">

                <div class="seller-order-details-card-header">

                    <div>
                        <h5>Order Details</h5>

                        <p>
                            Basic order information
                        </p>
                    </div>

                </div>


                <div class="seller-order-meta-list">

                    <div>
                        <span>Order Number</span>

                        <strong>
                            #{{ $order->order_number }}
                        </strong>
                    </div>


                    <div>
                        <span>Created</span>

                        <strong>
                            {{ $order->created_at->format('M d, Y H:i') }}
                        </strong>
                    </div>


                    <div>
                        <span>Last Updated</span>

                        <strong>
                            {{ $order->updated_at->format('M d, Y H:i') }}
                        </strong>
                    </div>


                    <div>
                        <span>Processing Deadline</span>

                        <strong
                            class="
                                @if($order->processing_deadline)
                                    {{ $order->processing_deadline->isPast() ? 'overdue' : 'deadline' }}
                                @endif
                            "
                        >
                            @if($order->processing_deadline)
                                {{ $order->processing_deadline->format('M d, Y H:i') }}
                            @else
                                Not set
                            @endif
                        </strong>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection