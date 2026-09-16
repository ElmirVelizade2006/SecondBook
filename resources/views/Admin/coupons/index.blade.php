@extends('layout.admin.master')

@section('title', 'Coupons')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/coupons.css') }}">
@endpush

@section('content')

<div class="container-fluid p-4">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>

        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4"
             role="alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>

        </div>
    @endif


    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4"
         style="flex-wrap: wrap; gap: 10px;">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-ticket-perforated me-2"></i>

                Coupons

            </h2>

            <p class="text-muted mb-0">
                Manage discount coupons and promotional offers.
            </p>

        </div>


        <a href="{{ route('admin.coupons.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg me-2"></i>

            Add Coupon

        </a>

    </div>


    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        {{-- Total Coupons --}}
        <div class="col-xl-3 col-md-6">

            <div class="coupon-card">

                <div>

                    <span>Total Coupons</span>

                    <h3>
                        {{ $totalCoupons }}
                    </h3>

                </div>

                <i class="bi bi-ticket-perforated"></i>

            </div>

        </div>


        {{-- Active --}}
        <div class="col-xl-3 col-md-6">

            <div class="coupon-card">

                <div>

                    <span>Active</span>

                    <h3>
                        {{ $activeCoupons }}
                    </h3>

                </div>

                <i class="bi bi-check-circle"></i>

            </div>

        </div>


        {{-- Expired --}}
        <div class="col-xl-3 col-md-6">

            <div class="coupon-card">

                <div>

                    <span>Expired</span>

                    <h3>
                        {{ $expiredCoupons }}
                    </h3>

                </div>

                <i class="bi bi-clock-history"></i>

            </div>

        </div>


        {{-- Total Used --}}
        <div class="col-xl-3 col-md-6">

            <div class="coupon-card">

                <div>

                    <span>Total Used</span>

                    <h3>
                        {{ $totalUsed }}
                    </h3>

                </div>

                <i class="bi bi-people"></i>

            </div>

        </div>

    </div>


    {{-- Filters --}}
    <div class="dashboard-panel mb-4">

        <form method="GET"
              action="{{ route('admin.coupons.index') }}"
              class="row g-3 align-items-end">


            {{-- Search --}}
            <div class="col-12 col-md-6 col-lg-4">

                <label class="form-label small text-muted fw-semibold">
                    Search
                </label>

                <div class="input-group">

                    <span class="input-group-text bg-white border-end-0">

                        <i class="bi bi-search text-muted"></i>

                    </span>


                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control border-start-0"
                           placeholder="Search coupon code...">


                    <button type="submit"
                            class="btn btn-primary">

                        Search

                    </button>

                </div>

            </div>


            {{-- Discount Type --}}
            <div class="col-6 col-md-3 col-lg-2">

                <label class="form-label small text-muted fw-semibold">
                    Type
                </label>

                <select name="type"
                        class="form-select">

                    <option value="">
                        All Types
                    </option>

                    <option value="percentage"
                        @selected(request('type') === 'percentage')>

                        Percentage

                    </option>

                    <option value="fixed"
                        @selected(request('type') === 'fixed')>

                        Fixed Amount

                    </option>

                </select>

            </div>


            {{-- Status --}}
            <div class="col-6 col-md-3 col-lg-2">

                <label class="form-label small text-muted fw-semibold">
                    Status
                </label>

                <select name="status"
                        class="form-select">

                    <option value="">
                        All Status
                    </option>

                    <option value="1"
                        @selected(request('status') === '1')>

                        Active

                    </option>

                    <option value="0"
                        @selected(request('status') === '0')>

                        Inactive

                    </option>

                </select>

            </div>


            {{-- Filter Buttons --}}
            <div class="col-12 col-md-6 col-lg-4 coupon-filter-buttons">

                <button type="submit"
                        class="btn btn-primary filter-btn">

                    <i class="bi bi-funnel me-1"></i>

                    <span>
                        Filter
                    </span>

                </button>


                <a href="{{ route('admin.coupons.index') }}"
                   class="btn reset-btn">

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- Coupons Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Code</th>

                            <th>Discount</th>

                            <th>Minimum Order</th>

                            <th>Usage</th>

                            <th>Validity</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($coupons as $coupon)

                            <tr>

                                {{-- ID --}}
                                <td>
                                    {{ $coupon->id }}
                                </td>


                                {{-- Code --}}
                                <td>

                                    <span class="coupon-code">
                                        {{ $coupon->code }}
                                    </span>

                                </td>


                                {{-- Discount --}}
                                <td>

                                    @if($coupon->type === 'percentage')

                                        <span class="fw-semibold">
                                            {{ number_format($coupon->value, 0) }}%
                                        </span>

                                    @else

                                        <span class="fw-semibold">
                                            ${{ number_format($coupon->value, 2) }}
                                        </span>

                                    @endif

                                </td>


                                {{-- Minimum Order --}}
                                <td>

                                    ${{ number_format(
                                        $coupon->minimum_order_amount,
                                        2
                                    ) }}

                                </td>


                                {{-- Usage --}}
                                <td>

                                    {{ $coupon->used_count }}

                                    /

                                    {{ $coupon->usage_limit ?? '∞' }}

                                </td>


                                {{-- Validity --}}
                                <td>

                                    <div class="fw-semibold">

                                        {{ $coupon->starts_at->format('d M Y') }}

                                    </div>

                                    <small class="text-muted">

                                        to

                                        {{ $coupon->expires_at->format('d M Y') }}

                                    </small>

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if(!$coupon->status)

                                        <span class="badge bg-secondary">
                                            Inactive
                                        </span>

                                    @elseif($coupon->expires_at->isPast())

                                        <span class="badge bg-danger">
                                            Expired
                                        </span>

                                    @elseif($coupon->starts_at->isFuture())

                                        <span class="badge bg-warning text-dark">
                                            Scheduled
                                        </span>

                                    @else

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="coupon-actions">


                                        {{-- View --}}
                                        <a href="{{ route(
                                            'admin.coupons.show',
                                            $coupon->id
                                        ) }}"
                                           class="btn btn-sm btn-light"
                                           title="View">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route(
                                            'admin.coupons.edit',
                                            $coupon->id
                                        ) }}"
                                           class="btn btn-sm btn-light"
                                           title="Edit">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- Toggle Status --}}
                                        <form action="{{ route(
                                            'admin.coupons.toggle-status',
                                            $coupon->id
                                        ) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf

                                            @method('PATCH')


                                            <button type="submit"
                                                    class="btn btn-sm btn-light"
                                                    title="Toggle Status">

                                                @if($coupon->status)

                                                    <i class="bi bi-toggle-on text-success"></i>

                                                @else

                                                    <i class="bi bi-toggle-off text-secondary"></i>

                                                @endif

                                            </button>

                                        </form>


                                        {{-- Delete --}}
                                        <form action="{{ route(
                                            'admin.coupons.destroy',
                                            $coupon->id
                                        ) }}"
                                              method="POST"
                                              class="d-inline delete-coupon-form">

                                            @csrf

                                            @method('DELETE')


                                            <button type="submit"
                                                    class="btn btn-sm btn-danger delete-coupon-btn"
                                                    title="Delete">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="text-center text-muted py-4">

                                    No coupons found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            <div class="mt-3">

                {{ $coupons->links() }}

            </div>

        </div>

    </div>

</div>


{{-- Delete Confirmation --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const deleteForms =
        document.querySelectorAll('.delete-coupon-form');


    deleteForms.forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();


            Swal.fire({

                title: 'Are you sure?',

                text: 'This coupon will be permanently deleted.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Yes, delete it!',

                cancelButtonText: 'Cancel'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

});

</script>

@endsection