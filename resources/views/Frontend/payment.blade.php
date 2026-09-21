@extends('Layout.Frontend.master')

@section('title', 'Payment | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/payment.css') }}">
@endpush

@section('content')

<main class="sb-payment-page">

    {{-- =====================================================
       HERO
    ====================================================== --}}

    <section class="payment-hero">

        <div class="container">

            <div class="payment-breadcrumb">

                <a href="{{ route('frontend.cart') }}">
                    <i class="bi bi-cart3"></i>
                    Shopping Cart
                </a>

                <i class="bi bi-chevron-right"></i>

                <a href="{{ route('frontend.orders') }}">
                    Orders
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>Payment</span>

            </div>


            <div class="payment-hero-content">

                <div class="payment-hero-main">

                    <span class="payment-eyebrow">
                        <i class="bi bi-shield-check"></i>
                        Secure Payment
                    </span>

                    <h1>
                        Complete Your Payment
                    </h1>

                    <p>
                        Review your order and choose a secure payment
                        method to complete your purchase.
                    </p>

                </div>


                <div class="payment-security-badge">

                    <div class="payment-security-icon">
                        <i class="bi bi-lock-fill"></i>
                    </div>

                    <div class="payment-security-content">

                        <strong>
                            Secure Checkout
                        </strong>

                        <span>
                            Your payment details are protected.
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
       CONTENT
    ====================================================== --}}

    <section class="payment-section">

        <div class="container">

            {{-- Alerts --}}

            @if(session('success'))

                <div class="payment-alert payment-alert-success">

                    <div class="payment-alert-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <div>

                        <strong>
                            Success
                        </strong>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                </div>

            @endif


            @if(session('error'))

                <div class="payment-alert payment-alert-error">

                    <div class="payment-alert-icon">
                        <i class="bi bi-exclamation-lg"></i>
                    </div>

                    <div>

                        <strong>
                            Payment Error
                        </strong>

                        <span>
                            {{ session('error') }}
                        </span>

                    </div>

                </div>

            @endif


            {{-- Validation Errors --}}

            @if($errors->any())

                <div class="payment-alert payment-alert-error">

                    <div class="payment-alert-icon">
                        <i class="bi bi-exclamation-lg"></i>
                    </div>

                    <div>

                        <strong>
                            Please check your payment details
                        </strong>

                        <span>
                            {{ $errors->first() }}
                        </span>

                    </div>

                </div>

            @endif


            <div class="row g-4 g-xl-5 align-items-start">


                {{-- =================================================
                   PAYMENT FORM
                ================================================== --}}

                <div class="col-lg-7">

                    <form
                        action="{{ route('frontend.payment.process', $order->id) }}"
                        method="POST"
                        class="payment-form"
                        id="paymentForm"
                    >

                        @csrf


                        {{-- =================================================
                           PAYMENT CARD
                        ================================================== --}}

                        <div class="payment-card">

                            <div class="payment-card-header">

                                <div class="payment-card-heading">

                                    <div class="payment-card-icon">
                                        <i class="bi bi-credit-card-2-front"></i>
                                    </div>

                                    <div>

                                        <span>
                                            Payment Details
                                        </span>

                                        <h2>
                                            Choose Payment Method
                                        </h2>

                                    </div>

                                </div>


                                <span class="payment-step">
                                    01
                                </span>

                            </div>


                            <div class="payment-card-body">


                                {{-- =================================================
                                   PAYMENT METHODS
                                ================================================== --}}

                                <div class="payment-method-section">

                                    <div class="payment-section-title">

                                        <div>

                                            <span>
                                                Payment method
                                            </span>

                                            <small>
                                                Select your preferred payment option
                                            </small>

                                        </div>

                                        <i class="bi bi-wallet2"></i>

                                    </div>


                                    <div class="payment-method-grid">


                                        {{-- Credit Card --}}

                                        <label class="payment-method-option">

                                            <input
                                                type="radio"
                                                name="payment_method"
                                                value="credit_card"
                                                {{ old('payment_method', $payment->payment_method) === 'credit_card' ? 'checked' : '' }}
                                            >

                                            <span class="payment-method-box">

                                                <span class="payment-method-top">

                                                    <span class="payment-method-icon">
                                                        <i class="bi bi-credit-card"></i>
                                                    </span>

                                                    <span class="payment-radio"></span>

                                                </span>

                                                <strong>
                                                    Credit Card
                                                </strong>

                                                <small>
                                                    Pay securely with your credit card.
                                                </small>

                                            </span>

                                        </label>


                                        {{-- Debit Card --}}

                                        <label class="payment-method-option">

                                            <input
                                                type="radio"
                                                name="payment_method"
                                                value="debit_card"
                                                {{ old('payment_method', $payment->payment_method) === 'debit_card' ? 'checked' : '' }}
                                            >

                                            <span class="payment-method-box">

                                                <span class="payment-method-top">

                                                    <span class="payment-method-icon">
                                                        <i class="bi bi-wallet2"></i>
                                                    </span>

                                                    <span class="payment-radio"></span>

                                                </span>

                                                <strong>
                                                    Debit Card
                                                </strong>

                                                <small>
                                                    Pay securely with your debit card.
                                                </small>

                                            </span>

                                        </label>


                                        {{-- PayPal --}}

                                        <label class="payment-method-option">

                                            <input
                                                type="radio"
                                                name="payment_method"
                                                value="paypal"
                                                {{ old('payment_method', $payment->payment_method) === 'paypal' ? 'checked' : '' }}
                                            >

                                            <span class="payment-method-box">

                                                <span class="payment-method-top">

                                                    <span class="payment-method-icon">
                                                        <i class="bi bi-paypal"></i>
                                                    </span>

                                                    <span class="payment-radio"></span>

                                                </span>

                                                <strong>
                                                    PayPal
                                                </strong>

                                                <small>
                                                    Pay through your PayPal account.
                                                </small>

                                            </span>

                                        </label>


                                        {{-- Cash on Delivery --}}

                                        <label class="payment-method-option">

                                            <input
                                                type="radio"
                                                name="payment_method"
                                                value="cash_on_delivery"
                                                {{ old('payment_method', $payment->payment_method) === 'cash_on_delivery' ? 'checked' : '' }}
                                            >

                                            <span class="payment-method-box">

                                                <span class="payment-method-top">

                                                    <span class="payment-method-icon">
                                                        <i class="bi bi-cash-stack"></i>
                                                    </span>

                                                    <span class="payment-radio"></span>

                                                </span>

                                                <strong>
                                                    Cash on Delivery
                                                </strong>

                                                <small>
                                                    Pay when your order arrives.
                                                </small>

                                            </span>

                                        </label>

                                    </div>

                                </div>


                                {{-- =================================================
                                   CARD INFORMATION
                                ================================================== --}}

                                <div
                                    class="card-details"
                                    id="cardDetails"
                                >

                                    <div class="payment-section-title">

                                        <div>

                                            <span>
                                                Card information
                                            </span>

                                            <small>
                                                Enter your card details below.
                                            </small>

                                        </div>

                                        <i class="bi bi-credit-card-2-back"></i>

                                    </div>


                                    <div class="row g-3">


                                        {{-- Cardholder Name --}}

                                        <div class="col-12">

                                            <label
                                                for="cardholder_name"
                                                class="payment-label"
                                            >
                                                Cardholder Name
                                            </label>

                                            <div class="payment-input-wrapper">

                                                <input
                                                    type="text"
                                                    id="cardholder_name"
                                                    name="cardholder_name"
                                                    class="payment-input"
                                                    value="{{ old('cardholder_name') }}"
                                                    placeholder="John Doe"
                                                    autocomplete="cc-name"
                                                >

                                                <i class="bi bi-person"></i>

                                            </div>

                                        </div>


                                        {{-- Card Number --}}

                                        <div class="col-12">

                                            <label
                                                for="card_number"
                                                class="payment-label"
                                            >
                                                Card Number
                                            </label>

                                            <div class="payment-input-wrapper">

                                                <input
                                                    type="text"
                                                    id="card_number"
                                                    name="card_number"
                                                    class="payment-input"
                                                    value="{{ old('card_number') }}"
                                                    placeholder="1234 5678 9012 3456"
                                                    inputmode="numeric"
                                                    autocomplete="cc-number"
                                                    maxlength="19"
                                                >

                                                <i class="bi bi-credit-card"></i>

                                            </div>

                                        </div>


                                        {{-- Expiry Date --}}

                                        <div class="col-md-6">

                                            <label
                                                for="expiry_date"
                                                class="payment-label"
                                            >
                                                Expiry Date
                                            </label>

                                            <div class="payment-input-wrapper">

                                                <input
                                                    type="text"
                                                    id="expiry_date"
                                                    name="expiry_date"
                                                    class="payment-input"
                                                    value="{{ old('expiry_date') }}"
                                                    placeholder="MM/YY"
                                                    inputmode="numeric"
                                                    autocomplete="cc-exp"
                                                    maxlength="5"
                                                >

                                                <i class="bi bi-calendar3"></i>

                                            </div>

                                        </div>


                                        {{-- CVV --}}

                                        <div class="col-md-6">

                                            <label
                                                for="cvv"
                                                class="payment-label"
                                            >
                                                CVV
                                            </label>

                                            <div class="payment-input-wrapper">

                                                <input
                                                    type="password"
                                                    id="cvv"
                                                    name="cvv"
                                                    class="payment-input"
                                                    value="{{ old('cvv') }}"
                                                    placeholder="123"
                                                    inputmode="numeric"
                                                    autocomplete="cc-csc"
                                                    maxlength="4"
                                                >

                                                <i class="bi bi-shield-lock"></i>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- =================================================
                                   PAYPAL INFORMATION
                                ================================================== --}}

                                <div
                                    class="paypal-details"
                                    id="paypalDetails"
                                >

                                    <div class="payment-section-title">

                                        <div>

                                            <span>
                                                PayPal information
                                            </span>

                                            <small>
                                                Enter the email address connected to your PayPal account.
                                            </small>

                                        </div>

                                        <i class="bi bi-paypal"></i>

                                    </div>


                                    <div class="paypal-info-box">

                                        <div class="paypal-info-icon">
                                            <i class="bi bi-paypal"></i>
                                        </div>

                                        <div>

                                            <strong>
                                                Pay with PayPal
                                            </strong>

                                            <span>
                                                You can use your PayPal account to complete this payment.
                                            </span>

                                        </div>

                                    </div>


                                    <div class="paypal-input-group">

                                        <label
                                            for="paypal_email"
                                            class="payment-label"
                                        >
                                            PayPal Email
                                        </label>

                                        <div class="payment-input-wrapper">

                                            <input
                                                type="email"
                                                id="paypal_email"
                                                name="paypal_email"
                                                class="payment-input"
                                                value="{{ old('paypal_email') }}"
                                                placeholder="your@email.com"
                                                autocomplete="email"
                                            >

                                            <i class="bi bi-envelope"></i>

                                        </div>

                                    </div>

                                </div>


                                {{-- =================================================
                                   CASH ON DELIVERY
                                ================================================== --}}

                                <div
                                    class="cod-details"
                                    id="codDetails"
                                >

                                    <div class="cod-box">

                                        <div class="cod-icon">
                                            <i class="bi bi-box-seam"></i>
                                        </div>

                                        <div class="cod-content">

                                            <strong>
                                                Cash on Delivery
                                            </strong>

                                            <p>
                                                No card or online payment is required.
                                                You will pay when your order arrives.
                                            </p>

                                            <span>
                                                <i class="bi bi-check-circle-fill"></i>
                                                Your order can be confirmed immediately.
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                {{-- =================================================
                                   SECURITY NOTICE
                                ================================================== --}}

                                <div class="payment-security-note">

                                    <div class="payment-security-note-icon">
                                        <i class="bi bi-shield-check"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            Your payment is secure
                                        </strong>

                                        <p>
                                            Your payment information is handled
                                            securely and protected during checkout.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                           ACTIONS
                        ================================================== --}}

                        <div class="payment-actions">

                            <a
                                href="{{ route('frontend.orders') }}"
                                class="payment-back-btn"
                            >

                                <i class="bi bi-arrow-left"></i>

                                <span>
                                    Back to Orders
                                </span>

                            </a>


                            <button
                                type="submit"
                                class="payment-submit-btn"
                                id="paymentSubmitBtn"
                            >

                                <span id="paymentSubmitText">
                                    Pay ${{ number_format($payment->amount, 2) }}
                                </span>

                                <i class="bi bi-arrow-right"></i>

                            </button>

                        </div>

                    </form>

                </div>


                {{-- =================================================
                   ORDER SUMMARY
                ================================================== --}}

                <div class="col-lg-5">

                    <aside class="payment-summary">


                        {{-- Summary Header --}}

                        <div class="payment-summary-header">

                            <div>

                                <span class="summary-eyebrow">
                                    Your Order
                                </span>

                                <h2>
                                    Order Summary
                                </h2>

                            </div>

                            <span class="summary-order">
                                #{{ $order->order_number }}
                            </span>

                        </div>


                        {{-- Product --}}

                        <div class="payment-product">

                            <div class="payment-product-image">

                                @if($order->book && !empty($order->book->cover))

                                    <img
                                        src="{{ filter_var($order->book->cover, FILTER_VALIDATE_URL)
                                            ? $order->book->cover
                                            : asset('storage/' . $order->book->cover) }}"
                                        alt="{{ $order->book->title }}"
                                    >

                                @else

                                    <div class="payment-product-placeholder">
                                        <i class="bi bi-book"></i>
                                    </div>

                                @endif

                            </div>


                            <div class="payment-product-info">

                                <span>
                                    Book
                                </span>

                                <h3>
                                    {{ $order->book->title ?? 'Book' }}
                                </h3>

                                <p>

                                    <i class="bi bi-box-seam"></i>

                                    {{ $order->quantity }}

                                    {{ $order->quantity == 1 ? 'item' : 'items' }}

                                </p>

                            </div>

                        </div>


                        {{-- Price Details --}}

                        <div class="payment-price-list">

                            <div class="payment-price-row">

                                <span>
                                    Unit Price
                                </span>

                                <strong>
                                    ${{ number_format($order->book_price, 2) }}
                                </strong>

                            </div>


                            <div class="payment-price-row">

                                <span>
                                    Quantity
                                </span>

                                <strong>
                                    ×{{ $order->quantity }}
                                </strong>

                            </div>


                            <div class="payment-price-row">

                                <span>
                                    Shipping
                                </span>

                                <strong class="payment-free">
                                    FREE
                                </strong>

                            </div>

                        </div>


                        <div class="payment-summary-divider"></div>


                        {{-- Total --}}

                        <div class="payment-total">

                            <div>

                                <span>
                                    Total Amount
                                </span>

                                <small>
                                    Including shipping
                                </small>

                            </div>

                            <strong>
                                ${{ number_format($payment->amount, 2) }}
                            </strong>

                        </div>


                        {{-- Pending Status --}}

                        <div class="payment-status">

                            <div class="payment-status-icon">
                                <i class="bi bi-hourglass-split"></i>
                            </div>

                            <div>

                                <strong id="paymentStatusTitle">
                                    Payment Pending
                                </strong>

                                <span id="paymentStatusText">
                                    Complete your payment to continue.
                                </span>

                            </div>

                        </div>


                        {{-- Order Information --}}

                        <div class="payment-order-info">

                            <div>

                                <span>
                                    Order Date
                                </span>

                                <strong>
                                    {{ $order->created_at->format('M d, Y') }}
                                </strong>

                            </div>


                            <div>

                                <span>
                                    Payment Method
                                </span>

                                <strong id="summaryPaymentMethod">

                                    {{ ucwords(
                                        str_replace(
                                            '_',
                                            ' ',
                                            old(
                                                'payment_method',
                                                $payment->payment_method
                                            )
                                        )
                                    ) }}

                                </strong>

                            </div>

                        </div>


                        {{-- Trust Badges --}}

                        <div class="payment-trust">

                            <div>
                                <i class="bi bi-shield-check"></i>
                                <span>Secure</span>
                            </div>

                            <div>
                                <i class="bi bi-lock"></i>
                                <span>Protected</span>
                            </div>

                            <div>
                                <i class="bi bi-headset"></i>
                                <span>Support</span>
                            </div>

                        </div>

                    </aside>

                </div>

            </div>

        </div>

    </section>

</main>

@endsection


@push('js')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const paymentMethods = document.querySelectorAll(
        'input[name="payment_method"]'
    );

    const cardDetails = document.getElementById('cardDetails');
    const paypalDetails = document.getElementById('paypalDetails');
    const codDetails = document.getElementById('codDetails');

    const cardholderName =
        document.getElementById('cardholder_name');

    const cardNumber =
        document.getElementById('card_number');

    const expiryDate =
        document.getElementById('expiry_date');

    const cvv =
        document.getElementById('cvv');

    const paypalEmail =
        document.getElementById('paypal_email');

    const submitText =
        document.getElementById('paymentSubmitText');

    const summaryPaymentMethod =
        document.getElementById('summaryPaymentMethod');

    const paymentStatusTitle =
        document.getElementById('paymentStatusTitle');

    const paymentStatusText =
        document.getElementById('paymentStatusText');


    /*
    |--------------------------------------------------------------------------
    | Enable / Disable Fields
    |--------------------------------------------------------------------------
    */

    function setFieldState(field, enabled) {

        if (!field) {
            return;
        }

        field.disabled = !enabled;

        if (enabled) {
            field.removeAttribute('disabled');
        } else {
            field.setAttribute('disabled', 'disabled');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Expiry Date - MM/YY
    |--------------------------------------------------------------------------
    */

    if (expiryDate) {

        expiryDate.addEventListener('input', function () {

            let value = this.value
                .replace(/\D/g, '')
                .slice(0, 4);

            if (value.length >= 3) {

                value =
                    value.substring(0, 2) +
                    '/' +
                    value.substring(2);
            }

            this.value = value;
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Card Number Formatting
    |--------------------------------------------------------------------------
    */

    if (cardNumber) {

        cardNumber.addEventListener('input', function () {

            let value = this.value
                .replace(/\D/g, '')
                .slice(0, 16);

            value = value.replace(/(.{4})/g, '$1 ').trim();

            this.value = value;
        });
    }


    /*
    |--------------------------------------------------------------------------
    | CVV - Numbers Only
    |--------------------------------------------------------------------------
    */

    if (cvv) {

        cvv.addEventListener('input', function () {

            this.value = this.value
                .replace(/\D/g, '')
                .slice(0, 4);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Update Payment UI
    |--------------------------------------------------------------------------
    */

    function updatePaymentUI() {

        const selected = document.querySelector(
            'input[name="payment_method"]:checked'
        );

        if (!selected) {
            return;
        }

        const method = selected.value;


        /*
        |--------------------------------------------------------------------------
        | Hide Everything
        |--------------------------------------------------------------------------
        */

        cardDetails.style.display = 'none';
        paypalDetails.style.display = 'none';
        codDetails.style.display = 'none';


        /*
        |--------------------------------------------------------------------------
        | Disable All Conditional Fields
        |--------------------------------------------------------------------------
        */

        setFieldState(cardholderName, false);
        setFieldState(cardNumber, false);
        setFieldState(expiryDate, false);
        setFieldState(cvv, false);
        setFieldState(paypalEmail, false);


        /*
        |--------------------------------------------------------------------------
        | Credit / Debit Card
        |--------------------------------------------------------------------------
        */

        if (
            method === 'credit_card' ||
            method === 'debit_card'
        ) {

            cardDetails.style.display = 'block';

            setFieldState(cardholderName, true);
            setFieldState(cardNumber, true);
            setFieldState(expiryDate, true);
            setFieldState(cvv, true);

            submitText.textContent =
                'Pay ${{ number_format($payment->amount, 2) }}';

            paymentStatusTitle.textContent =
                'Payment Pending';

            paymentStatusText.textContent =
                'Complete your card payment to continue.';
        }


        /*
        |--------------------------------------------------------------------------
        | PayPal
        |--------------------------------------------------------------------------
        */

        else if (method === 'paypal') {

            paypalDetails.style.display = 'block';

            setFieldState(paypalEmail, true);

            submitText.textContent =
                'Continue with PayPal';

            paymentStatusTitle.textContent =
                'PayPal Payment';

            paymentStatusText.textContent =
                'Enter your PayPal email to continue.';
        }


        /*
        |--------------------------------------------------------------------------
        | Cash on Delivery
        |--------------------------------------------------------------------------
        */

        else if (method === 'cash_on_delivery') {

            codDetails.style.display = 'block';

            submitText.textContent =
                'Confirm Order';

            paymentStatusTitle.textContent =
                'Cash on Delivery';

            paymentStatusText.textContent =
                'You will pay when your order arrives.';
        }


        /*
        |--------------------------------------------------------------------------
        | Update Summary
        |--------------------------------------------------------------------------
        */

        if (summaryPaymentMethod) {

            const methodNames = {

                credit_card: 'Credit Card',

                debit_card: 'Debit Card',

                paypal: 'PayPal',

                cash_on_delivery: 'Cash on Delivery'
            };

            summaryPaymentMethod.textContent =
                methodNames[method] || method;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Payment Method Change
    |--------------------------------------------------------------------------
    */

    paymentMethods.forEach(function (method) {

        method.addEventListener('change', function () {

            updatePaymentUI();

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Initial State
    |--------------------------------------------------------------------------
    */

    updatePaymentUI();

});
</script>

@endpush

