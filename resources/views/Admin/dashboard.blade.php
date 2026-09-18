@extends('layout.admin.master')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-section">

{{-- =========================================
    HERO SECTION
========================================= --}}

<div class="hero-section mb-4">

    <div class="hero-content">

        <span class="hero-badge">
            <i class="bi bi-stars"></i>
            SecondBook Admin
        </span>

        <h2>Welcome Back, Admin 👋</h2>

        <p>
            Manage your books, users and categories from one place.
        </p>

            <div class="hero-buttons">

                <a href="{{ route('admin.books.index') }}" class="btn btn-light">
                    <i class="bi bi-book me-2"></i>
                    View Books
                </a>

                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add Book
                </a>

            </div>

        </div>

        <div class="hero-icon">

            <i class="bi bi-book-half"></i>

        </div>

    </div>
</div>

{{-- =========================================
    STATISTICS CARDS
========================================= --}}

<div class="row g-4 mx-2 ">

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-card blue">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="mb-0">
                    Total Books
                </h6>

                <div class="card-icon blue">
                    <i class="bi bi-book"></i>
                </div>

            </div>

            <h2 class="mt-4 mb-1">{{ $totalBooks }}</h2>

            <p class="text-success mb-0">
                <i class="bi bi-arrow-up"></i>
                0% This Month
            </p>

            <div class="dashboard-card-footer">

                <a href="{{ route('admin.books.index') }}">
                    View Details
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-card">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="mb-0">
                    Total Users
                </h6>

                <div class="card-icon green">
                    <i class="bi bi-people"></i>
                </div>

            </div>

            <h2 class="mt-4 mb-1">{{ $totalUsers }}</h2>

            <p class="text-success mb-0">
                <i class="bi bi-arrow-up"></i>
                0% This Month
            </p>

            <div class="dashboard-card-footer">

                <a href="{{ route('admin.users.index') }}">
                    View Details
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-card">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="mb-0">
                    Categories
                </h6>

                <div class="card-icon orange">
                    <i class="bi bi-grid"></i>
                </div>

            </div>

            <h2 class="mt-4 mb-1">{{ $totalCategories }}</h2>

            <p class="text-success mb-0">
                <i class="bi bi-arrow-up"></i>
                0% This Month
            </p>

            <div class="dashboard-card-footer">

                <a href="{{ route('admin.categories.index') }}">
                    View Details
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-card">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="mb-0">
                    Authors
                </h6>

                <div class="card-icon red">
                    <i class="bi bi-pencil-square"></i>
                </div>

            </div>

            <h2 class="mt-4 mb-1">{{ $totalAuthors }}</h2>

            <p class="text-success mb-0">
                <i class="bi bi-arrow-up"></i>
                0% This Month
            </p>

            <div class="dashboard-card-footer">

                <a href="{{ route('admin.authors.index') }}">
                    View Details
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </div>
</div>

{{-- =========================================
    CHART & ACTIVITY
========================================= --}}

<div class="row g-4 mx-2 mt-2 mt-md-4">

    <!-- Left Side -->
    <div class="col-12 col-lg-8">

        <div class="dashboard-panel">

            <div class="panel-header">

                <h5>Monthly Overview</h5>

                <button class="btn btn-light btn-sm">
                    This Month
                </button>

            </div>

            <div class="chart-container">
                <canvas id="monthlyOverviewChart"></canvas>
            </div>

        </div>

    </div>

    <!-- Right Side -->
    <div class="col-12 col-lg-4">

        <div class="dashboard-panel">

            <div class="panel-header">
                <h5>Recent Activity</h5>
            </div>

            <div class="activity-list">

                @if($recentBooks->isNotEmpty())

                    <div class="activity-item">

                        <div class="activity-icon bg-primary">
                            <i class="bi bi-book"></i>
                        </div>

                        <div>
                            <strong>New Book Added</strong>
                            <p>{{ $recentBooks->first()->title }}</p>
                        </div>

                    </div>

                @endif

                @if($recentUsers->isNotEmpty())

                    <div class="activity-item">

                        <div class="activity-icon bg-success">
                            <i class="bi bi-person"></i>
                        </div>

                        <div>
                            <strong>New User</strong>
                            <p>{{ $recentUsers->first()->name }} registered</p>
                        </div>

                    </div>

                @endif

                @if($recentCategories->isNotEmpty())

                    <div class="activity-item">

                        <div class="activity-icon bg-warning">
                            <i class="bi bi-grid"></i>
                        </div>

                        <div>
                            <strong>Category Created</strong>
                            <p>{{ $recentCategories->first()->name }}</p>
                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- =========================================
    RECENT BOOKS
========================================= --}}

<div class="dashboard-panel mx-2 mt-2 mt-md-4">

    <div class="panel-header">

        <h5>Recent Books</h5>

        <a href="{{ route('admin.books.index') }}" class="btn btn-primary btn-sm">
            View All
        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead>
                <tr>
                    <th>Book</th>
                    <th class="d-none d-md-table-cell">Category</th>
                    <th class="d-none d-lg-table-cell">Seller</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($recentBooks as $book)

                    <tr>

                        {{-- Book --}}
                        <td>

                            <div class="d-flex align-items-center gap-3">

                                @if($book->cover)

                                    <img
                                        src="{{ asset('storage/' . $book->cover) }}"
                                        alt="{{ $book->title }}"
                                        width="45"
                                        height="55"
                                        style="object-fit: cover; border-radius: 8px;"
                                    >

                                @else

                                    <div
                                        class="d-flex align-items-center justify-content-center"
                                        style="
                                            width: 45px;
                                            height: 55px;
                                            border-radius: 8px;
                                            background: #f1f5f9;
                                        "
                                    >
                                        <i class="bi bi-book"></i>
                                    </div>

                                @endif

                                <div>

                                    <div class="fw-semibold">
                                        {{ $book->title }}
                                    </div>

                                    @if($book->isbn)
                                        <small class="text-muted">
                                            ISBN: {{ $book->isbn }}
                                        </small>
                                    @endif

                                </div>

                            </div>

                        </td>

                        {{-- Category --}}
                        <td class="d-none d-md-table-cell">

                            {{ $book->category->name ?? 'No Category' }}

                        </td>

                        {{-- Seller --}}
                        <td class="d-none d-lg-table-cell">

                            {{ $book->seller->name ?? 'No Seller' }}

                        </td>

                        {{-- Price --}}
                        <td>

                            {{ number_format($book->price, 2) }} AZN

                        </td>

                        {{-- Status --}}
                        <td>

                            @if($book->status === 'approved')

                                <span class="badge bg-success">
                                    Approved
                                </span>

                            @elseif($book->status === 'pending')

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            @elseif($book->status === 'rejected')

                                <span class="badge bg-danger">
                                    Rejected
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ ucfirst($book->status) }}
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-4">

                            <div class="text-muted">

                                <i class="bi bi-book fs-3 d-block mb-2"></i>

                                No books found.

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- =========================================
    ORDER OVERVIEW & QUICK ACTIONS
========================================= --}}

<div class="row g-4 mx-2 mt-2 mt-md-4">

    {{-- Order Overview --}}
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm h-100">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">#</th>
                            <th>Order</th>
                            <th class="d-none d-md-table-cell">Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentOrders as $order)

                            <tr>

                                {{-- # --}}
                                <td class="d-none d-sm-table-cell">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Order --}}
                                <td>
                                    <div>
                                        <div class="fw-semibold">
                                            #{{ $order->order_number }}
                                        </div>

                                        @if($order->book)
                                            <small class="text-muted">
                                                {{ $order->book->title }}
                                            </small>
                                        @endif
                                    </div>
                                </td>

                                {{-- Customer --}}
                                <td class="d-none d-md-table-cell">
                                    {{ $order->user->name ?? $order->full_name }}
                                </td>

                                {{-- Total --}}
                                <td>
                                    {{ number_format($order->total_price, 2) }} AZN
                                </td>

                                {{-- Status --}}
                                <td>

                                    @if($order->order_status === 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @elseif($order->order_status === 'processing')

                                        <span class="badge bg-primary">
                                            Processing
                                        </span>

                                    @elseif($order->order_status === 'shipped')

                                        <span class="badge bg-info text-dark">
                                            Shipped
                                        </span>

                                    @elseif($order->order_status === 'delivered')

                                        <span class="badge bg-success">
                                            Delivered
                                        </span>

                                    @elseif($order->order_status === 'cancelled')

                                        <span class="badge bg-danger">
                                            Cancelled
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ ucfirst($order->order_status) }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-4">

                                    <div class="text-muted">

                                        <i class="bi bi-cart-x fs-3 d-block mb-2"></i>

                                        No orders found.

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>


    {{-- Quick Actions --}}
    <div class="col-12 col-lg-4">

        <div class="card shadow-sm h-100">

            <div class="card-header bg-white fw-semibold">
                Quick Actions
            </div>

            <div class="card-body d-grid gap-3">

                <a href="{{ route('admin.books.create') }}"
                   class="btn btn-primary">
                    Add Book
                </a>

                <a href="{{ route('admin.categories.create') }}"
                   class="btn btn-success">
                    Add Category
                </a>

                <a href="{{ route('admin.authors.create') }}"
                   class="btn btn-warning">
                    Add Author
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-dark">
                    View Users
                </a>

            </div>

        </div>

    </div>

</div>

</div>

@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('monthlyOverviewChart');

    if (!canvas) {
        console.log('Monthly Overview canvas not found.');
        return;
    }

    const monthlyLabels = @json($monthlyLabels);
    const monthlyOrders = @json($monthlyOrders);
    const monthlyRevenue = @json($monthlyRevenue);

    console.log('Labels:', monthlyLabels);
    console.log('Orders:', monthlyOrders);
    console.log('Revenue:', monthlyRevenue);

    new Chart(canvas, {

        type: 'line',

        data: {
            labels: monthlyLabels,

            datasets: [
                {
                    label: 'Orders',
                    data: monthlyOrders,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    yAxisID: 'orders'
                },

                {
                    label: 'Revenue',
                    data: monthlyRevenue,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    yAxisID: 'revenue'
                }
            ]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },

            scales: {

                orders: {
                    type: 'linear',
                    position: 'left',
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                },

                revenue: {
                    type: 'linear',
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false
                    }
                }

            }

        }

    });

});
</script>

@endpush