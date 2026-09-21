<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Checkout Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
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

        return view('Frontend.checkout', compact(
            'cart',
            'subtotal',
            'totalItems'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Place Order
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Customer Information
        |--------------------------------------------------------------------------
        */
        

        $validated = $request->validate([
            'full_name' => [
                'required',
                'string',
                'max:255'
            ],

            'phone' => [
                'required',
                'string',
                'max:50'
            ],

            'country' => [
                'required',
                'string',
                'max:100'
            ],

            'city' => [
                'required',
                'string',
                'max:100'
            ],

            'postal_code' => [
                'nullable',
                'string',
                'max:20'
            ],

            'address' => [
                'required',
                'string',
                'max:1000'
            ],

            'note' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'payment_method' => [
                'required',
                'in:cash_on_delivery,credit_card,debit_card,paypal'
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Get Cart
        |--------------------------------------------------------------------------
        */

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('frontend.cart')
                ->with('error', 'Your cart is empty.');
        }

        /*
        |--------------------------------------------------------------------------
        | Store Created Orders
        |--------------------------------------------------------------------------
        */

        $createdOrders = [];

        try {
            /*
            |--------------------------------------------------------------------------
            | Database Transaction
            |--------------------------------------------------------------------------
            */

            DB::transaction(function () use (
                $cart,
                $validated,
                &$createdOrders
            ) {
                foreach ($cart as $bookId => $item) {

                    /*
                    |--------------------------------------------------------------------------
                    | Lock Book Row
                    |--------------------------------------------------------------------------
                    */

                    $book = Book::whereKey($bookId)
                        ->lockForUpdate()
                        ->first();

                    /*
                    |--------------------------------------------------------------------------
                    | Check Book
                    |--------------------------------------------------------------------------
                    */

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

                    /*
                    |--------------------------------------------------------------------------
                    | Check Quantity
                    |--------------------------------------------------------------------------
                    */

                    $quantity = (int) $item['quantity'];

                    if ($quantity <= 0) {
                        throw new \Exception(
                            "Invalid quantity for \"{$book->title}\"."
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Check Stock
                    |--------------------------------------------------------------------------
                    */

                    if ($book->stock < $quantity) {
                        throw new \Exception(
                            "There is not enough stock for \"{$book->title}\"."
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Calculate Price
                    |--------------------------------------------------------------------------
                    */

                    $bookPrice = (float) $book->price;

                    $totalPrice = $bookPrice * $quantity;

                    /*
                    |--------------------------------------------------------------------------
                    | Generate Unique Order Number
                    |--------------------------------------------------------------------------
                    */

                    $orderNumber = 'SB-' .
                        now()->format('YmdHis') .
                        '-' .
                        strtoupper(Str::random(6));

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
                        'total_price' => $totalPrice,

                        'payment_method' =>
                            $validated['payment_method'],

                        'payment_status' => 'pending',

                        'order_status' => 'pending',

                        'full_name' =>
                            $validated['full_name'],

                        'phone' =>
                            $validated['phone'],

                        'country' =>
                            $validated['country'],

                        'city' =>
                            $validated['city'],

                        'postal_code' =>
                            $validated['postal_code'] ?? null,

                        'address' =>
                            $validated['address'],

                        'note' =>
                            $validated['note'] ?? null,
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | Create Payment
                    |--------------------------------------------------------------------------
                    */

                    Payment::create([
                        'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
                        'order_id' => $order->id,
                        'amount' => $totalPrice,
                        'payment_method' => $validated['payment_method'],
                        'payment_status' => 'pending',
                        'paid_at' => null,
                        'note' => null,
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | Save Created Order
                    |--------------------------------------------------------------------------
                    */

                    $createdOrders[] = $order;

                    /*
                    |--------------------------------------------------------------------------
                    | Decrease Stock
                    |--------------------------------------------------------------------------
                    */

                    $book->decrement(
                        'stock',
                        $quantity
                    );
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

            $firstOrder = $createdOrders[0] ?? null;

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

            /*
            |--------------------------------------------------------------------------
            | Transaction Error
            |--------------------------------------------------------------------------
            */

                dd(
                    'CHECKOUT ERROR',
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine()
                );
        }
    }
}