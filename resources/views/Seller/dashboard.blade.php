@extends('Layout.Seller.master')

@section('title', 'Dashboard')

@section('content')

<div class="seller-dashboard">

    <div class="mb-4">
        <h1>Seller Dashboard</h1>
        <p>Manage your store, books and sales.</p>
    </div>

    <div class="row g-4">

        {{-- Total Books --}}
        <div class="col-xl-3 col-md-6">
            <div class="seller-stat-card">
                <div class="seller-stat-icon">
                    <i class="bi bi-book"></i>
                </div>

                <div>
                    <span>Total Books</span>
                    <h3>{{ $totalBooks }}</h3>
                </div>
            </div>
        </div>

        {{-- Pending Books --}}
        <div class="col-xl-3 col-md-6">
            <div class="seller-stat-card">
                <div class="seller-stat-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div>
                    <span>Pending Books</span>
                    <h3>{{ $pendingBooks }}</h3>
                </div>
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="col-xl-3 col-md-6">
            <div class="seller-stat-card">
                <div class="seller-stat-icon">
                    <i class="bi bi-bag"></i>
                </div>

                <div>
                    <span>Total Orders</span>
                    <h3>{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>

        {{-- Total Sales --}}
        <div class="col-xl-3 col-md-6">
            <div class="seller-stat-card">
                <div class="seller-stat-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>

                <div>
                    <span>Total Sales</span>
                    <h3>${{ number_format($totalSales, 2) }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Orders --}}
    <div class="seller-dashboard-panel mt-4">

        <div class="seller-panel-header">
            <div>
                <h5>Recent Orders</h5>
                <p>Latest orders for your books</p>
            </div>

            <a href="{{ route('seller.orders.index') }}" class="seller-panel-link">
                View All
            </a>
        </div>

        @if($recentOrders->count())

            <div class="table-responsive">

                <table class="table seller-orders-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Book</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($recentOrders as $order)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $order->order_number }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $order->user?->full_name ?: $order->user?->name ?? 'Unknown' }}
                                </td>

                                <td>
                                    {{ $order->book?->title ?? 'Deleted Book' }}
                                </td>

                                <td>
                                    {{ $order->quantity }}
                                </td>

                                <td>
                                    ${{ number_format($order->total_price, 2) }}
                                </td>

                                <td>
                                    <span class="seller-status">
                                        {{ ucwords(str_replace('_', ' ', $order->order_status)) }}
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="seller-empty-state">

                <div class="seller-empty-icon">
                    <i class="bi bi-bag-x"></i>
                </div>

                <h6>No Orders Yet</h6>

                <p>
                    You don't have any orders for your books yet.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection