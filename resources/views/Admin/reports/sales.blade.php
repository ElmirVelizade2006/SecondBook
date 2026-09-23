@extends('layout.admin.master')

@section('title', 'Sales Report')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/reports.css') }}">
@endpush

@section('content')

<div class="dashboard-section reports-page">

    {{-- Header --}}
    <div class="dashboard-panel reports-header-panel">

        <div class="reports-header-content">

            <div>
                <h5>Sales Report</h5>
                <p>Analyze delivered orders and revenue performance</p>
            </div>

            <div class="reports-header-actions">

                <a href="{{ route('admin.reports.index') }}"
                   class="reports-back-btn">
                    <i class="bi bi-arrow-left"></i>
                    Back to Reports
                </a>

            </div>

        </div>

    </div>


    {{-- Date Filter --}}
    <div class="dashboard-panel reports-filter-panel">

        <form method="GET"
              action="{{ route('admin.reports.sales') }}">

            <div class="reports-filter-row">

                <div class="reports-filter-group">

                    <label for="start_date">
                        Start Date
                    </label>

                    <input type="date"
                           id="start_date"
                           name="start_date"
                           value="{{ request('start_date', $startDate->format('Y-m-d')) }}">

                </div>


                <div class="reports-filter-group">

                    <label for="end_date">
                        End Date
                    </label>

                    <input type="date"
                           id="end_date"
                           name="end_date"
                           value="{{ request('end_date', $endDate->format('Y-m-d')) }}">

                </div>


                <div class="reports-filter-actions">

                    <button type="submit"
                            class="reports-filter-btn">

                        <i class="bi bi-funnel"></i>
                        Apply

                    </button>


                    <a href="{{ route('admin.reports.sales') }}"
                       class="reports-reset-btn">

                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Statistics --}}
    <div class="reports-stats-grid">

        {{-- Total Orders --}}
        <div class="reports-stat-card">

            <div class="reports-stat-icon reports-icon-orders">
                <i class="bi bi-bag-check"></i>
            </div>

            <div class="reports-stat-content">

                <span>Total Orders</span>

                <strong>
                    {{ number_format($totalOrders) }}
                </strong>

            </div>

        </div>


        {{-- Revenue --}}
        <div class="reports-stat-card">

            <div class="reports-stat-icon reports-icon-revenue">
                <i class="bi bi-currency-dollar"></i>
            </div>

            <div class="reports-stat-content">

                <span>Total Revenue</span>

                <strong>
                    ${{ number_format($totalRevenue, 2) }}
                </strong>

            </div>

        </div>


        {{-- Books Sold --}}
        <div class="reports-stat-card">

            <div class="reports-stat-icon reports-icon-books">
                <i class="bi bi-book"></i>
            </div>

            <div class="reports-stat-content">

                <span>Books Sold</span>

                <strong>
                    {{ number_format($booksSold) }}
                </strong>

            </div>

        </div>


        {{-- Average Order --}}
        <div class="reports-stat-card">

            <div class="reports-stat-icon reports-icon-users">
                <i class="bi bi-calculator"></i>
            </div>

            <div class="reports-stat-content">

                <span>Average Order</span>

                <strong>
                    ${{ number_format($averageOrderValue, 2) }}
                </strong>

            </div>

        </div>

    </div>


    {{-- Sales Table --}}
    <div class="dashboard-panel reports-panel reports-orders-panel">

        <div class="reports-panel-header">

            <div>

                <h5>Sales</h5>

                <p>
                    Delivered orders during the selected period
                </p>

            </div>

        </div>


        <div class="reports-table-wrapper">

            <table class="reports-table">

                <thead>

                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Book</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Date</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($orders as $order)

                        <tr>

                            <td>

                                <span class="reports-order-number">
                                    {{ $order->order_number }}
                                </span>

                            </td>


                            <td>
                                {{ $order->user?->name ?? 'Unknown' }}
                            </td>


                            <td>

                                <span class="reports-book-name">
                                    {{ $order->book?->title ?? 'Unknown Book' }}
                                </span>

                            </td>


                            <td>
                                {{ $order->quantity }}
                            </td>


                            <td>

                                <strong>
                                    ${{ number_format($order->total_price, 2) }}
                                </strong>

                            </td>


                            <td>

                                {{ ucwords(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $order->payment_method ?? 'N/A'
                                    )
                                ) }}

                            </td>


                            <td>

                                {{ $order->created_at?->format('d M Y') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="reports-table-empty">
                                    No sales found for this period.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($orders->hasPages())

            <div class="reports-pagination">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

</div>

@endsection