<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with([
            'book.author',
            'book.category',
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);

        return view('Frontend.wishlist', compact('wishlists'));
    }

    public function add(Request $request, Book $book)
    {
        if ($book->status !== 'approved') {

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This book is not available.',
                ], 422);
            }

            return back()->with(
                'error',
                'This book is not available.'
            );
        }

        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Book added to your wishlist.',
            ]);
        }

        return back()->with(
            'success',
            'Book added to your wishlist.'
        );
    }

    public function remove(Request $request, Book $book)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Book removed from your wishlist.',
            ]);
        }

        return back()->with(
            'success',
            'Book removed from your wishlist.'
        );
    }
}