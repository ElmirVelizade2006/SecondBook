@extends('layout.admin.master')

@section('title', 'Edit Order | SecondBook Admin')


@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/orders.css') }}">
@endpush



@section('content')


<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Order
            </h2>
            <p class="text-muted mb-0">
                Update customer order information
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>
            Back
        </a>
    </div>


    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.orders.update',$order->id) }}" method="POST">

                @csrf
                @method('PUT')

            <div class="row g-4">
                <div class="col-md-6">

                <label class="form-label">
                Customer
                </label>

                <select name="user_id" class="form-select">

                    @foreach($users as $user)

                        <option value="{{ $user->id }}"
                        {{ $order->user_id == $user->id ? 'selected' : '' }}>

                        {{ $user->first_name }} {{ $user->last_name }}

                        </option>


                    @endforeach

                </select>
            </div>

            <div class="col-md-6">

                <label class="form-label">
                Book
                </label>

                <select name="book_id" class="form-select">

                    @foreach($books as $book)
                        <option value="{{ $book->id }}"
                        {{ $order->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                        </option>
                    @endforeach

                </select>


            </div>


            <div class="col-md-4">

                <label class="form-label">
                Book Price
                </label>

                <input type="number"
                name="book_price"
                step="0.01"
                class="form-control"
                value="{{ $order->book_price }}">

            </div>

            <div class="col-md-4">

                <label class="form-label">
                Quantity
                </label>

                <input type="number"
                name="quantity"
                min="1"
                class="form-control"
                value="{{ $order->quantity }}">

            </div>

            <div class="col-md-4">

                <label class="form-label">
                Payment Method
                </label>

                <select name="payment_method" class="form-select">

                    <option value="cash_on_delivery"
                    {{ $order->payment_method == 'cash_on_delivery' ? 'selected':'' }}>
                    Cash On Delivery
                    </option>


                    <option value="credit_card"
                    {{ $order->payment_method == 'credit_card' ? 'selected':'' }}>
                    Credit Card
                    </option>


                    <option value="debit_card"
                    {{ $order->payment_method == 'debit_card' ? 'selected':'' }}>
                    Debit Card
                    </option>


                    <option value="paypal"
                    {{ $order->payment_method == 'paypal' ? 'selected':'' }}>
                    Paypal
                    </option>

                </select>

            </div>

            <div class="col-md-6">


                <label class="form-label">
                Payment Status
                </label>


                <select name="payment_status" class="form-select">


                    <option value="pending"
                    {{ $order->payment_status=='pending'?'selected':'' }}>
                    Pending
                    </option>


                    <option value="paid"
                    {{ $order->payment_status=='paid'?'selected':'' }}>
                    Paid
                    </option>


                    <option value="failed"
                    {{ $order->payment_status=='failed'?'selected':'' }}>
                    Failed
                    </option>


                    <option value="refunded"
                    {{ $order->payment_status=='refunded'?'selected':'' }}>
                    Refunded
                    </option>


                </select>


            </div>

            <div class="col-md-6">

                <label class="form-label">
                Order Status
                </label>

                <select name="order_status" class="form-select">

                    <option value="pending"
                    {{ $order->order_status=='pending'?'selected':'' }}>
                    Pending
                    </option>

                    <option value="processing"
                    {{ $order->order_status=='processing'?'selected':'' }}>
                    Processing
                    </option>

                    <option value="shipped"
                    {{ $order->order_status=='shipped'?'selected':'' }}>
                    Shipped
                    </option>

                    <option value="delivered"
                    {{ $order->order_status=='delivered'?'selected':'' }}>
                    Delivered
                    </option>

                    <option value="cancelled"
                    {{ $order->order_status=='cancelled'?'selected':'' }}>
                    Cancelled
                    </option>

                </select>

            </div>

            <div class="col-md-6">

            <label class="form-label">
            Full Name
            </label>

            <input type="text"
            name="full_name"
            class="form-control"
            value="{{ $order->full_name }}">

            </div>

            <div class="col-md-6">

                <label class="form-label">
                Phone
                </label>

                <input type="text"
                name="phone"
                class="form-control"
                value="{{ $order->phone }}">

            </div>

            <div class="col-md-4">

                <label class="form-label">
                Country
                </label>

                <input type="text"
                name="country"
                class="form-control"
                value="{{ $order->country }}">

            </div>

            <div class="col-md-4">

                <label class="form-label">
                City
                </label>


                <input type="text"
                name="city"
                class="form-control"
                value="{{ $order->city }}">

            </div>

            <div class="col-md-4">

                <label class="form-label">
                Postal Code
                </label>

                <input type="text"
                name="postal_code"
                class="form-control"
                value="{{ $order->postal_code }}">

            </div>

            <div class="col-12">

                <label class="form-label">
                Address
                </label>

                <textarea name="address"
                class="form-control"
                rows="3">{{ $order->address }}</textarea>

            </div>

            <div class="col-12">

                <label class="form-label">
                Note
                </label>

                <textarea name="note"
                class="form-control"
                rows="3">{{ $order->note }}</textarea>

            </div>

        </div>

        <div class="mt-4 text-end">

            <button class="btn btn-primary">
            <i class="bi bi-check-circle me-2"></i>
            Update Order
            </button>

        </div>

    </form>


</div>



@endsection
