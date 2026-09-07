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
                <i class="bi bi-cart-plus me-2"></i>
                Create Order
            </h2>

            <p class="text-muted mb-0">
                Create a new customer order manually.
            </p>
        </div>


        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>
            Back
        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">


            <form action="{{ route('admin.orders.store') }}" method="POST">

                @csrf


                <div class="row g-4">



                    {{-- Customer --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Customer
                        </label>


                        <select name="user_id" class="form-select">

                            <option value="">
                                Select Customer
                            </option>


                            @foreach($users as $user)

                            <option value="{{ $user->id }}">

                                {{ $user->first_name }} {{ $user->last_name }}

                            </option>

                            @endforeach


                        </select>

                    </div>


                    {{-- Book --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Book
                        </label>


                        <select name="book_id" class="form-select">


                            <option value="">
                                Select Book
                            </option>


                            @foreach($books as $book)

                            <option value="{{ $book->id }}">

                                {{ $book->title }}

                            </option>

                            @endforeach


                        </select>


                    </div>


                    {{-- Book Price --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Book Price
                        </label>


                        <input type="number"
                               name="book_price"
                               class="form-control"
                               placeholder="0.00"
                               step="0.01">


                    </div>


                    {{-- Quantity --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Quantity
                        </label>


                        <input type="number"
                               name="quantity"
                               class="form-control"
                               value="1"
                               min="1">


                    </div>


                    {{-- Payment Method --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Payment Method
                        </label>


                        <select name="payment_method"
                                class="form-select">


                            <option value="cash_on_delivery">
                                Cash On Delivery
                            </option>


                            <option value="credit_card">
                                Credit Card
                            </option>


                            <option value="debit_card">
                                Debit Card
                            </option>


                            <option value="paypal">
                                Paypal
                            </option>


                        </select>


                    </div>


                    {{-- Payment Status --}}
                    <div class="col-md-6">


                        <label class="form-label">
                            Payment Status
                        </label>


                        <select name="payment_status"
                                class="form-select">


                            <option value="pending">
                                Pending
                            </option>


                            <option value="paid">
                                Paid
                            </option>


                            <option value="failed">
                                Failed
                            </option>


                            <option value="refunded">
                                Refunded
                            </option>


                        </select>


                    </div>


                    {{-- Order Status --}}
                    <div class="col-md-6">


                        <label class="form-label">
                            Order Status
                        </label>


                        <select name="order_status"
                                class="form-select">


                            <option value="pending">
                                Pending
                            </option>


                            <option value="processing">
                                Processing
                            </option>


                            <option value="shipped">
                                Shipped
                            </option>


                            <option value="delivered">
                                Delivered
                            </option>


                            <option value="cancelled">
                                Cancelled
                            </option>


                        </select>


                    </div>


                    {{-- Full Name --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Full Name
                        </label>


                        <input type="text"
                               name="full_name"
                               class="form-control"
                               placeholder="Customer name">


                    </div>


                    {{-- Phone --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Phone
                        </label>


                        <input type="text"
                               name="phone"
                               class="form-control"
                               placeholder="+994 50 000 00 00">


                    </div>


                    {{-- Country --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Country
                        </label>


                        <input type="text"
                               name="country"
                               class="form-control"
                               placeholder="Country">


                    </div>


                    {{-- City --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            City
                        </label>


                        <input type="text"
                               name="city"
                               class="form-control"
                               placeholder="City">


                    </div>


                    {{-- Postal Code --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Postal Code
                        </label>


                        <input type="text"
                               name="postal_code"
                               class="form-control"
                               placeholder="Postal code">


                    </div>


                    {{-- Address --}}
                    <div class="col-12">

                        <label class="form-label">
                            Address
                        </label>


                        <textarea name="address"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Customer address"></textarea>


                    </div>


                    {{-- Note --}}
                    <div class="col-12">

                        <label class="form-label">
                            Note
                        </label>


                        <textarea name="note"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Order note"></textarea>


                    </div>

                </div>


                <div class="mt-4 text-end">


                    <button type="submit"
                            class="btn btn-primary">


                        <i class="bi bi-check-circle me-2"></i>
                        Create Order


                    </button>


                </div>

            </form>

        </div>

    </div>

</div>


@endsection