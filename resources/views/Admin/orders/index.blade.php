@extends('layout.admin.master')

@section('title', 'Orders')

@push('css')
<link rel="stylesheet" href="{{ asset('admin/css/orders.css') }}">
@endpush


@section('content')

<div class="container-fluid p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-cart3 me-2"></i>
                Orders
            </h2>

            <p class="text-muted mb-0">
                Manage customer orders, payments and delivery status.
            </p>
        </div>


        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>
            Add Order
        </a>

    </div>


    {{-- Statistics --}}
    <div class="row g-4 mb-4">


        <div class="col-xl-3 col-md-6">

            <div class="order-card">

                <div>
                    <span>Total Orders</span>
                    <h3>245</h3>
                </div>

                <i class="bi bi-cart-check"></i>

            </div>

        </div>



        <div class="col-xl-3 col-md-6">

            <div class="order-card">

                <div>
                    <span>Pending</span>
                    <h3>35</h3>
                </div>

                <i class="bi bi-hourglass-split"></i>

            </div>

        </div>




        <div class="col-xl-3 col-md-6">

            <div class="order-card">

                <div>
                    <span>Delivered</span>
                    <h3>180</h3>
                </div>

                <i class="bi bi-check-circle"></i>

            </div>

        </div>




        <div class="col-xl-3 col-md-6">

            <div class="order-card">

                <div>
                    <span>Revenue</span>
                    <h3>$12,450</h3>
                </div>

                <i class="bi bi-currency-dollar"></i>

            </div>

        </div>


    </div>


    {{-- Filters --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">


            <div class="row g-3">


                <div class="col-lg-4">

                    <input type="text"
                           class="form-control"
                           placeholder="Search order...">

                </div>



                <div class="col-lg-2">

                    <select class="form-select">

                        <option>
                            Status
                        </option>

                        <option>
                            Pending
                        </option>

                        <option>
                            Delivered
                        </option>

                        <option>
                            Cancelled
                        </option>

                    </select>

                </div>




                <div class="col-lg-2">

                    <select class="form-select">

                        <option>
                            Payment
                        </option>

                        <option>
                            Paid
                        </option>

                        <option>
                            Pending
                        </option>

                    </select>


                </div>



                <div class="col-lg-2">

                    <input type="date"
                           class="form-control">

                </div>



                <div class="col-lg-2">

                    <button class="btn btn-dark w-100">

                        <i class="bi bi-search"></i>
                        Filter

                    </button>

                </div>



            </div>


        </div>

    </div>


    {{-- Orders Table --}}

    <div class="card border-0 shadow-sm">


        <div class="card-body">


            <div class="table-responsive">


                <table class="table align-middle">


                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Customer</th>
                            <th>Book</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>

                    </thead>


                @foreach ($orders as $order)
                    <tbody>


                        <tr>

                            <td>
                                {{ $order->id }}
                            </td>


                            <td>

                                <div class="fw-semibold">
                                    {{ $order->user->first_name }} {{ $order->user->last_name }}
                                </div>

                                <small class="text-muted">
                                    {{ $order->user->email }}
                                </small>

                            </td>



                            <td>
                                {{ $order->book->title }}
                            </td>


                            <td>
                                ${{ $order->total_price }}
                            </td>



                            <td>

                                <span class="badge bg-success">
                                    {{ $order->payment_status }}
                                </span>

                            </td>



                            <td>

                                <span class="badge bg-warning text-dark">
                                    {{ $order->order_status }}
                                </span>

                            </td>



                            <td>
                                {{ $order->created_at->format('d M Y') }}
                            </td>



                            <td>

                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="btn btn-sm btn-light">

                                    <i class="bi bi-eye"></i>

                                </a>


                                <a href="{{ route('admin.orders.edit', $order->id) }}"
                                   class="btn btn-sm btn-light">

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <button class="btn btn-sm btn-danger">

                                    <i class="bi bi-trash"></i>

                                </button>


                            </td>


                        </tr>


                        @endforeach
                    </tbody>


                </table>


            </div>


        </div>


    </div>

</div>



@endsection