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

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhereHas('author', function ($authorQuery) use ($search) {

                        $authorQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    });

            });
        }

        if ($request->filled('category')) {
            $query->where(
                'category_id',
                $request->category
            );
        }

        if ($request->filled('condition')) {
            $query->where(
                'condition',
                $request->condition
            );
        }

        switch ($request->get('sort')) {

            case 'price_low':

                $query->orderBy('price', 'asc');

                break;

            case 'price_high':

                $query->orderBy('price', 'desc');

                break;

            case 'oldest':

                $query->oldest();

                break;

            default:

                $query->latest();

                break;
        }

        $books = $query
            ->paginate(12)
            ->withQueryString();

        return view(
            'Frontend.books',
            compact('books')
        );
    }
}