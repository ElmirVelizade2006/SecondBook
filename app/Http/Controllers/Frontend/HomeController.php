<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | FEATURED BOOKS
        |--------------------------------------------------------------------------
        */

        $featuredBooks = Book::with('author')
            ->where('status', 'approved')
            ->latest()
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | BASE BOOK QUERY
        |--------------------------------------------------------------------------
        */

        $baseQuery = function () {
            return Book::with('author')
                ->where('status', 'approved');
        };


        /*
        |--------------------------------------------------------------------------
        | BEST SELLING
        |--------------------------------------------------------------------------
        */

        $bestSellingBooks = $baseQuery()
            ->leftJoin(
                DB::raw(
                    '(SELECT book_id, SUM(quantity) as total_sold
                      FROM orders
                      GROUP BY book_id) as sales'
                ),
                'books.id',
                '=',
                'sales.book_id'
            )
            ->select('books.*')
            ->orderByDesc(DB::raw('COALESCE(sales.total_sold, 0)'))
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TRENDING
        |--------------------------------------------------------------------------
        */

        $trendingBooks = $baseQuery()
            ->latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | NEW ARRIVALS
        |--------------------------------------------------------------------------
        */

        $newArrivals = $baseQuery()
            ->latest('created_at')
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | EDITOR PICKS
        |--------------------------------------------------------------------------
        */

        $editorPicks = $baseQuery()
            ->latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | MOST LOVED
        |--------------------------------------------------------------------------
        */

        $mostLovedBooks = $baseQuery()
            ->latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | BUDGET DEALS
        |--------------------------------------------------------------------------
        */

        $budgetDeals = $baseQuery()
            ->orderBy('price', 'asc')
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SPECIAL OFFERS
        |--------------------------------------------------------------------------
        | Currently showing the cheapest approved books.
        |--------------------------------------------------------------------------
        */

        $specialOffers = Book::with('author')
            ->where('status', 'approved')
            ->orderBy('price', 'asc')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | HOME PAGE
        |--------------------------------------------------------------------------
        */

        return view('Frontend.home', compact(
            'categories',
            'featuredBooks',
            'bestSellingBooks',
            'trendingBooks',
            'newArrivals',
            'editorPicks',
            'mostLovedBooks',
            'budgetDeals',
            'specialOffers'
        ));
    }
}

