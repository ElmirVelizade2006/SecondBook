@extends('layout.admin.master')

@section('title', 'Create Order')

@push('css')
@endpush

@section('content')

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

    <a href="{{ route('admin.orders.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-2"></i>
        Back

    </a>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="alert alert-danger alert-dismissible fade show mb-4"
                 role="alert">

                <div class="fw-semibold mb-2">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Please fix the following errors:
                </div>

                <ul class="mb-0 ps-4">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>

            </div>

        @endif


        <form action="{{ route('admin.orders.store') }}"
              method="POST">

            @csrf


            <div class="row g-4">


                {{-- Customer --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Customer
                    </label>

                    <select name="user_id"
                            class="form-select @error('user_id') is-invalid @enderror">

                        <option value="">
                            Select Customer
                        </option>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}"
                                {{ old('user_id') == $user->id ? 'selected' : '' }}>

                                {{ $user->first_name }}
                                {{ $user->last_name }}

                            </option>

                        @endforeach

                    </select>

                    @error('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Book --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Book
                    </label>

                    <select name="book_id"
                            class="form-select @error('book_id') is-invalid @enderror">

                        <option value="">
                            Select Book
                        </option>

                        @foreach($books as $book)

                            <option value="{{ $book->id }}"
                                {{ old('book_id') == $book->id ? 'selected' : '' }}>

                                {{ $book->title }}

                            </option>

                        @endforeach

                    </select>

                    @error('book_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Book Price --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Book Price
                    </label>

                    <input type="number"
                           name="book_price"
                           class="form-control @error('book_price') is-invalid @enderror"
                           placeholder="0.00"
                           step="0.01"
                           min="0"
                           value="{{ old('book_price') }}">

                    @error('book_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Quantity --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Quantity
                    </label>

                    <input type="number"
                           name="quantity"
                           class="form-control @error('quantity') is-invalid @enderror"
                           value="{{ old('quantity', 1) }}"
                           min="1">

                    @error('quantity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Payment Method --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Payment Method
                    </label>

                    <select name="payment_method"
                            class="form-select @error('payment_method') is-invalid @enderror">

                        <option value="cash_on_delivery"
                            {{ old('payment_method', 'cash_on_delivery') == 'cash_on_delivery' ? 'selected' : '' }}>
                            Cash On Delivery
                        </option>

                        <option value="credit_card"
                            {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>
                            Credit Card
                        </option>

                        <option value="debit_card"
                            {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>
                            Debit Card
                        </option>

                        <option value="paypal"
                            {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>
                            PayPal
                        </option>

                    </select>

                    @error('payment_method')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Payment Status --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Payment Status
                    </label>

                    <select name="payment_status"
                            class="form-select @error('payment_status') is-invalid @enderror">

                        <option value="pending"
                            {{ old('payment_status', 'pending') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="paid"
                            {{ old('payment_status') == 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>

                        <option value="failed"
                            {{ old('payment_status') == 'failed' ? 'selected' : '' }}>
                            Failed
                        </option>

                        <option value="refunded"
                            {{ old('payment_status') == 'refunded' ? 'selected' : '' }}>
                            Refunded
                        </option>

                    </select>

                    @error('payment_status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Order Status --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Order Status
                    </label>

                    <select name="order_status"
                            class="form-select @error('order_status') is-invalid @enderror">

                        <option value="pending"
                            {{ old('order_status', 'pending') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="processing"
                            {{ old('order_status') == 'processing' ? 'selected' : '' }}>
                            Processing
                        </option>

                        <option value="shipped"
                            {{ old('order_status') == 'shipped' ? 'selected' : '' }}>
                            Shipped
                        </option>

                        <option value="delivered"
                            {{ old('order_status') == 'delivered' ? 'selected' : '' }}>
                            Delivered
                        </option>

                        <option value="cancelled"
                            {{ old('order_status') == 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                    @error('order_status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Full Name --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input type="text"
                           name="full_name"
                           class="form-control @error('full_name') is-invalid @enderror"
                           placeholder="Customer name"
                           value="{{ old('full_name') }}">

                    @error('full_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Phone --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Phone
                    </label>

                    <input type="text"
                           name="phone"
                           class="form-control @error('phone') is-invalid @enderror"
                           placeholder="+994 50 000 00 00"
                           value="{{ old('phone') }}">

                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Country --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Country
                    </label>

                    <input type="text"
                           name="country"
                           class="form-control @error('country') is-invalid @enderror"
                           placeholder="Country"
                           value="{{ old('country') }}">

                    @error('country')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- City --}}
                <div class="col-md-4">

                    <label class="form-label">
                        City
                    </label>

                    <input type="text"
                           name="city"
                           class="form-control @error('city') is-invalid @enderror"
                           placeholder="City"
                           value="{{ old('city') }}">

                    @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Postal Code --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Postal Code
                    </label>

                    <input type="text"
                           name="postal_code"
                           class="form-control @error('postal_code') is-invalid @enderror"
                           placeholder="Postal code"
                           value="{{ old('postal_code') }}">

                    @error('postal_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Address --}}
                <div class="col-12">

                    <label class="form-label">
                        Address
                    </label>

                    <textarea name="address"
                              class="form-control @error('address') is-invalid @enderror"
                              rows="3"
                              placeholder="Customer address">{{ old('address') }}</textarea>

                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Note --}}
                <div class="col-12">

                    <label class="form-label">
                        Note
                    </label>

                    <textarea name="note"
                              class="form-control @error('note') is-invalid @enderror"
                              rows="3"
                              placeholder="Order note">{{ old('note') }}</textarea>

                    @error('note')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


            </div>


            {{-- Submit --}}
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

@endsection