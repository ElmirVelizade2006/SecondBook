@extends('layout.admin.master')

@section('title', 'Analytics')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/analytics.css') }}">
@endpush

@section('content')

<div class="dashboard-section analytics-page">

    {{-- Header --}}
    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0">
            <div>
                <h5 class="mb-1">Analytics</h5>
                <p class="text-muted mb-0 small">
                    Monitor your store performance and business insights
                </p>
            </div>
        </div>
    </div>


    {{-- Date Filter --}}
    <div class="dashboard-panel mb-4">
        <form method="GET"
              action="{{ route('admin.analytics.index') }}"
              class="analytics-filter">

            <div class="filter-group">
                <label for="start_date">Start Date</label>
                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ request('start_date', $startDate->format('Y-m-d')) }}"
                >
            </div>

            <div class="filter-group">
                <label for="end_date">End Date</label>
                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="{{ request('end_date', $endDate->format('Y-m-d')) }}"
                >
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-funnel me-1"></i>
                    Apply Filter
                </button>

                <a href="{{ route('admin.analytics.index') }}"
                   class="btn btn-light">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Reset
                </a>
            </div>

        </form>
    </div>


    {{-- Main Statistics --}}
    <div class="row g-4 mb-4">

        {{-- Revenue --}}
        <div class="col-xl-3 col-md-6">
            <div class="analytics-card">
                <div class="analytics-card-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>

                <div>
                    <span class="analytics-label">Total Revenue</span>
                    <h4>
                        ${{ number_format($totalRevenue, 2) }}
                    </h4>
                </div>
            </div>
        </div>


        {{-- Orders --}}
        <div class="col-xl-3 col-md-6">
            <div class="analytics-card">
                <div class="analytics-card-icon">
                    <i class="bi bi-bag-check"></i>
                </div>

                <div>
                    <span class="analytics-label">Total Orders</span>
                    <h4>
                        {{ number_format($totalOrders) }}
                    </h4>
                </div>
            </div>
        </div>


        {{-- Books Sold --}}
        <div class="col-xl-3 col-md-6">
            <div class="analytics-card">
                <div class="analytics-card-icon">
                    <i class="bi bi-book"></i>
                </div>

                <div>
                    <span class="analytics-label">Books Sold</span>
                    <h4>
                        {{ number_format($booksSold) }}
                    </h4>
                </div>
            </div>
        </div>


        {{-- New Users --}}
        <div class="col-xl-3 col-md-6">
            <div class="analytics-card">
                <div class="analytics-card-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div>
                    <span class="analytics-label">New Users</span>
                    <h4>
                        {{ number_format($newUsers) }}
                    </h4>
                </div>
            </div>
        </div>

    </div>


    {{-- Secondary Statistics --}}
    <div class="row g-4 mb-4">

        {{-- Delivered --}}
        <div class="col-xl-3 col-md-6">
            <div class="analytics-mini-card">
                <span>Delivered Orders</span>
                <strong>{{ number_format($deliveredOrders) }}</strong>
            </div>
        </div>


        {{-- Pending --}}
        <div class="col-xl-3 col-md-6">
            <div class="analytics-mini-card">
                <span>Pending Orders</span>
                <strong>{{ number_format($pendingOrders) }}</strong>
            </div>
        </div>


        {{-- Cancelled --}}
        <div class="col-xl-3 col-md-6">
            <div class="analytics-mini-card">
                <span>Cancelled Orders</span>
                <strong>{{ number_format($cancelledOrders) }}</strong>
            </div>
        </div>


        {{-- Average Order --}}
        <div class="col-xl-3 col-md-6">
            <div class="analytics-mini-card">
                <span>Average Order Value</span>
                <strong>
                    ${{ number_format($averageOrderValue, 2) }}
                </strong>
            </div>
        </div>

    </div>


    {{-- Revenue Chart --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header">
            <div>
                <h5 class="mb-1">Revenue Analytics</h5>
                <p class="text-muted mb-0 small">
                    Revenue generated during the selected period
                </p>
            </div>
        </div>

        <div class="analytics-chart-wrapper">
            <canvas id="revenueChart"></canvas>
        </div>

    </div>


    {{-- Orders Status + Inventory --}}
    <div class="row g-4 mb-4">

        {{-- Orders Status --}}
        <div class="col-xl-6">
            <div class="dashboard-panel h-100">

                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">Order Status</h5>
                        <p class="text-muted mb-0 small">
                            Orders grouped by current status
                        </p>
                    </div>
                </div>

                <div class="analytics-status-list">

                    @forelse($ordersByStatus as $status)

                        <div class="status-row">

                            <div class="status-info">
                                <span>
                                    {{ ucwords(str_replace('_', ' ', $status->order_status)) }}
                                </span>
                            </div>

                            <strong>
                                {{ number_format($status->total) }}
                            </strong>

                        </div>

                    @empty

                        <div class="empty-state">
                            <i class="bi bi-bar-chart"></i>
                            <p>No order data available.</p>
                        </div>

                    @endforelse

                </div>

            </div>
        </div>


        {{-- Inventory --}}
        <div class="col-xl-6">
            <div class="dashboard-panel h-100">

                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">Inventory Overview</h5>
                        <p class="text-muted mb-0 small">
                            Current book stock information
                        </p>
                    </div>
                </div>

                <div class="inventory-grid">

                    <div class="inventory-item">
                        <span>Total Books</span>
                        <strong>{{ number_format($totalBooks) }}</strong>
                    </div>

                    <div class="inventory-item">
                        <span>Low Stock</span>
                        <strong>{{ number_format($lowStockBooks) }}</strong>
                    </div>

                    <div class="inventory-item">
                        <span>Out of Stock</span>
                        <strong>{{ number_format($outOfStockBooks) }}</strong>
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Top Selling Books --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header">
            <div>
                <h5 class="mb-1">Top Selling Books</h5>
                <p class="text-muted mb-0 small">
                    Best performing books during the selected period
                </p>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table analytics-table align-middle mb-0">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Book</th>
                        <th>Units Sold</th>
                        <th>Revenue</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($topBooks as $index => $item)

                        <tr>
                            <td>
                                {{ $index + 1 }}
                            </td>

                            <td>
                                <strong>
                                    {{ $item->book->title ?? 'Deleted Book' }}
                                </strong>
                            </td>

                            <td>
                                {{ number_format($item->total_sold) }}
                            </td>

                            <td>
                                ${{ number_format($item->revenue, 2) }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-4">
                                No sales data available.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Recent Orders --}}
    <div class="dashboard-panel">

        <div class="panel-header">
            <div>
                <h5 class="mb-1">Recent Orders</h5>
                <p class="text-muted mb-0 small">
                    Latest orders within the selected period
                </p>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table analytics-table align-middle mb-0">

                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Book</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentOrders as $order)

                        <tr>

                            <td>
                                {{ $order->order_number }}
                            </td>

                            <td>
                                {{ $order->user->name ?? 'Guest' }}
                            </td>

                            <td>
                                {{ $order->book->title ?? 'Deleted Book' }}
                            </td>

                            <td>
                                <span class="analytics-status">
                                    {{ ucwords(str_replace('_', ' ', $order->order_status)) }}
                                </span>
                            </td>

                            <td>
                                ${{ number_format($order->total_price, 2) }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-4">
                                No recent orders found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@push('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const revenueData = @json($revenueByDay);

    const revenueLabels = revenueData.map(item => item.date);
    const revenueValues = revenueData.map(item => Number(item.revenue));

    const revenueCanvas = document.getElementById('revenueChart');

    if (revenueCanvas) {
        new Chart(revenueCanvas, {
            type: 'line',

            data: {
                labels: revenueLabels,

                datasets: [{
                    label: 'Revenue',
                    data: revenueValues,
                    tension: 0.4,
                    fill: true
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>

@endpush