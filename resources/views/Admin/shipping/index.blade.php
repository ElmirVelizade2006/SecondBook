@extends('layout.admin.master')

@section('title', 'Shipping')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/shipping.css') }}">
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
                <i class="bi bi-truck me-2"></i>
                Shipping
            </h2>

            <p class="text-muted mb-0">
                Manage shipping methods and delivery options.
            </p>
        </div>

        <a href="{{ route('admin.shipping.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg me-2"></i>
            Add Shipping
        </a>

    </div>


    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="shipping-card">
                <div>
                    <span>Total Shipping</span>
                    <h3>{{ $totalShippings }}</h3>
                </div>

                <i class="bi bi-truck"></i>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="shipping-card">
                <div>
                    <span>Active</span>
                    <h3>{{ $activeShippings }}</h3>
                </div>

                <i class="bi bi-check-circle"></i>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="shipping-card">
                <div>
                    <span>Inactive</span>
                    <h3>{{ $inactiveShippings }}</h3>
                </div>

                <i class="bi bi-pause-circle"></i>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="shipping-card">
                <div>
                    <span>Free Shipping</span>
                    <h3>{{ $freeShippings }}</h3>
                </div>

                <i class="bi bi-gift"></i>
            </div>
        </div>

    </div>


    {{-- Filters --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.shipping.index') }}">

                <div class="row g-3">

                    <div class="col-lg-5">

                        <input type="text"
                               name="search"
                               class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Search shipping method...">

                    </div>


                    <div class="col-lg-4">

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


                    <div class="col-lg-3">

                        <button class="btn btn-dark w-100">

                            <i class="bi bi-search"></i>
                            Filter

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Shipping Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Method</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Delivery Time</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>


                    <tbody>

                    @forelse($shippings as $shipping)

                        <tr>

                            <td>
                                {{ $shipping->id }}
                            </td>


                            <td>
                                <span class="shipping-name">
                                    {{ $shipping->name }}
                                </span>
                            </td>


                            <td>
                                <span class="text-muted">
                                    {{ Str::limit($shipping->description, 50) ?: '—' }}
                                </span>
                            </td>


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


                            <td>
                                {{ $shipping->delivery_time }}
                            </td>


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
                                class="text-center text-muted py-4">

                                No shipping methods found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">
                {{ $shippings->links() }}
            </div>

        </div>

    </div>

</div>


{{-- Delete Confirmation --}}
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