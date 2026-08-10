@extends('layout.admin.master')

@section('title', 'Coupons')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/coupons.css') }}">
@endpush

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

<div class="container-fluid p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

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

        <div class="col-xl-3 col-md-6">

            <div class="coupon-card">

                <div>
                    <span>Total Coupons</span>
                    <h3>{{ $totalCoupons }}</h3>
                </div>

                <i class="bi bi-ticket-perforated"></i>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="coupon-card">

                <div>
                    <span>Active</span>
                    <h3>{{ $activeCoupons }}</h3>
                </div>

                <i class="bi bi-check-circle"></i>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="coupon-card">

                <div>
                    <span>Expired</span>
                    <h3>{{ $expiredCoupons }}</h3>
                </div>

                <i class="bi bi-clock-history"></i>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="coupon-card">

                <div>
                    <span>Total Used</span>
                    <h3>{{ $totalUsed }}</h3>
                </div>

                <i class="bi bi-people"></i>

            </div>

        </div>

    </div>


    {{-- Filters --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.coupons.index') }}">

                <div class="row g-3">

                    <div class="col-lg-4">

                        <input type="text"
                               name="search"
                               class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Search coupon code...">

                    </div>


                    <div class="col-lg-3">

                        <select name="type"
                                class="form-select">

                            <option value="">
                                Discount Type
                            </option>

                            <option value="percentage"
                                {{ request('type') == 'percentage' ? 'selected' : '' }}>
                                Percentage
                            </option>

                            <option value="fixed"
                                {{ request('type') == 'fixed' ? 'selected' : '' }}>
                                Fixed Amount
                            </option>

                        </select>

                    </div>


                    <div class="col-lg-3">

                        <select name="status"
                                class="form-select">

                            <option value="">
                                Status
                            </option>

                            <option value="1"
                                {{ request('status') === '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    <div class="col-lg-2">

                        <button class="btn btn-dark w-100">

                            <i class="bi bi-search"></i>

                            Filter

                        </button>

                    </div>

                </div>

            </form>

        </div>

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

                                <td>
                                    {{ $coupon->id }}
                                </td>


                                <td>

                                    <span class="coupon-code">
                                        {{ $coupon->code }}
                                    </span>

                                </td>


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


                                <td>

                                    ${{ number_format(
                                        $coupon->minimum_order_amount,
                                        2
                                    ) }}

                                </td>


                                <td>

                                    {{ $coupon->used_count }}

                                    /

                                    {{ $coupon->usage_limit ?? '∞' }}

                                </td>


                                <td>

                                    <div class="fw-semibold">
                                        {{ $coupon->starts_at->format('d M Y') }}
                                    </div>

                                    <small class="text-muted">
                                        to
                                        {{ $coupon->expires_at->format('d M Y') }}
                                    </small>

                                </td>


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


                                        {{-- Toggle --}}
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