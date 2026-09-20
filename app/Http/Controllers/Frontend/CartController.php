<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
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
        if ($book->status !== 'approved') {
            return back()->with('error', 'This book is not available for purchase.');
        }

        if ($book->stock <= 0) {
            return back()->with('error', 'This book is currently out of stock.');
        }

        $quantity = max((int) $request->input('quantity', 1), 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            $newQuantity = $cart[$book->id]['quantity'] + $quantity;

            if ($newQuantity > $book->stock) {
                return back()->with(
                    'error',
                    'You cannot add more than the available stock.'
                );
            }

            $cart[$book->id]['quantity'] = $newQuantity;
        } else {
            if ($quantity > $book->stock) {
                return back()->with(
                    'error',
                    'The requested quantity is not available.'
                );
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

        session()->put('cart', $cart);

        return back()->with('success', 'Book added to your cart.');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $bookId)
    {
        $quantity = (int) $request->input('quantity');

        $cart = session()->get('cart', []);

        if (!isset($cart[$bookId])) {
            return back()->with('error', 'This book is not in your cart.');
        }

        $book = Book::find($bookId);

        if (!$book || $book->status !== 'approved') {
            unset($cart[$bookId]);

            session()->put('cart', $cart);

            return back()->with(
                'error',
                'This book is no longer available.'
            );
        }

        if ($quantity <= 0) {
            unset($cart[$bookId]);

            session()->put('cart', $cart);

            return back()->with('success', 'Book removed from your cart.');
        }

        if ($quantity > $book->stock) {
            return back()->with(
                'error',
                'You cannot select more than the available stock.'
            );
        }

        $cart[$bookId]['quantity'] = $quantity;
        $cart[$bookId]['price'] = (float) $book->price;
        $cart[$bookId]['stock'] = $book->stock;

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove a book from the cart.
     */
    public function remove($bookId)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$bookId])) {
            return back()->with('error', 'This book is not in your cart.');
        }

        unset($cart[$bookId]);

        session()->put('cart', $cart);

        return back()->with('success', 'Book removed from your cart.');
    }

    /**
     * Empty the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()
            ->route('frontend.cart')
            ->with('success', 'Your cart has been emptied.');
    }
}