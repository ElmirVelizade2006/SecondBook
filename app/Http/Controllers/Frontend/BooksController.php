<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
    {
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

        return view(
            'Frontend.books',
            compact('books')
        );
    }
}