@extends('layout.admin.master')

@section('title', 'Refunds')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/refunds.css') }}">
@endpush

@section('content')

<div class="dashboard-section refunds-page">

    {{-- =========================================================
        ALERTS
    ========================================================= --}}
    @if(session('success'))
        <div class="alert alert-success refund-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger refund-alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif


    {{-- =========================================================
        HERO
    ========================================================= --}}
    <div class="refunds-hero">

        <div class="refunds-hero-content">

            <span class="hero-badge">
                <i class="bi bi-arrow-counterclockwise"></i>
                Payments Recovery
            </span>

            <h1>Refunds</h1>

            <p>
                Manage customer refund requests, review decisions,
                and track returned payments.
            </p>

        </div>

        <div class="refunds-hero-action">
            <a href="{{ route('admin.refunds.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i>
                <span>Add Refund</span>
            </a>
        </div>

    </div>


    {{-- =========================================================
        STATISTICS
    ========================================================= --}}
    <div class="row g-4 refund-stats">

        {{-- Total --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="refund-stat">

                <div class="refund-stat-content">
                    <span>Total Refunds</span>
                    <strong>{{ $stats['total'] }}</strong>
                </div>

                <div class="refund-stat-icon">
                    <i class="bi bi-receipt"></i>
                </div>

            </div>
        </div>


        {{-- Pending --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="refund-stat stat-orange">

                <div class="refund-stat-content">
                    <span>Pending</span>
                    <strong>{{ $stats['pending'] }}</strong>
                </div>

                <div class="refund-stat-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

            </div>
        </div>


        {{-- Processed --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="refund-stat stat-green">

                <div class="refund-stat-content">
                    <span>Processed</span>
                    <strong>{{ $stats['processed'] }}</strong>
                </div>

                <div class="refund-stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>

            </div>
        </div>


        {{-- Amount --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="refund-stat stat-purple">

                <div class="refund-stat-content">
                    <span>Refunded Amount</span>
                    <strong>
                        ${{ number_format($stats['amount'], 2) }}
                    </strong>
                </div>

                <div class="refund-stat-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>

            </div>
        </div>

    </div>


    {{-- =========================================================
        REFUND DIRECTORY
    ========================================================= --}}
    <div class="dashboard-panel refunds-panel">

        {{-- Panel Header --}}
        <div class="panel-header refunds-panel-header">

            <div class="refunds-panel-title">

                <span class="eyebrow">
                    Refund Directory
                </span>

                <h5>All Refunds</h5>

                <p>
                    Review refund requests, decisions,
                    and processed payments.
                </p>

            </div>

        </div>


        {{-- =====================================================
            FILTERS
        ===================================================== --}}
        <form method="GET" class="refund-filters">

            {{-- Search --}}
            <div class="refund-search">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search refund, order or customer..."
                    aria-label="Search refunds"
                >

            </div>


            {{-- Status --}}
            <div class="refund-filter-select">

                <select
                    name="status"
                    class="form-select"
                    aria-label="Filter by status"
                >
                    <option value="">All Statuses</option>

                    @foreach([
                        'pending',
                        'approved',
                        'rejected',
                        'processed',
                        'cancelled'
                    ] as $item)

                        <option
                            value="{{ $item }}"
                            @selected($status === $item)
                        >
                            {{ ucfirst($item) }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Sort --}}
            <div class="refund-filter-select">

                <select
                    name="sort"
                    class="form-select"
                    aria-label="Sort refunds"
                >
                    <option
                        value="newest"
                        @selected($sort === 'newest')
                    >
                        Newest
                    </option>

                    <option
                        value="oldest"
                        @selected($sort === 'oldest')
                    >
                        Oldest
                    </option>

                    <option
                        value="highest"
                        @selected($sort === 'highest')
                    >
                        Highest Amount
                    </option>

                    <option
                        value="lowest"
                        @selected($sort === 'lowest')
                    >
                        Lowest Amount
                    </option>

                </select>

            </div>


            {{-- Filter --}}
            <button type="submit" class="btn btn-primary refund-filter-btn">
                <i class="bi bi-funnel"></i>
                <span>Filter</span>
            </button>


            {{-- Reset --}}
            <a
                href="{{ route('admin.refunds.index') }}"
                class="refund-reset"
            >
                <i class="bi bi-arrow-counterclockwise"></i>
                Reset
            </a>

        </form>


        {{-- =====================================================
            TABLE
        ===================================================== --}}
        <div class="table-responsive refunds-table-wrap">

            <table class="table refunds-table align-middle">

                <thead>
                    <tr>
                        <th>Refund</th>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Requested</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($refunds as $refund)

                        <tr>

                            {{-- Refund --}}
                            <td>
                                <div class="refund-number">
                                    <span class="refund-number-icon">
                                        <i class="bi bi-receipt"></i>
                                    </span>

                                    <strong>
                                        {{ $refund->refund_number }}
                                    </strong>
                                </div>
                            </td>


                            {{-- Order --}}
                            <td>
                                <span class="refund-order-number">
                                    #{{ $refund->order?->order_number ?? '-' }}
                                </span>
                            </td>


                            {{-- Customer --}}
                            <td>

                                <div class="refund-customer">

                                    <div class="refund-customer-avatar">
                                        <i class="bi bi-person"></i>
                                    </div>

                                    <div class="refund-customer-info">

                                        <strong>
                                            {{ $refund->user?->name ?? '-' }}
                                        </strong>

                                        @if($refund->user?->email)
                                            <small>
                                                {{ $refund->user->email }}
                                            </small>
                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Amount --}}
                            <td>
                                <strong class="refund-amount">
                                    ${{ number_format($refund->amount, 2) }}
                                </strong>
                            </td>


                            {{-- Reason --}}
                            <td>

                                <span
                                    class="refund-reason"
                                    title="{{ $refund->reason }}"
                                >
                                    {{ $refund->reason }}
                                </span>

                            </td>


                            {{-- Status --}}
                            <td>

                                <span class="refund-status status-{{ $refund->status }}">

                                    <i class="bi bi-circle-fill"></i>

                                    {{ ucfirst($refund->status) }}

                                </span>

                            </td>


                            {{-- Requested --}}
                            <td>

                                <span class="refund-date">
                                    {{ $refund->requested_at?->format('d M Y') ?? '-' }}
                                </span>

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="refund-actions">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.refunds.show', $refund) }}"
                                        class="refund-action-btn action-view"
                                        title="View Refund"
                                        aria-label="View Refund"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    @if($refund->status !== 'processed')

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.refunds.edit', $refund) }}"
                                            class="refund-action-btn action-edit"
                                            title="Edit Refund"
                                            aria-label="Edit Refund"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- Pending Actions --}}
                                        @if($refund->status === 'pending')

                                            {{-- Approve --}}
                                            <form
                                                method="POST"
                                                action="{{ route('admin.refunds.status', $refund) }}"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <input
                                                    type="hidden"
                                                    name="status"
                                                    value="approved"
                                                >

                                                <button
                                                    type="submit"
                                                    class="refund-action-btn action-approve"
                                                    title="Approve Refund"
                                                    aria-label="Approve Refund"
                                                >
                                                    <i class="bi bi-check-lg"></i>
                                                </button>

                                            </form>


                                            {{-- Reject --}}
                                            <form
                                                method="POST"
                                                action="{{ route('admin.refunds.status', $refund) }}"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <input
                                                    type="hidden"
                                                    name="status"
                                                    value="rejected"
                                                >

                                                <button
                                                    type="submit"
                                                    class="refund-action-btn action-reject"
                                                    title="Reject Refund"
                                                    aria-label="Reject Refund"
                                                >
                                                    <i class="bi bi-x-lg"></i>
                                                </button>

                                            </form>

                                        @elseif($refund->status === 'approved')

                                            {{-- Process --}}
                                            <form
                                                method="POST"
                                                action="{{ route('admin.refunds.status', $refund) }}"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <input
                                                    type="hidden"
                                                    name="status"
                                                    value="processed"
                                                >

                                                <button
                                                    type="submit"
                                                    class="refund-action-btn action-process"
                                                    title="Process Refund"
                                                    aria-label="Process Refund"
                                                >
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>

                                            </form>

                                        @endif


                                        {{-- Delete --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.refunds.destroy', $refund) }}"
                                            class="delete-refund-form"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="refund-action-btn action-delete"
                                                title="Delete Refund"
                                                aria-label="Delete Refund"
                                            >
                                                <i class="bi bi-trash3"></i>
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8">

                                <div class="refund-empty">

                                    <div class="refund-empty-icon">
                                        <i class="bi bi-receipt"></i>
                                    </div>

                                    <strong>No refunds found</strong>

                                    <span>
                                        There are no refund records matching
                                        your current filters.
                                    </span>

                                    <a
                                        href="{{ route('admin.refunds.create') }}"
                                        class="btn btn-primary"
                                    >
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Create Refund
                                    </a>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
            PAGINATION
        ===================================================== --}}
        @if($refunds->hasPages())

            <div class="refund-pagination">
                {{ $refunds->links() }}
            </div>

        @endif

    </div>

</div>

@endsection


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}
@push('js')

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-refund-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            Swal.fire({
                title: 'Delete refund?',
                text: 'Are you sure you want to delete this refund?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc3545',
                reverseButtons: true
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

