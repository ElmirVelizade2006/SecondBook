@extends('Layout.Seller.master')

@section('title', 'Store Settings')

@push('css')
    <link rel="stylesheet" href="{{ asset('seller/css/settings.css') }}">
@endpush

@section('content')

<div class="seller-settings-page">

    {{-- Page Heading --}}
    <div class="seller-page-heading">
        <div>
            <h2>Store Settings</h2>
            <p>
                Manage how your store handles orders and sales.
            </p>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="seller-alert seller-alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="seller-alert seller-alert-danger">
            <i class="bi bi-exclamation-circle-fill"></i>

            <div>
                <strong>Please check the following:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form
        action="{{ route('seller.settings.update') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        {{-- Order Settings --}}
        <div class="seller-settings-card">

            <div class="seller-settings-card-header">
                <div class="seller-settings-icon">
                    <i class="bi bi-bag-check"></i>
                </div>

                <div>
                    <h5>Order Settings</h5>
                    <p>
                        Control how your store receives and processes orders.
                    </p>
                </div>
            </div>

            <div class="seller-settings-card-body">

                {{-- Accept Orders --}}
                <div class="seller-setting-row">

                    <div class="seller-setting-info">
                        <h6>Accept Orders</h6>

                        <p>
                            Allow customers to place new orders from your store.
                        </p>
                    </div>

                    <div class="form-check form-switch seller-setting-switch">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="accept_orders"
                            value="1"
                            id="acceptOrders"
                            {{ old('accept_orders', $store->accept_orders) ? 'checked' : '' }}
                        >
                    </div>

                </div>

                {{-- Auto Approve --}}
                <div class="seller-setting-row">

                    <div class="seller-setting-info">
                        <h6>Auto Approve Orders</h6>

                        <p>
                            Automatically approve new orders without manual confirmation.
                        </p>
                    </div>

                    <div class="form-check form-switch seller-setting-switch">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="auto_approve_orders"
                            value="1"
                            id="autoApproveOrders"
                            {{ old('auto_approve_orders', $store->auto_approve_orders) ? 'checked' : '' }}
                        >
                    </div>

                </div>

                {{-- Processing Time --}}
                <div class="seller-setting-field">

                    <label for="processingTime">
                        Processing Time
                    </label>

                    <div class="seller-input-group">

                        <input
                            type="number"
                            name="processing_time"
                            id="processingTime"
                            class="form-control"
                            min="1"
                            max="30"
                            value="{{ old('processing_time', $store->processing_time) }}"
                        >

                        <span>days</span>

                    </div>

                    <small>
                        How many days you usually need to prepare an order.
                    </small>

                </div>

                {{-- Minimum Order --}}
                <div class="seller-setting-field">

                    <label for="minimumOrderAmount">
                        Minimum Order Amount
                    </label>

                    <div class="seller-input-group">

                        <span>₼</span>

                        <input
                            type="number"
                            name="minimum_order_amount"
                            id="minimumOrderAmount"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="{{ old('minimum_order_amount', $store->minimum_order_amount) }}"
                        >

                    </div>

                    <small>
                        Set the minimum amount required for a customer to place an order.
                        Use 0 to disable this requirement.
                    </small>

                </div>

                {{-- Order Note --}}
                <div class="seller-setting-field">

                    <label for="orderNote">
                        Order Note
                    </label>

                    <textarea
                        name="order_note"
                        id="orderNote"
                        class="form-control"
                        rows="5"
                        maxlength="2000"
                        placeholder="Add instructions or information related to customer orders..."
                    >{{ old('order_note', $store->order_note) }}</textarea>

                    <small>
                        This note can be used for internal order-related instructions.
                    </small>

                </div>

            </div>

        </div>

        {{-- Save --}}
        <div class="seller-settings-actions">

            <button type="submit" class="seller-save-button">
                <i class="bi bi-check2-circle"></i>
                Save Changes
            </button>

        </div>

    </form>

</div>

@endsection