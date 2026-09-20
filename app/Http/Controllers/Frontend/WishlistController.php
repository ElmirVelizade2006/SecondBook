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

    public function add(Book $book)
    {
        if ($book->status !== 'approved') {
            return back()->with(
                'error',
                'This book is not available.'
            );
        }

        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);

        return back()->with(
            'success',
            'Book added to your wishlist.'
        );
    }

    public function remove(Book $book)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->delete();

        return back()->with(
            'success',
            'Book removed from your wishlist.'
        );
    }
}