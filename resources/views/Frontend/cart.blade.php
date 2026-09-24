@extends('Layout.Frontend.master')

@section('title', 'Shopping Cart | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
@endpush

@section('content')

<main class="sb-cart-page">

    <div class="container">

        {{-- =====================================================
            PAGE HEADER
        ====================================================== --}}
        <header class="sb-cart-header">

            <div class="sb-cart-header-content">

                <span class="sb-cart-eyebrow">
                    <i class="bi bi-bag-heart"></i>
                    Your Collection
                </span>

                <h1>Shopping Cart</h1>

                <p>
                    Review the books you've selected before continuing to checkout.
                </p>

            </div>

            <a
                href="{{ route('frontend.books') }}"
                class="sb-continue-shopping"
            >
                <i class="bi bi-arrow-left"></i>
                <span>Continue Shopping</span>
            </a>

        </header>


        {{-- =====================================================
            ALERTS
        ====================================================== --}}

        @if(session('success'))
            <div class="sb-cart-alert sb-cart-alert-success">
                <span class="sb-cart-alert-icon">
                    <i class="bi bi-check-lg"></i>
                </span>

                <span>
                    {{ session('success') }}
                </span>
            </div>
        @endif

        @if(session('error'))
            <div class="sb-cart-alert sb-cart-alert-error">
                <span class="sb-cart-alert-icon">
                    <i class="bi bi-exclamation-lg"></i>
                </span>

                <span>
                    {{ session('error') }}
                </span>
            </div>
        @endif


        {{-- =====================================================
            CART
        ====================================================== --}}

        @php
            $shippingEnabled = \App\Models\Setting::get('shipping_enabled', true);
            $defaultShippingFee = (float) \App\Models\Setting::get('default_shipping_fee', 0);
            $freeShippingThreshold = (float) \App\Models\Setting::get('free_shipping_threshold', 0);

            $shippingFee = 0;

            if ($shippingEnabled) {
                if ($freeShippingThreshold <= 0 || $subtotal < $freeShippingThreshold) {
                    $shippingFee = $defaultShippingFee;
                }
            }

            $grandTotal = $subtotal + $shippingFee;
        @endphp

        @if(count($cart) > 0)

            <div class="sb-cart-layout">

                {{-- =================================================
                    LEFT SIDE
                ================================================== --}}
                <section class="sb-cart-main">

                    <div class="sb-cart-items-header">

                        <div class="sb-cart-items-title">

                            <div class="sb-cart-items-icon">
                                <i class="bi bi-bag"></i>
                            </div>

                            <div>
                                <h2>Your Cart</h2>

                                <span>
                                    {{ $totalItems }}
                                    {{ $totalItems === 1 ? 'item' : 'items' }}
                                </span>
                            </div>

                        </div>


                        <form
                            action="{{ route('frontend.cart.clear') }}"
                            method="POST"
                            class="sb-clear-cart-form"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="sb-clear-cart"
                            >
                                <i class="bi bi-trash3"></i>
                                <span>Clear Cart</span>
                            </button>
                        </form>

                    </div>


                    {{-- =================================================
                        CART ITEMS
                    ================================================== --}}

                    <div class="sb-cart-items-list">

                        @foreach($cart as $item)

                            @php
                                $cartCover = null;

                                if (!empty($item['cover'])) {
                                    $cartCover = filter_var(
                                        $item['cover'],
                                        FILTER_VALIDATE_URL
                                    )
                                        ? $item['cover']
                                        : asset('storage/' . $item['cover']);
                                }

                                $itemTotal = $item['price'] * $item['quantity'];
                            @endphp


                            <article class="sb-cart-item">

                                {{-- COVER --}}
                                <div class="sb-cart-item-cover">

                                    @if($cartCover)

                                        <img
                                            src="{{ $cartCover }}"
                                            alt="{{ $item['title'] }}"
                                            loading="lazy"
                                            decoding="async"
                                        >

                                    @else

                                        <div class="sb-cart-no-cover">
                                            <i class="bi bi-book"></i>
                                        </div>

                                    @endif

                                </div>


                                {{-- ITEM CONTENT --}}
                                <div class="sb-cart-item-content">

                                    {{-- TOP --}}
                                    <div class="sb-cart-item-top">

                                        <div class="sb-cart-item-details">

                                            <span class="sb-cart-item-label">
                                                BOOK
                                            </span>

                                            <h3>
                                                {{ $item['title'] }}
                                            </h3>

                                            <div class="sb-cart-stock">

                                                <i class="bi bi-check-circle-fill"></i>

                                                <span>
                                                    {{ $item['stock'] }} available
                                                </span>

                                            </div>

                                        </div>


                                        {{-- PRICE --}}
                                        <div class="sb-cart-unit-price">

                                            <span>Unit Price</span>

                                            <strong>
                                                ${{ number_format($item['price'], 2) }}
                                            </strong>

                                        </div>


                                        {{-- REMOVE --}}
                                        <form
                                            action="{{ route('frontend.cart.remove', $item['id']) }}"
                                            method="POST"
                                            class="sb-remove-form"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="sb-remove-item"
                                                aria-label="Remove {{ $item['title'] }}"
                                                title="Remove item"
                                            >
                                                <i class="bi bi-x-lg"></i>
                                            </button>

                                        </form>

                                    </div>


                                    {{-- BOTTOM --}}
                                    <div class="sb-cart-item-bottom">

                                        {{-- QUANTITY --}}
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
                                                    aria-label="Decrease quantity"
                                                >
                                                    <i class="bi bi-dash"></i>
                                                </button>

                                                <input
                                                    type="text"
                                                    name="quantity"
                                                    value="{{ $item['quantity'] }}"
                                                    min="1"
                                                    max="{{ $item['stock'] }}"
                                                    readonly
                                                    aria-label="Quantity"
                                                >

                                                <button
                                                    type="button"
                                                    class="sb-quantity-btn"
                                                    data-action="increase"
                                                    aria-label="Increase quantity"
                                                >
                                                    <i class="bi bi-plus"></i>
                                                </button>

                                            </div>

                                            <button
                                                type="submit"
                                                class="sb-update-cart"
                                            >
                                                Update
                                            </button>

                                        </form>


                                        {{-- ITEM TOTAL --}}
                                        <div class="sb-cart-item-total">

                                            <span>Item Total</span>

                                            <strong>
                                                ${{ number_format($itemTotal, 2) }}
                                            </strong>

                                        </div>

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                </section>


                {{-- =================================================
                    ORDER SUMMARY
                ================================================== --}}
                <aside class="sb-cart-summary">

                    <div class="sb-summary-card">

                        {{-- HEADER --}}
                        <div class="sb-summary-header">

                            <div class="sb-summary-icon">
                                <i class="bi bi-receipt"></i>
                            </div>

                            <div>
                                <span>Summary</span>
                                <h2>Order Summary</h2>
                            </div>

                        </div>


                        {{-- ROWS --}}
                        <div class="sb-summary-content">

                            <div class="sb-summary-row">

                                <span>
                                    Items
                                </span>

                                <strong>
                                    {{ $totalItems }}
                                </strong>

                            </div>


                            <div class="sb-summary-row">

                                <span>
                                    Subtotal
                                </span>

                                <strong>
                                    ${{ number_format($subtotal, 2) }}
                                </strong>

                            </div>


                            <div class="sb-summary-row">
                                <span>Shipping</span>

                                @if(!$shippingEnabled)
                                    <strong>Disabled</strong>
                                @elseif($shippingFee <= 0)
                                    <strong class="sb-free-shipping">Free</strong>
                                @else
                                    <strong>${{ number_format($shippingFee, 2) }}</strong>
                                @endif
                            </div>

                            @if($shippingEnabled && $freeShippingThreshold > 0)
                                <div class="sb-shipping-note">
                                    <i class="bi bi-truck"></i>

                                    <span>
                                        @if($shippingFee > 0)
                                            Free shipping on orders over
                                            ${{ number_format($freeShippingThreshold, 2) }}.
                                        @else
                                            Free shipping is included with your order.
                                        @endif
                                    </span>
                                </div>
                            @endif


                            <div class="sb-summary-divider"></div>


                            {{-- TOTAL --}}
                            <div class="sb-summary-total">

                                <span>
                                    Total
                                </span>

                                <strong>
                                    ${{ number_format($grandTotal, 2) }}
                                </strong>

                            </div>


                            {{-- CHECKOUT --}}
                            <a
                                href="{{ route('frontend.checkout') }}"
                                class="sb-checkout-btn"
                            >
                                <span>Proceed to Checkout</span>

                                <i class="bi bi-arrow-right"></i>
                            </a>


                            {{-- SECURITY --}}
                            <div class="sb-secure-checkout">

                                <span class="sb-secure-icon">
                                    <i class="bi bi-shield-check"></i>
                                </span>

                                <div>
                                    <strong>Secure checkout</strong>

                                    <span>
                                        Protected payment experience
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>

                </aside>

            </div>


        @else

            {{-- =====================================================
                EMPTY CART
            ====================================================== --}}
            <section class="sb-empty-cart">

                <div class="sb-empty-cart-decoration sb-decoration-one"></div>
                <div class="sb-empty-cart-decoration sb-decoration-two"></div>

                <div class="sb-empty-cart-icon">
                    <i class="bi bi-bag"></i>
                </div>

                <span class="sb-empty-cart-label">
                    YOUR CART
                </span>

                <h2>
                    Nothing here yet.
                </h2>

                <p>
                    Explore our collection and discover your next favorite book.
                </p>

                <a
                    href="{{ route('frontend.books') }}"
                    class="sb-empty-cart-btn"
                >
                    <i class="bi bi-book"></i>
                    <span>Browse Books</span>
                    <i class="bi bi-arrow-right"></i>
                </a>

            </section>

        @endif

    </div>

</main>

@endsection



@push('js')
<script>
(function () {

    function initCartQuantity() {

        const cartPage = document.querySelector('.sb-cart-page');

        if (!cartPage) {
            return;
        }

        cartPage.addEventListener('click', function (event) {

            const button = event.target.closest('.sb-quantity-btn');

            if (!button) {
                return;
            }

            event.preventDefault();

            const control = button.closest('.sb-quantity-control');

            if (!control) {
                return;
            }

            const input = control.querySelector('input[name="quantity"]');

            if (!input) {
                return;
            }

            let value = parseInt(input.value, 10);

            if (isNaN(value)) {
                value = 1;
            }

            const min = parseInt(input.getAttribute('min'), 10) || 1;
            const max = parseInt(input.getAttribute('max'), 10) || 999;

            const action = button.getAttribute('data-action');

            if (action === 'increase' && value < max) {
                value++;
            }

            if (action === 'decrease' && value > min) {
                value--;
            }

            input.value = value;
        });

    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCartQuantity);
    } else {
        initCartQuantity();
    }

})();
</script>
@endpush



