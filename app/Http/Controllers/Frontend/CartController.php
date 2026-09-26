<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Setting;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $totalItems = collect($cart)->sum('quantity');

        return view('Frontend.cart', compact(
            'cart',
            'subtotal',
            'totalItems'
        ));
    }

    /**
     * Add a book to the cart.
     */
    public function add(Request $request, Book $book)
    {
        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        if ($book->status !== 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'This book is not available for purchase.',
            ], 422);
        }

        if ($book->stock <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'This book is currently out of stock.',
            ], 422);
        }

        $quantity = max(
            (int) $request->input('quantity', 1),
            1
        );

        $cart = session()->get('cart', []);

        /*
        |--------------------------------------------------------------------------
        | BOOK ALREADY EXISTS
        |--------------------------------------------------------------------------
        */

        if (isset($cart[$book->id])) {
            $newQuantity =
                $cart[$book->id]['quantity'] + $quantity;

            if ($newQuantity > $book->stock) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'You cannot add more than the available stock.',
                ], 422);
            }

            $cart[$book->id]['quantity'] = $newQuantity;
        }

        /*
        |--------------------------------------------------------------------------
        | NEW BOOK
        |--------------------------------------------------------------------------
        */

        else {
            if ($quantity > $book->stock) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'The requested quantity is not available.',
                ], 422);
            }

            $cart[$book->id] = [
                'id' => $book->id,
                'title' => $book->title,
                'price' => (float) $book->price,
                'cover' => $book->cover,
                'quantity' => $quantity,
                'stock' => $book->stock,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE CART
        |--------------------------------------------------------------------------
        */

        session()->put('cart', $cart);

        /*
        |--------------------------------------------------------------------------
        | TOTAL CART ITEMS
        |--------------------------------------------------------------------------
        */

        $cartCount = collect($cart)->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | AJAX RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'message' =>
                'Book added to cart successfully!',
            'cart_count' => $cartCount,
        ]);
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $bookId)
    {
        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        $quantity = (int) $request->input('quantity');

        $cart = session()->get('cart', []);

        if (!isset($cart[$bookId])) {
            return response()->json([
                'success' => false,
                'message' => 'This book is not in your cart.',
            ], 404);
        }

        $book = Book::find($bookId);

        if (!$book || $book->status !== 'approved') {

            unset($cart[$bookId]);

            session()->put('cart', $cart);

            return response()->json([
                'success' => false,
                'message' => 'This book is no longer available.',
                'removed' => true,
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | REMOVE ITEM WHEN QUANTITY IS ZERO
        |--------------------------------------------------------------------------
        */

        if ($quantity <= 0) {

            unset($cart[$bookId]);

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Book removed from your cart.',
                'removed' => true,
                'total_items' => collect($cart)->sum('quantity'),
                'subtotal' => collect($cart)->sum(function ($item) {
                    return $item['price'] * $item['quantity'];
                }),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | STOCK VALIDATION
        |--------------------------------------------------------------------------
        */

        if ($quantity > $book->stock) {
            return response()->json([
                'success' => false,
                'message' =>
                    'You cannot select more than the available stock.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE CART ITEM
        |--------------------------------------------------------------------------
        */

        $cart[$bookId]['quantity'] = $quantity;
        $cart[$bookId]['price'] = (float) $book->price;
        $cart[$bookId]['stock'] = $book->stock;

        session()->put('cart', $cart);

        /*
        |--------------------------------------------------------------------------
        | RECALCULATE CART TOTALS
        |--------------------------------------------------------------------------
        */

        $totalItems = collect($cart)->sum('quantity');

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        /*
        |--------------------------------------------------------------------------
        | SHIPPING
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

        /*
        |--------------------------------------------------------------------------
        | CURRENT ITEM TOTAL
        |--------------------------------------------------------------------------
        */

        $itemTotal =
            (float) $cart[$bookId]['price'] *
            (int) $cart[$bookId]['quantity'];

        /*
        |--------------------------------------------------------------------------
        | AJAX RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.',

            'item_total' => $itemTotal,

            'total_items' => $totalItems,

            'subtotal' => $subtotal,

            'shipping_enabled' => (bool) $shippingEnabled,

            'shipping_fee' => $shippingFee,

            'grand_total' => $grandTotal,
        ]);
    }

    /**
     * Remove a book from the cart.
     */
    public function remove($bookId)
    {
        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        $cart = session()->get('cart', []);

        if (!isset($cart[$bookId])) {
            return back()->with(
                'error',
                'This book is not in your cart.'
            );
        }

        unset($cart[$bookId]);

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Book removed from your cart.'
        );
    }

    /**
     * Empty the entire cart.
     */
    public function clear()
    {
        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        session()->forget('cart');

        return redirect()
            ->route('frontend.cart')
            ->with(
                'success',
                'Your cart has been emptied.'
            );
    }
}