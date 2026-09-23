<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('frontend.cart')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $totalItems = collect($cart)->sum('quantity');

        $shippingEnabled = Setting::get('shipping_enabled', true);

        $defaultShippingFee = (float) Setting::get(
            'default_shipping_fee',
            0
        );

        $freeShippingThreshold = (float) Setting::get(
            'free_shipping_threshold',
            0
        );

        $defaultCountry = Setting::get('default_country');

        $estimatedDeliveryMessage = Setting::get(
            'estimated_delivery_message',
            ''
        );

        $shippingFee = 0;

        if ($shippingEnabled) {
            if (
                $freeShippingThreshold <= 0 ||
                $subtotal < $freeShippingThreshold
            ) {
                $shippingFee = $defaultShippingFee;
            }
        }

        $grandTotal = $subtotal + $shippingFee;

        $paymentsEnabled = Setting::get(
            'payments_enabled',
            true
        );

        $paymentMethods = Setting::get(
            'payment_methods',
            [
                'cash_on_delivery',
                'credit_card',
                'debit_card',
                'paypal',
            ]
        );

        if (!is_array($paymentMethods)) {
            $paymentMethods = [
                'cash_on_delivery',
                'credit_card',
                'debit_card',
                'paypal',
            ];
        }

        $defaultPaymentMethod = Setting::get(
            'default_payment_method',
            'cash_on_delivery'
        );

        return view(
            'Frontend.checkout',
            compact(
                'cart',
                'subtotal',
                'totalItems',
                'shippingEnabled',
                'shippingFee',
                'freeShippingThreshold',
                'grandTotal',
                'defaultCountry',
                'estimatedDeliveryMessage',
                'paymentsEnabled',
                'paymentMethods',
                'defaultPaymentMethod'
            )
        );
    }

    public function store(Request $request)
    {
        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('frontend.cart')
                ->with('error', 'Your cart is empty.');
        }

        $paymentsEnabled = Setting::get(
            'payments_enabled',
            true
        );

        $allowedPaymentMethods = Setting::get(
            'payment_methods',
            [
                'cash_on_delivery',
                'credit_card',
                'debit_card',
                'paypal',
            ]
        );

        if (!is_array($allowedPaymentMethods)) {
            $allowedPaymentMethods = [
                'cash_on_delivery',
                'credit_card',
                'debit_card',
                'paypal',
            ];
        }

        $validated = $request->validate([
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:50',
            ],
            'country' => [
                'required',
                'string',
                'max:100',
            ],
            'city' => [
                'required',
                'string',
                'max:100',
            ],
            'postal_code' => [
                'nullable',
                'string',
                'max:20',
            ],
            'address' => [
                'required',
                'string',
                'max:1000',
            ],
            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'payment_method' => [
                'required',
                'string',
                'in:cash_on_delivery,credit_card,debit_card,paypal',
            ],
        ]);

        if (!$paymentsEnabled) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payments are currently disabled.'
                );
        }

        if (
            !in_array(
                $validated['payment_method'],
                $allowedPaymentMethods,
                true
            )
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'The selected payment method is currently unavailable.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Shipping Settings
        |--------------------------------------------------------------------------
        */

        $shippingEnabled = Setting::get(
            'shipping_enabled',
            true
        );

        $defaultShippingFee = (float) Setting::get(
            'default_shipping_fee',
            0
        );

        $freeShippingThreshold = (float) Setting::get(
            'free_shipping_threshold',
            0
        );

        $estimatedDeliveryMessage = Setting::get(
            'estimated_delivery_message',
            ''
        );

        /*
        |--------------------------------------------------------------------------
        | Calculate Cart Subtotal
        |--------------------------------------------------------------------------
        */

        $cartSubtotal = collect($cart)->sum(function ($item) {
            return (float) $item['price'] * (int) $item['quantity'];
        });

        /*
        |--------------------------------------------------------------------------
        | Calculate Shipping Once For The Whole Checkout
        |--------------------------------------------------------------------------
        */

        $cartShippingFee = 0;

        if ($shippingEnabled) {
            if (
                $freeShippingThreshold <= 0 ||
                $cartSubtotal < $freeShippingThreshold
            ) {
                $cartShippingFee = $defaultShippingFee;
            }
        }

        $createdOrders = [];

        try {
            DB::transaction(function () use (
                $cart,
                $validated,
                &$createdOrders,
                $shippingEnabled,
                $cartShippingFee,
                $freeShippingThreshold,
                $estimatedDeliveryMessage
            ) {
                $cartBookCount = count($cart);
                $orderIndex = 0;

                foreach ($cart as $bookId => $item) {
                    $book = Book::with('seller.store')
                        ->whereKey($bookId)
                        ->lockForUpdate()
                        ->first();

                    if (!$book) {
                        throw new \Exception(
                            'One of the books in your cart no longer exists.'
                        );
                    }

                    if ($book->status !== 'approved') {
                        throw new \Exception(
                            "\"{$book->title}\" is no longer available."
                        );
                    }

                    if (!$book->seller) {
                        throw new \Exception(
                            "\"{$book->title}\" does not have an active seller."
                        );
                    }

                    $store = $book->seller->store;

                    if (!$store) {
                        throw new \Exception(
                            "\"{$book->title}\" seller store could not be found."
                        );
                    }

                    if (!$store->accept_orders) {
                        throw new \Exception(
                            "This store is currently not accepting orders for \"{$book->title}\"."
                        );
                    }

                    $quantity = (int) $item['quantity'];

                    if ($quantity <= 0) {
                        throw new \Exception(
                            "Invalid quantity for \"{$book->title}\"."
                        );
                    }

                    if ($book->stock < $quantity) {
                        throw new \Exception(
                            "There is not enough stock for \"{$book->title}\"."
                        );
                    }

                    $bookPrice = (float) $book->price;
                    $bookTotal = $bookPrice * $quantity;

                    /*
                    |--------------------------------------------------------------------------
                    | Minimum Order Amount
                    |--------------------------------------------------------------------------
                    */

                    $minimumOrderAmount = (float) Setting::get(
                        'minimum_order_amount',
                        0
                    );

                    $storeMinimumOrderAmount =
                        (float) $store->minimum_order_amount;

                    $effectiveMinimumOrderAmount =
                        $storeMinimumOrderAmount > 0
                            ? $storeMinimumOrderAmount
                            : $minimumOrderAmount;

                    if (
                        $effectiveMinimumOrderAmount > 0 &&
                        $bookTotal < $effectiveMinimumOrderAmount
                    ) {
                        throw new \Exception(
                            "The minimum order amount is ₼" .
                            number_format(
                                $effectiveMinimumOrderAmount,
                                2
                            ) .
                            "."
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Shipping Allocation
                    |--------------------------------------------------------------------------
                    |
                    | Checkout shipping is calculated once for the whole cart.
                    | Since every book creates a separate Order record, the
                    | shipping fee is assigned to the first created order.
                    |
                    */

                    $shippingFee = 0;

                    if (
                        $shippingEnabled &&
                        $cartShippingFee > 0 &&
                        $orderIndex === 0
                    ) {
                        $shippingFee = $cartShippingFee;
                    }

                    $grandTotal =
                        $bookTotal + $shippingFee;

                    /*
                    |--------------------------------------------------------------------------
                    | Order Status
                    |--------------------------------------------------------------------------
                    */

                    $configuredOrderStatus = Setting::get(
                        'default_order_status',
                        null
                    );

                    $orderStatus = $store->auto_approve_orders
                        ? 'processing'
                        : ($configuredOrderStatus ?: 'pending');

                    /*
                    |--------------------------------------------------------------------------
                    | Processing Deadline
                    |--------------------------------------------------------------------------
                    */

                    $processingDeadline = now()->addDays(
                        $store->processing_time
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Order Number
                    |--------------------------------------------------------------------------
                    */

                    $orderNumberFormat = Setting::get(
                        'order_number_format',
                        'SB-{YmdHis}-{random}'
                    );

                    $orderNumber = str_replace(
                        [
                            '{Y}',
                            '{m}',
                            '{d}',
                            '{H}',
                            '{i}',
                            '{s}',
                            '{YmdHis}',
                            '{random}',
                        ],
                        [
                            now()->format('Y'),
                            now()->format('m'),
                            now()->format('d'),
                            now()->format('H'),
                            now()->format('i'),
                            now()->format('s'),
                            now()->format('YmdHis'),
                            strtoupper(Str::random(6)),
                        ],
                        $orderNumberFormat
                    );

                    if (
                        empty(trim($orderNumber)) ||
                        $orderNumber === $orderNumberFormat
                    ) {
                        $orderNumber =
                            'SB-' .
                            now()->format('YmdHis') .
                            '-' .
                            strtoupper(Str::random(6));
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Create Order
                    |--------------------------------------------------------------------------
                    */

                    $order = Order::create([
                        'order_number' => $orderNumber,
                        'user_id' => auth()->id(),
                        'book_id' => $book->id,
                        'book_price' => $bookPrice,
                        'quantity' => $quantity,
                        'total_price' => $grandTotal,
                        'shipping_fee' => $shippingFee,
                        'payment_method' => $validated['payment_method'],
                        'payment_status' => 'pending',
                        'order_status' => $orderStatus,
                        'processing_deadline' => $processingDeadline,
                        'order_note' => $store->order_note,
                        'full_name' => $validated['full_name'],
                        'phone' => $validated['phone'],
                        'country' => $validated['country'],
                        'city' => $validated['city'],
                        'postal_code' => $validated['postal_code'] ?? null,
                        'address' => $validated['address'],
                        'delivery_estimate' => $estimatedDeliveryMessage,
                        'note' => $validated['note'] ?? null,
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | Create Payment
                    |--------------------------------------------------------------------------
                    */

                    Payment::create([
                        'transaction_id' =>
                            'TXN-' .
                            strtoupper(
                                Str::random(12)
                            ),
                        'order_id' => $order->id,
                        'amount' => $grandTotal,
                        'payment_method' => $validated['payment_method'],
                        'payment_status' => 'pending',
                        'paid_at' => null,
                        'note' => null,
                    ]);

                    $createdOrders[] = $order;

                    /*
                    |--------------------------------------------------------------------------
                    | Reduce Stock
                    |--------------------------------------------------------------------------
                    */

                    $book->decrement(
                        'stock',
                        $quantity
                    );

                    $orderIndex++;
                }
            });

            /*
            |--------------------------------------------------------------------------
            | Clear Cart
            |--------------------------------------------------------------------------
            */

            session()->forget('cart');

            /*
            |--------------------------------------------------------------------------
            | Cash on Delivery
            |--------------------------------------------------------------------------
            */

            if (
                $validated['payment_method'] ===
                'cash_on_delivery'
            ) {
                return redirect()
                    ->route('frontend.orders')
                    ->with(
                        'success',
                        'Your order has been placed successfully.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Online Payment
            |--------------------------------------------------------------------------
            */

            $firstOrder =
                $createdOrders[0] ?? null;

            if (!$firstOrder) {
                return redirect()
                    ->route('frontend.orders')
                    ->with(
                        'error',
                        'Order could not be created.'
                    );
            }

            return redirect()
                ->route(
                    'frontend.payment',
                    $firstOrder->id
                );

        } catch (\Exception $e) {
            return redirect()
                ->route('frontend.cart')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }
}
