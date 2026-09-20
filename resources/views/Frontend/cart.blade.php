@extends('Layout.Frontend.master')

@section('title', 'Shopping Cart | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
@endpush

@section('content')

<main class="sb-cart-page">

    <div class="container">

        {{-- Page Header --}}
        <div class="sb-cart-header">
            <div>
                <span class="sb-cart-eyebrow">
                    <i class="bi bi-bag-heart"></i>
                    Your Collection
                </span>

                <h1>Shopping Cart</h1>

                <p>
                    Review the books you've selected before continuing to checkout.
                </p>
            </div>

            <a href="{{ route('frontend.books') }}" class="sb-continue-shopping">
                <i class="bi bi-arrow-left"></i>
                Continue Shopping
            </a>
        </div>


        {{-- Alerts --}}
        @if(session('success'))
            <div class="sb-cart-alert success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="sb-cart-alert error">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif


        @if(count($cart) > 0)

            <div class="sb-cart-layout">

                {{-- Cart Items --}}
                <section class="sb-cart-items">

                    <div class="sb-cart-items-header">
                        <div>
                            <span>Your Cart</span>
                            <strong>{{ $totalItems }} {{ $totalItems === 1 ? 'item' : 'items' }}</strong>
                        </div>

                        <form
                            action="{{ route('frontend.cart.clear') }}"
                            method="POST"
                            class="sb-clear-cart-form"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="sb-clear-cart">
                                <i class="bi bi-trash3"></i>
                                Clear Cart
                            </button>
                        </form>
                    </div>


                    @foreach($cart as $item)

                        <article class="sb-cart-item">

                            {{-- Cover --}}
                            <div class="sb-cart-item-cover">

                                @if(!empty($item['cover']))
                                    <img
                                        src="{{ asset('storage/' . $item['cover']) }}"
                                        alt="{{ $item['title'] }}"
                                    >
                                @else
                                    <div class="sb-cart-no-cover">
                                        <i class="bi bi-book"></i>
                                    </div>
                                @endif

                            </div>


                            {{-- Information --}}
                            <div class="sb-cart-item-info">

                                <div class="sb-cart-item-top">

                                    <div>
                                        <h2>{{ $item['title'] }}</h2>

                                        <span class="sb-cart-stock">
                                            <i class="bi bi-check-circle-fill"></i>
                                            {{ $item['stock'] }} available
                                        </span>
                                    </div>

                                    <strong class="sb-cart-item-price">
                                        ${{ number_format($item['price'], 2) }}
                                    </strong>

                                </div>


                                <div class="sb-cart-item-bottom">

                                    {{-- Quantity --}}
                                    <form
                                        action="{{ route('frontend.cart.update', $item['id']) }}"
                                        method="POST"
                                        class="sb-quantity-form"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <span class="sb-quantity-label">
                                            Quantity
                                        </span>

                                        <div class="sb-quantity-control">

                                            <button
                                                type="button"
                                                class="sb-quantity-btn"
                                                data-action="decrease"
                                            >
                                                <i class="bi bi-dash"></i>
                                            </button>

                                            <input
                                                type="number"
                                                name="quantity"
                                                value="{{ $item['quantity'] }}"
                                                min="1"
                                                max="{{ $item['stock'] }}"
                                                readonly
                                            >

                                            <button
                                                type="button"
                                                class="sb-quantity-btn"
                                                data-action="increase"
                                            >
                                                <i class="bi bi-plus"></i>
                                            </button>

                                        </div>

                                        <button type="submit" class="sb-update-cart">
                                            Update
                                        </button>

                                    </form>


                                    {{-- Item Total --}}
                                    <div class="sb-cart-item-total">
                                        <span>Item Total</span>

                                        <strong>
                                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </strong>
                                    </div>


                                    {{-- Remove --}}
                                    <form
                                        action="{{ route('frontend.cart.remove', $item['id']) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="sb-remove-item"
                                            aria-label="Remove {{ $item['title'] }}"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </section>


                {{-- Summary --}}
                <aside class="sb-cart-summary">

                    <div class="sb-summary-card">

                        <div class="sb-summary-heading">
                            <span>Order Summary</span>
                            <i class="bi bi-receipt"></i>
                        </div>

                        <div class="sb-summary-row">
                            <span>Items</span>
                            <strong>{{ $totalItems }}</strong>
                        </div>

                        <div class="sb-summary-row">
                            <span>Subtotal</span>
                            <strong>
                                ${{ number_format($subtotal, 2) }}
                            </strong>
                        </div>

                        <div class="sb-summary-row">
                            <span>Shipping</span>
                            <strong class="sb-free-shipping">
                                Free
                            </strong>
                        </div>

                        <div class="sb-summary-divider"></div>

                        <div class="sb-summary-total">
                            <span>Total</span>

                            <strong>
                                ${{ number_format($subtotal, 2) }}
                            </strong>
                        </div>

                        <a
                            href="{{ route('frontend.checkout') }}"
                            class="sb-checkout-btn"
                        >
                            Proceed to Checkout
                            <i class="bi bi-arrow-right"></i>
                        </a>

                        <div class="sb-secure-checkout">
                            <i class="bi bi-shield-check"></i>

                            <span>
                                Secure checkout &amp; protected payment
                            </span>
                        </div>

                    </div>

                </aside>

            </div>

        @else

            {{-- Empty Cart --}}
            <section class="sb-empty-cart">

                <div class="sb-empty-cart-icon">
                    <i class="bi bi-bag"></i>
                </div>

                <span>Your cart is empty</span>

                <h2>Nothing here yet.</h2>

                <p>
                    Explore our collection and find your next favorite book.
                </p>

                <a
                    href="{{ route('frontend.books') }}"
                    class="sb-empty-cart-btn"
                >
                    <i class="bi bi-book"></i>
                    Browse Books
                </a>

            </section>

        @endif

    </div>

</main>

@endsection


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.sb-quantity-control').forEach(function (control) {

        const input = control.querySelector('input');
        const decrease = control.querySelector('[data-action="decrease"]');
        const increase = control.querySelector('[data-action="increase"]');

        if (!input) {
            return;
        }

        decrease?.addEventListener('click', function () {

            let value = parseInt(input.value) || 1;
            const min = parseInt(input.min) || 1;

            if (value > min) {
                input.value = value - 1;
            }

        });

        increase?.addEventListener('click', function () {

            let value = parseInt(input.value) || 1;
            const max = parseInt(input.max) || 999;

            if (value < max) {
                input.value = value + 1;
            }

        });

    });

});
</script>

@endpush