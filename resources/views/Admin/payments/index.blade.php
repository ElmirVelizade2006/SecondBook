@extends('layout.admin.master')

@section('title', 'Payments')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/payments.css') }}">
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

                <i class="bi bi-credit-card me-2"></i>

                Payments

            </h2>

            <p class="text-muted mb-0">

                Manage customer payments and transaction status.

            </p>

        </div>


        <a href="{{ route('admin.payments.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg me-2"></i>

            Add Payment

        </a>

    </div>


    {{-- Statistics --}}
    <div class="row g-4 mb-4">


        <div class="col-xl-3 col-md-6">

            <div class="payment-card">

                <div>

                    <span>Total Payments</span>

                    <h3>{{ $totalPayments }}</h3>

                </div>

                <i class="bi bi-credit-card"></i>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="payment-card">

                <div>

                    <span>Pending</span>

                    <h3>{{ $pendingPayments }}</h3>

                </div>

                <i class="bi bi-hourglass-split"></i>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="payment-card">

                <div>

                    <span>Paid</span>

                    <h3>{{ $paidPayments }}</h3>

                </div>

                <i class="bi bi-check-circle"></i>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="payment-card">

                <div>

                    <span>Revenue</span>

                    <h3>${{ number_format($totalRevenue, 2) }}</h3>

                </div>

                <i class="bi bi-currency-dollar"></i>

            </div>

        </div>


    </div>


    {{-- Filters --}}
    <div class="dashboard-panel mb-4">
        <form method="GET"
            action="{{ route('admin.payments.index') }}"
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
                        placeholder="Transaction ID, order number...">

                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </div>
            </div>


            {{-- Payment Status --}}
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label small text-muted fw-semibold">
                    Status
                </label>

                <select name="payment_status" class="form-select">
                    <option value="">All Status</option>

                    <option value="pending"
                        @selected(request('payment_status') === 'pending')>
                        Pending
                    </option>

                    <option value="paid"
                        @selected(request('payment_status') === 'paid')>
                        Paid
                    </option>

                    <option value="failed"
                        @selected(request('payment_status') === 'failed')>
                        Failed
                    </option>

                    <option value="refunded"
                        @selected(request('payment_status') === 'refunded')>
                        Refunded
                    </option>
                </select>
            </div>


            {{-- Payment Method --}}
            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label small text-muted fw-semibold">
                    Method
                </label>

                <select name="payment_method" class="form-select">
                    <option value="">All Methods</option>

                    <option value="cash_on_delivery"
                        @selected(request('payment_method') === 'cash_on_delivery')>
                        Cash On Delivery
                    </option>

                    <option value="credit_card"
                        @selected(request('payment_method') === 'credit_card')>
                        Credit Card
                    </option>

                    <option value="debit_card"
                        @selected(request('payment_method') === 'debit_card')>
                        Debit Card
                    </option>

                    <option value="paypal"
                        @selected(request('payment_method') === 'paypal')>
                        PayPal
                    </option>
                </select>
            </div>


            {{-- Date --}}
            <div class="col-12 col-md-6 col-lg-2">
                <label class="form-label small text-muted fw-semibold">
                    Date
                </label>

                <input type="date"
                    name="date"
                    value="{{ request('date') }}"
                    class="form-control">
            </div>


            {{-- Buttons --}}
            <div class="col-12 col-md-6 col-lg-2 payment-filter-buttons">

                <button type="submit"
                        class="btn btn-primary filter-btn">
                    <i class="bi bi-funnel me-1"></i>
                    <span>Filter</span>
                </button>

                <a href="{{ route('admin.payments.index') }}"
                class="btn reset-btn">
                    Reset
                </a>

            </div>

        </form>
    </div>


    {{-- Payments Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Transaction</th>

                            <th>Customer</th>

                            <th>Order</th>

                            <th>Amount</th>

                            <th>Method</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($payments as $payment)

                            <tr>

                                <td>
                                    {{ $payment->id }}
                                </td>


                                <td>

                                    <span class="fw-semibold">
                                        {{ $payment->transaction_id }}
                                    </span>

                                </td>


                                <td>

                                    <div class="fw-semibold">

                                        {{ $payment->order->user->first_name }}
                                        {{ $payment->order->user->last_name }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $payment->order->user->email }}

                                    </small>

                                </td>


                                <td>

                                    <span class="fw-semibold">

                                        {{ $payment->order->order_number }}

                                    </span>

                                    <br>

                                    <small class="text-muted">

                                        {{ $payment->order->book->title }}

                                    </small>

                                </td>


                                <td>

                                    ${{ number_format($payment->amount, 2) }}

                                </td>


                                <td>

                                    @switch($payment->payment_method)

                                        @case('cash_on_delivery')
                                            Cash On Delivery
                                            @break

                                        @case('credit_card')
                                            Credit Card
                                            @break

                                        @case('debit_card')
                                            Debit Card
                                            @break

                                        @case('paypal')
                                            PayPal
                                            @break

                                    @endswitch

                                </td>


                                <td>

                                    @if($payment->payment_status === 'paid')

                                        <span class="badge bg-success">
                                            Paid
                                        </span>

                                    @elseif($payment->payment_status === 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @elseif($payment->payment_status === 'failed')

                                        <span class="badge bg-danger">
                                            Failed
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Refunded
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    {{ $payment->created_at->format('d M Y') }}

                                </td>


                                <td>
                                    <div class="payment-actions">

                                        <a href="{{ route('admin.payments.show', $payment->id) }}"
                                        class="btn btn-sm btn-light"
                                        title="View">

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <a href="{{ route('admin.payments.edit', $payment->id) }}"
                                        class="btn btn-sm btn-light"
                                        title="Edit">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <form action="{{ route('admin.payments.destroy', $payment->id) }}"
                                            method="POST"
                                            class="d-inline delete-payment-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger delete-payment-btn"
                                                    title="Delete">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9"
                                    class="text-center text-muted py-4">

                                    No payments found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $payments->links() }}

            </div>

        </div>

    </div>

</div>

{{-- Delete Confirmation --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const deleteForms = document.querySelectorAll('.delete-payment-form');

    deleteForms.forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'This payment will be permanently deleted.',
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

