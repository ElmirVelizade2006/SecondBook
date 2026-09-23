<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | MARKETPLACE STATUS
        |--------------------------------------------------------------------------
        */

        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        $query = Book::with(['author', 'category'])
            ->where('status', 'approved');

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            if ($search !== '') {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('isbn', 'LIKE', "%{$search}%")
                        ->orWhereHas('author', function ($authorQuery) use ($search) {
                            $authorQuery->where(
                                'name',
                                'LIKE',
                                "%{$search}%"
                            );
                        })
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where(
                                'name',
                                'LIKE',
                                "%{$search}%"
                            );
                        });
                });
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {
            $query->where(
                'category_id',
                $request->input('category')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CONDITION
        |--------------------------------------------------------------------------
        */

        if ($request->filled('condition')) {
            $query->where(
                'condition',
                $request->input('condition')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SORT
        |--------------------------------------------------------------------------
        */

        switch ($request->input('sort')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('price', 'desc');
                break;

            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $books = $query
            ->paginate(12)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = Category::orderBy('name', 'asc')->get();

        return view(
            'Frontend.books',
            compact(
                'books',
                'categories'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | BOOK DETAILS
    |--------------------------------------------------------------------------
    */

    public function show(Book $book)
    {
        /*
        |--------------------------------------------------------------------------
        | MARKETPLACE STATUS
        |--------------------------------------------------------------------------
        */

        if (!Setting::get('marketplace_enabled', true)) {
            abort(503);
        }

        /*
        |--------------------------------------------------------------------------
        | Only approved books can be viewed.
        |--------------------------------------------------------------------------
        */

        if ($book->status !== 'approved') {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Load relationships needed for the details page.
        |--------------------------------------------------------------------------
        */

        $book->load([
            'author',
            'category',
            'publisher',
            'seller',
        ]);

        return view(
            'Frontend.book-details',
            compact('book')
        );
    }
}