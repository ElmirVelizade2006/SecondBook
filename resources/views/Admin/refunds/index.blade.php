@extends('layout.admin.master')

@section('title', 'Refunds')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/refunds.css') }}">
@endpush

@section('content')

<div class="dashboard-section refunds-page">

    {{-- =========================================================
        HERO
    ========================================================= --}}

    <div class="refunds-hero mb-4">
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

        <div class="refunds-hero-mark">
            <i class="bi bi-arrow-counterclockwise"></i>
        </div>

        <a
            href="{{ route('admin.refunds.create') }}"
            class="refunds-hero-button"
        >
            <i class="bi bi-plus-lg"></i>
            <span>Add Refund</span>
        </a>
    </div>


    {{-- =========================================================
        ALERTS
    ========================================================= --}}

    @if(session('success'))
        <div class="refund-alert refund-alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="refund-alert refund-alert-danger">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif


    {{-- =========================================================
        STATISTICS
    ========================================================= --}}

    <div class="row g-4 mb-4">

        {{-- Total --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="refund-stat-card stat-blue">

                <div class="refund-stat-content">
                    <span>Total refunds</span>
                    <strong>{{ number_format($stats['total']) }}</strong>
                </div>

                <div class="refund-stat-icon">
                    <i class="bi bi-receipt"></i>
                </div>

            </div>
        </div>


        {{-- Pending --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="refund-stat-card stat-orange">

                <div class="refund-stat-content">
                    <span>Pending</span>
                    <strong>{{ number_format($stats['pending']) }}</strong>
                </div>

                <div class="refund-stat-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

            </div>
        </div>


        {{-- Processed --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="refund-stat-card stat-green">

                <div class="refund-stat-content">
                    <span>Processed</span>
                    <strong>{{ number_format($stats['processed']) }}</strong>
                </div>

                <div class="refund-stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>

            </div>
        </div>


        {{-- Amount --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="refund-stat-card stat-purple">

                <div class="refund-stat-content">
                    <span>Refunded amount</span>

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

        {{-- Header --}}
        <div class="panel-header refunds-panel-header">

            <div>
                <span class="eyebrow">
                    Refund directory
                </span>

                <h5>All refunds</h5>

                <p>
                    Review refund requests, decisions, and processed payments.
                </p>
            </div>

        </div>


        {{-- =====================================================
            FILTERS
        ===================================================== --}}

        <form
            method="GET"
            action="{{ route('admin.refunds.index') }}"
            class="refund-filters"
        >

            {{-- Search --}}
            <div class="refund-search">

                <i class="bi bi-search"></i>

                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search refund, order or customer..."
                    aria-label="Search refunds"
                >

            </div>


            {{-- Status --}}
            <select
                name="status"
                class="form-select refund-select"
                aria-label="Filter by status"
            >
                <option value="">All statuses</option>

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


            {{-- Sort --}}
            <select
                name="sort"
                class="form-select refund-select"
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
                    Highest amount
                </option>

                <option
                    value="lowest"
                    @selected($sort === 'lowest')
                >
                    Lowest amount
                </option>
            </select>


            {{-- Filter --}}
            <button
                type="submit"
                class="btn btn-primary refund-filter-button"
            >
                <i class="bi bi-funnel"></i>
                <span>Filter</span>
            </button>


            {{-- Reset --}}
            @if($search || $status || $sort !== 'newest')
                <a
                    href="{{ route('admin.refunds.index') }}"
                    class="refund-reset-button"
                >
                    <i class="bi bi-arrow-counterclockwise"></i>
                    <span>Reset</span>
                </a>
            @endif

        </form>


        {{-- =====================================================
            TABLE
        ===================================================== --}}

        <div class="table-responsive refunds-table-wrap">

            <table class="table refunds-table align-middle">

                <colgroup>
                    <col class="refund-col-number">
                    <col class="refund-col-order">
                    <col class="refund-col-customer">
                    <col class="refund-col-amount">
                    <col class="refund-col-reason">
                    <col class="refund-col-status">
                    <col class="refund-col-date">
                    <col class="refund-col-actions">
                </colgroup>

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

                                <div class="refund-number-cell">

                                    <div class="refund-number-icon">
                                        <i class="bi bi-receipt"></i>
                                    </div>

                                    <div>
                                        <strong>
                                            {{ $refund->refund_number }}
                                        </strong>

                                        <small>
                                            Refund request
                                        </small>
                                    </div>

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

                                <div class="refund-customer-cell">

                                    <div class="refund-customer-avatar">
                                        {{ strtoupper(
                                            substr(
                                                $refund->user?->name ?? 'U',
                                                0,
                                                1
                                            )
                                        ) }}
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

                                <span
                                    class="refund-status status-{{ $refund->status }}"
                                >
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
                                        title="View refund"
                                        aria-label="View refund"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    @if($refund->status !== 'processed')

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.refunds.edit', $refund) }}"
                                            class="refund-action-btn action-edit"
                                            title="Edit refund"
                                            aria-label="Edit refund"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- Pending --}}
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
                                                    title="Approve refund"
                                                    aria-label="Approve refund"
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
                                                    title="Reject refund"
                                                    aria-label="Reject refund"
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
                                                    title="Process refund"
                                                    aria-label="Process refund"
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
                                                title="Delete refund"
                                                aria-label="Delete refund"
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
                                        <i class="bi bi-plus-lg me-2"></i>
                                        Create refund
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


@push('js')

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-refund-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            Swal.fire({
                title: 'Delete refund?',
                text: 'Are you sure you want to permanently delete this refund?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete refund',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#bd3d53',
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