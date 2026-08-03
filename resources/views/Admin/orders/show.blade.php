@extends('layout.admin.master')

@section('title', 'Order')


@push('css')
<link rel="stylesheet" href="{{ asset('admin/css/orders.css') }}">
@endpush


@section('content')

<div class="container-fluid p-4">


    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-receipt me-2"></i>
                Order Details
            </h2>

            <p class="text-muted mb-0">
                View complete order information.
            </p>

        </div>


        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">

            <i class="bi bi-arrow-left me-2"></i>
            Back

        </a>


    </div>


    <div class="row g-4">


        {{-- Order Information --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-cart-check me-2"></i>
                        Order Information
                    </h5>

                </div>


                <div class="card-body">


                    <p>
                        <strong>Order Number:</strong>
                        {{ $order->order_number }}
                    </p>


                    <p>
                        <strong>Quantity:</strong>
                        {{ $order->quantity }}
                    </p>


                    <p>
                        <strong>Book Price:</strong>
                        ${{ number_format($order->book_price,2) }}
                    </p>


                    <p>
                        <strong>Total Price:</strong>
                        ${{ number_format($order->total_price,2) }}
                    </p>


                    <p>
                        <strong>Created:</strong>
                        {{ $order->created_at->format('d M Y H:i') }}
                    </p>


                </div>

            </div>

        </div>


        {{-- Customer --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm">


                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-person me-2"></i>
                        Customer

                    </h5>

                </div>


                <div class="card-body">


                    <p>
                        <strong>Name:</strong>
                        {{ $order->full_name }}
                    </p>


                    <p>
                        <strong>User:</strong>
                        {{ $order->user->first_name ?? '' }}
                        {{ $order->user->last_name ?? '' }}
                    </p>


                    <p>
                        <strong>Phone:</strong>
                        {{ $order->phone }}
                    </p>


                </div>


            </div>

        </div>


        {{-- Book --}}
        <div class="col-lg-6">


            <div class="card border-0 shadow-sm">


                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-book me-2"></i>
                        Book

                    </h5>

                </div>


                <div class="card-body">


                    <p>
                        <strong>Title:</strong>
                        {{ $order->book->title ?? 'N/A' }}
                    </p>


                    <p>
                        <strong>Author:</strong>
                        {{ $order->book->author->name ?? 'N/A' }}
                    </p>


                </div>


            </div>


        </div>


        {{-- Payment --}}
        <div class="col-lg-6">


            <div class="card border-0 shadow-sm">


                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-credit-card me-2"></i>
                        Payment

                    </h5>

                </div>


                <div class="card-body">


                    <p>
                        <strong>Method:</strong>

                        {{ ucwords(str_replace('_',' ', $order->payment_method)) }}

                    </p>



                    <p>
                        <strong>Status:</strong>

                        <span class="badge bg-primary">
                            {{ ucfirst($order->payment_status) }}
                        </span>

                    </p>


                </div>


            </div>


        </div>


        {{-- Order Status --}}
        <div class="col-lg-6">


            <div class="card border-0 shadow-sm">


                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-truck me-2"></i>
                        Status

                    </h5>

                </div>


                <div class="card-body">


                    <span class="badge bg-success">

                        {{ ucfirst($order->order_status) }}

                    </span>


                </div>


            </div>


        </div>


        {{-- Shipping --}}
        <div class="col-lg-6">


            <div class="card border-0 shadow-sm">


                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-geo-alt me-2"></i>
                        Shipping

                    </h5>

                </div>


                <div class="card-body">


                    <p>
                        <strong>Country:</strong>
                        {{ $order->country }}
                    </p>


                    <p>
                        <strong>City:</strong>
                        {{ $order->city }}
                    </p>


                    <p>
                        <strong>Postal Code:</strong>
                        {{ $order->postal_code }}
                    </p>


                    <p>
                        <strong>Address:</strong>
                        {{ $order->address }}
                    </p>


                </div>


            </div>


        </div>


        {{-- Note --}}
        <div class="col-12">


            <div class="card border-0 shadow-sm">


                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-chat-left-text me-2"></i>
                        Note

                    </h5>

                </div>


                <div class="card-body">

                    {{ $order->note ?? 'No note available.' }}

                </div>


            </div>


        </div>


    </div>

    <div class="mt-4 text-end">

        <a href="{{ route('admin.orders.edit',$order->id) }}"
           class="btn btn-primary">

            <i class="bi bi-pencil me-2"></i>
            Edit Order

        </a>

    </div>

</div>

@endsection