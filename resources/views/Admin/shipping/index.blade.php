@extends('layout.admin.master')

@section('title', 'Shipping')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/shipping.css') }}">
@endpush

@section('content')

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif


    {{-- Error Alert --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif


    <div class="container-fluid p-4">

        {{-- =====================================================
             HEADER
        ====================================================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">
                    <i class="bi bi-truck me-2"></i>
                    Shipping
                </h2>

                <p class="text-muted mb-0">
                    Manage shipping methods and delivery options.
                </p>

            </div>


            <a href="{{ route('admin.shipping.create') }}"
               class="btn btn-primary shipping-add-btn">

                <i class="bi bi-plus-lg me-2"></i>
                Add Shipping

            </a>

        </div>


        {{-- =====================================================
             STATISTICS
        ====================================================== --}}
        <div class="row g-4 mb-4">

            {{-- Total Shipping --}}
            <div class="col-xl-3 col-md-6">

                <div class="shipping-card">

                    <div>

                        <span>
                            Total Shipping
                        </span>

                        <h3>
                            {{ $totalShippings }}
                        </h3>

                    </div>

                    <i class="bi bi-truck"></i>

                </div>

            </div>


            {{-- Active --}}
            <div class="col-xl-3 col-md-6">

                <div class="shipping-card">

                    <div>

                        <span>
                            Active
                        </span>

                        <h3>
                            {{ $activeShippings }}
                        </h3>

                    </div>

                    <i class="bi bi-check-circle"></i>

                </div>

            </div>


            {{-- Inactive --}}
            <div class="col-xl-3 col-md-6">

                <div class="shipping-card">

                    <div>

                        <span>
                            Inactive
                        </span>

                        <h3>
                            {{ $inactiveShippings }}
                        </h3>

                    </div>

                    <i class="bi bi-pause-circle"></i>

                </div>

            </div>


            {{-- Free Shipping --}}
            <div class="col-xl-3 col-md-6">

                <div class="shipping-card">

                    <div>

                        <span>
                            Free Shipping
                        </span>

                        <h3>
                            {{ $freeShippings }}
                        </h3>

                    </div>

                    <i class="bi bi-gift"></i>

                </div>

            </div>

        </div>


        {{-- =====================================================
             FILTERS
        ====================================================== --}}
        <div class="dashboard-panel shipping-filter-panel mb-4">

            <form method="GET"
                  action="{{ route('admin.shipping.index') }}"
                  class="row g-3 align-items-end">


                {{-- Search --}}
                <div class="col-12 col-md-6 col-lg-5">

                    <label class="form-label small text-muted fw-semibold">
                        Search
                    </label>

                    <div class="input-group shipping-search-group">

                        <span class="input-group-text bg-white border-end-0">

                            <i class="bi bi-search text-muted"></i>

                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control border-start-0"
                            placeholder="Search shipping method..."
                        >

                        <button type="submit"
                                class="btn btn-primary">

                            Search

                        </button>

                    </div>

                </div>


                {{-- Status --}}
                <div class="col-12 col-md-6 col-lg-4">

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
                <div class="col-12 col-lg-3 shipping-filter-buttons">

                    <button type="submit"
                            class="btn btn-primary filter-btn">

                        <i class="bi bi-funnel me-1"></i>

                        <span>
                            Filter
                        </span>

                    </button>

                    
                    <a href="{{ route('admin.shipping.index') }}"
                       class="btn btn-light reset-btn">

                        Reset

                    </a>

                </div>

            </form>

        </div>


        {{-- =====================================================
             SHIPPING TABLE
        ====================================================== --}}
        <div class="card border-0 shadow-sm shipping-table-card">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Method
                                </th>

                                <th>
                                    Description
                                </th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Delivery Time
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($shippings as $shipping)

                                <tr>

                                    {{-- ID --}}
                                    <td>
                                        {{ $shipping->id }}
                                    </td>


                                    {{-- Method --}}
                                    <td>

                                        <span class="shipping-name">
                                            {{ $shipping->name }}
                                        </span>

                                    </td>


                                    {{-- Description --}}
                                    <td>

                                        <span class="text-muted">
                                            {{ Str::limit($shipping->description, 50) ?: '—' }}
                                        </span>

                                    </td>


                                    {{-- Price --}}
                                    <td>

                                        @if($shipping->price == 0)

                                            <span class="fw-semibold text-success">
                                                Free
                                            </span>

                                        @else

                                            <span class="fw-semibold">
                                                {{ number_format($shipping->price, 2) }} AZN
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Delivery Time --}}
                                    <td>

                                        {{ $shipping->delivery_time }}

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($shipping->status)

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        <div class="shipping-actions">

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.shipping.edit', $shipping->id) }}"
                                               class="btn btn-sm btn-light"
                                               title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('admin.shipping.destroy', $shipping->id) }}"
                                                  method="POST"
                                                  class="d-inline delete-shipping-form">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger delete-shipping-btn"
                                                        title="Delete">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="7"
                                        class="text-center py-5">

                                        <div class="shipping-empty-state">

                                            <i class="bi bi-truck fs-1 d-block mb-2"></i>

                                            <div class="fw-semibold">
                                                No shipping methods found.
                                            </div>

                                            <small>
                                                Try changing your filters or search.
                                            </small>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if($shippings->hasPages())

                    <div class="mt-3">

                        {{ $shippings->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
         DELETE CONFIRMATION
    ====================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const deleteForms =
                document.querySelectorAll('.delete-shipping-form');


            deleteForms.forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    event.preventDefault();


                    Swal.fire({

                        title: 'Are you sure?',

                        text: 'This shipping method will be permanently deleted.',

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