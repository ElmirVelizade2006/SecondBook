@extends('Layout.Seller.master')

@section('title', 'Orders')

@push('css')
    <link rel="stylesheet" href="{{ asset('seller/css/orders.css') }}">
@endpush

@section('content')

<div class="seller-orders-page">

    {{-- Page Header --}}
    <div class="seller-page-heading">
        <div>
            <h2>Orders</h2>
            <p>Manage orders for your books</p>
        </div>
    </div>


    {{-- Statistics --}}
    <div class="seller-orders-stats">

        <div class="seller-order-stat-card">
            <div class="seller-order-stat-icon">
                <i class="bi bi-bag-check"></i>
            </div>

            <div>
                <span>Total Orders</span>
                <strong id="totalOrdersCount">{{ $totalOrders }}</strong>
            </div>
        </div>


        <div class="seller-order-stat-card">
            <div class="seller-order-stat-icon pending">
                <i class="bi bi-clock-history"></i>
            </div>

            <div>
                <span>Pending</span>
                <strong>{{ $pendingOrders }}</strong>
            </div>
        </div>


        <div class="seller-order-stat-card">
            <div class="seller-order-stat-icon processing">
                <i class="bi bi-arrow-repeat"></i>
            </div>

            <div>
                <span>Processing</span>
                <strong>{{ $processingOrders }}</strong>
            </div>
        </div>


        <div class="seller-order-stat-card">
            <div class="seller-order-stat-icon delivered">
                <i class="bi bi-check-circle"></i>
            </div>

            <div>
                <span>Delivered</span>
                <strong>{{ $deliveredOrders }}</strong>
            </div>
        </div>

    </div>


    {{-- Filters --}}
    <div class="seller-orders-filter-card">

        <form
            action="{{ route('seller.orders.index') }}"
            method="GET"
            class="seller-orders-filter-form"
        >

            {{-- Search --}}
            <div class="seller-order-search">

                <div class="seller-order-search-input">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search order, customer or book..."
                    >

                </div>

                <button
                    type="submit"
                    class="seller-order-search-button"
                >
                    <i class="bi bi-search"></i>
                    Search
                </button>

            </div>


            {{-- Order Status --}}
            <div class="seller-order-filter-select">

                <label for="order_status">
                    Order Status
                </label>

                <select
                    name="order_status"
                    id="order_status"
                >
                    <option value="">All Statuses</option>

                    <option
                        value="pending"
                        {{ request('order_status') === 'pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="processing"
                        {{ request('order_status') === 'processing' ? 'selected' : '' }}
                    >
                        Processing
                    </option>

                    <option
                        value="shipped"
                        {{ request('order_status') === 'shipped' ? 'selected' : '' }}
                    >
                        Shipped
                    </option>

                    <option
                        value="delivered"
                        {{ request('order_status') === 'delivered' ? 'selected' : '' }}
                    >
                        Delivered
                    </option>

                    <option
                        value="cancelled"
                        {{ request('order_status') === 'cancelled' ? 'selected' : '' }}
                    >
                        Cancelled
                    </option>
                </select>

            </div>


            {{-- Payment Status --}}
            <div class="seller-order-filter-select">

                <label for="payment_status">
                    Payment Status
                </label>

                <select
                    name="payment_status"
                    id="payment_status"
                >
                    <option value="">All Payments</option>

                    <option
                        value="pending"
                        {{ request('payment_status') === 'pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="paid"
                        {{ request('payment_status') === 'paid' ? 'selected' : '' }}
                    >
                        Paid
                    </option>

                    <option
                        value="failed"
                        {{ request('payment_status') === 'failed' ? 'selected' : '' }}
                    >
                        Failed
                    </option>

                    <option
                        value="refunded"
                        {{ request('payment_status') === 'refunded' ? 'selected' : '' }}
                    >
                        Refunded
                    </option>
                </select>

            </div>


            {{-- Filter --}}
            <button
                type="submit"
                class="seller-order-filter-button"
            >
                <i class="bi bi-funnel"></i>
                Filter
            </button>


            {{-- Reset --}}
            @if(request()->hasAny(['search', 'order_status', 'payment_status']))

                <a
                    href="{{ route('seller.orders.index') }}"
                    class="seller-order-reset-button"
                >
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>

            @endif

        </form>

    </div>


    {{-- Orders --}}
    <div class="seller-orders-card">

        <div class="seller-orders-card-header">

            <div>
                <h5>Recent Orders</h5>

                <p id="ordersFoundText">
                    {{ $orders->total() }}
                    {{ Str::plural('order', $orders->total()) }} found
                </p>
            </div>

        </div>


        @if($orders->count())

            <div class="seller-orders-table-wrapper">

                <table class="seller-orders-table">

                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Book</th>
                            <th>Customer</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @foreach($orders as $order)

                            <tr id="order-row-{{ $order->id }}">

                                {{-- Order --}}
                                <td>

                                    <div class="seller-order-number">
                                        <span>
                                            #{{ $order->order_number }}
                                        </span>
                                    </div>

                                </td>


                                {{-- Book --}}
                                <td>

                                    <div class="seller-order-book">

                                        <div class="seller-order-book-cover">

                                            @if($order->book?->cover)

                                                <img
                                                    src="{{ asset('storage/' . $order->book->cover) }}"
                                                    alt="{{ $order->book->title }}"
                                                >

                                            @else

                                                <div class="seller-order-no-cover">
                                                    <i class="bi bi-book"></i>
                                                </div>

                                            @endif

                                        </div>


                                        <div class="seller-order-book-info">

                                            <strong>
                                                {{ Str::limit($order->book->title ?? 'Deleted Book', 30) }}
                                            </strong>

                                            @if($order->book?->isbn)

                                                <span>
                                                    ISBN: {{ $order->book->isbn }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Customer --}}
                                <td>

                                    <div class="seller-order-customer">

                                        <div class="seller-order-customer-avatar">

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


                                        <div class="seller-order-customer-info">

                                            <strong>
                                                {{ $order->user->name ?? 'Unknown Customer' }}
                                            </strong>

                                            @if($order->user?->email)

                                                <span>
                                                    {{ $order->user->email }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Quantity --}}
                                <td>
                                    <span class="seller-order-quantity">
                                        {{ $order->quantity }}
                                    </span>
                                </td>


                                {{-- Total --}}
                                <td>

                                    <strong class="seller-order-total">
                                        ${{ number_format($order->total_price, 2) }}
                                    </strong>

                                </td>


                                {{-- Payment --}}
                                <td>

                                    @php
                                        $paymentStatusClass = match($order->payment_status) {
                                            'paid' => 'paid',
                                            'failed' => 'failed',
                                            'refunded' => 'refunded',
                                            default => 'pending',
                                        };
                                    @endphp

                                    <span class="seller-payment-badge {{ $paymentStatusClass }}">
                                        {{ ucfirst($order->payment_status ?? 'pending') }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td>

                                    @php
                                        $orderStatusClass = match($order->order_status) {
                                            'processing' => 'processing',
                                            'shipped' => 'shipped',
                                            'delivered' => 'delivered',
                                            'cancelled' => 'cancelled',
                                            default => 'pending',
                                        };
                                    @endphp

                                    <span class="seller-order-status-badge {{ $orderStatusClass }}">
                                        {{ ucfirst($order->order_status ?? 'pending') }}
                                    </span>

                                </td>


                                {{-- Date --}}
                                <td>

                                    <div class="seller-order-date">

                                        <strong>
                                            {{ $order->created_at->format('M d, Y') }}
                                        </strong>

                                        <span>
                                            {{ $order->created_at->format('H:i') }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="seller-order-actions">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('seller.orders.show', $order) }}"
                                            class="seller-order-view-button"
                                            title="View Order"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        {{-- Delete --}}
                                        @if(in_array($order->order_status, ['pending', 'cancelled']))

                                            <button
                                                type="button"
                                                class="seller-order-delete-button"
                                                title="Delete Order"
                                                data-delete-order="{{ $order->id }}"
                                                data-order-number="{{ $order->order_number }}"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($orders->hasPages())

                <div class="seller-orders-pagination">
                    {{ $orders->links() }}
                </div>

            @endif

        @else

            {{-- Empty State --}}
            <div class="seller-orders-empty">

                <div class="seller-orders-empty-icon">
                    <i class="bi bi-bag-x"></i>
                </div>

                <h4>No orders found</h4>

                <p>

                    @if(request()->hasAny(['search', 'order_status', 'payment_status']))

                        No orders match your current filters.

                    @else

                        You don't have any orders for your books yet.

                    @endif

                </p>


                @if(request()->hasAny(['search', 'order_status', 'payment_status']))

                    <a
                        href="{{ route('seller.orders.index') }}"
                        class="seller-order-empty-button"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Clear Filters
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>

@endsection


{{-- Delete Form --}}

<form
    id="deleteOrderForm"
    method="POST"
    style="display: none;"
>
    @csrf
    @method('DELETE')
</form>


{{-- Delete Confirmation Modal --}}

<div
    class="seller-modal-overlay"
    id="deleteOrderModal"
>

    <div class="seller-delete-modal">

        <button
            type="button"
            class="seller-modal-close"
            id="closeDeleteModal"
        >
            <i class="bi bi-x"></i>
        </button>


        <div class="seller-delete-icon">
            <i class="bi bi-trash3"></i>
        </div>


        <h4>Delete Order?</h4>


        <p>
            Are you sure you want to delete
            <strong id="deleteOrderNumber"></strong>?
            <br>
            This action cannot be undone.
        </p>


        <div class="seller-delete-actions">

            <button
                type="button"
                class="seller-modal-cancel"
                id="cancelDelete"
            >
                Cancel
            </button>


            <button
                type="button"
                class="seller-modal-delete"
                id="confirmDelete"
            >
                <i class="bi bi-trash3"></i>
                Delete Order
            </button>

        </div>

    </div>

</div>


{{-- Success Alert --}}

<div
    class="seller-success-alert"
    id="sellerSuccessAlert"
    style="display: none;"
>

    <div class="seller-success-icon">
        <i class="bi bi-check-lg"></i>
    </div>


    <div class="seller-success-content">

        <strong>
            Success
        </strong>

        <span id="sellerSuccessMessage">
            Order deleted successfully.
        </span>

    </div>


    <button
        type="button"
        class="seller-success-close"
        id="closeSuccessAlert"
    >
        <i class="bi bi-x"></i>
    </button>

</div>


@push('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('deleteOrderModal');

    const deleteForm = document.getElementById('deleteOrderForm');

    const deleteNumber = document.getElementById('deleteOrderNumber');

    const closeModal = document.getElementById('closeDeleteModal');

    const cancelDelete = document.getElementById('cancelDelete');

    const confirmDelete = document.getElementById('confirmDelete');

    const deleteButtons = document.querySelectorAll(
        '[data-delete-order]'
    );


    let selectedOrderId = null;

    let selectedOrderRow = null;


    /*
    |--------------------------------------------------------------------------
    | Open Delete Modal
    |--------------------------------------------------------------------------
    */

    deleteButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            selectedOrderId = this.dataset.deleteOrder;

            selectedOrderRow = document.getElementById(
                'order-row-' + selectedOrderId
            );


            const orderNumber =
                this.dataset.orderNumber;


            deleteNumber.textContent =
                '#' + orderNumber;


            deleteForm.action =
                '/seller/orders/' + selectedOrderId;


            modal.classList.add('show');

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Close Modal
    |--------------------------------------------------------------------------
    */

    function hideDeleteModal() {

        modal.classList.remove('show');

        selectedOrderId = null;

        selectedOrderRow = null;

    }


    closeModal.addEventListener(
        'click',
        hideDeleteModal
    );


    cancelDelete.addEventListener(
        'click',
        hideDeleteModal
    );


    modal.addEventListener(
        'click',
        function (event) {

            if (event.target === modal) {

                hideDeleteModal();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Confirm Delete
    |--------------------------------------------------------------------------
    */

    confirmDelete.addEventListener(
        'click',
        async function () {

            if (!selectedOrderId || !selectedOrderRow) {
                return;
            }


            const row =
                selectedOrderRow;


            confirmDelete.disabled = true;


            try {

                const formData =
                    new FormData(deleteForm);


                const response =
                    await fetch(
                        deleteForm.action,
                        {
                            method: 'POST',

                            headers: {
                                'X-CSRF-TOKEN':
                                    document.querySelector(
                                        'input[name="_token"]'
                                    ).value,

                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            },

                            body: formData
                        }
                    );


                const data =
                    await response.json();


                if (!response.ok || !data.success) {

                    throw new Error(
                        data.message ||
                        'Unable to delete the order.'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Close Modal
                |--------------------------------------------------------------------------
                */

                hideDeleteModal();


                /*
                |--------------------------------------------------------------------------
                | Remove Row
                |--------------------------------------------------------------------------
                */

                row.style.transition =
                    'opacity 0.25s ease, transform 0.25s ease';

                row.style.opacity = '0';

                row.style.transform =
                    'translateX(10px)';


                setTimeout(function () {

                    row.remove();


                    /*
                    |--------------------------------------------------------------------------
                    | Total Orders
                    |--------------------------------------------------------------------------
                    */

                    const totalOrders =
                        document.getElementById(
                            'totalOrdersCount'
                        );


                    if (totalOrders) {

                        totalOrders.textContent =
                            Math.max(
                                0,
                                parseInt(
                                    totalOrders.textContent
                                ) - 1
                            );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Orders Found
                    |--------------------------------------------------------------------------
                    */

                    const ordersFoundText =
                        document.getElementById(
                            'ordersFoundText'
                        );


                    if (ordersFoundText) {

                        const match =
                            ordersFoundText.textContent.match(
                                /\d+/
                            );


                        if (match) {

                            const currentCount =
                                parseInt(match[0]);


                            const newCount =
                                Math.max(
                                    0,
                                    currentCount - 1
                                );


                            ordersFoundText.textContent =
                                newCount +
                                ' ' +
                                (
                                    newCount === 1
                                        ? 'order'
                                        : 'orders'
                                ) +
                                ' found';

                        }

                    }

                }, 250);


                /*
                |--------------------------------------------------------------------------
                | Success Alert
                |--------------------------------------------------------------------------
                */

                const successAlert =
                    document.getElementById(
                        'sellerSuccessAlert'
                    );


                const successMessage =
                    document.getElementById(
                        'sellerSuccessMessage'
                    );


                if (
                    successAlert &&
                    successMessage
                ) {

                    successMessage.textContent =
                        data.message ||
                        'Order deleted successfully.';


                    successAlert.style.display =
                        'flex';


                    setTimeout(function () {

                        successAlert.remove();

                    }, 4000);

                }


            } catch (error) {

                console.error(
                    'Delete order error:',
                    error
                );


                alert(
                    error.message ||
                    'Something went wrong while deleting the order.'
                );

            } finally {

                confirmDelete.disabled = false;

            }

        }
    );

});

</script>

@endpush