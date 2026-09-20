<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookRequestController extends Controller
{
    /**
     * Display pending seller book requests.
     */
    public function index(Request $request)
    {
        $query = Book::with([
            'seller',
            'category',
            'author',
            'publisher',
        ])
            ->whereNotNull('seller_id')
            ->where('status', 'pending')
            ->latest();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            if ($search !== '') {
                $query->where(function ($q) use ($search) {

                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('isbn', 'LIKE', '%' . $search . '%')

                        ->orWhereHas('seller', function ($sellerQuery) use ($search) {
                            $sellerQuery->where('name', 'LIKE', '%' . $search . '%');
                        })

                        ->orWhereHas('author', function ($authorQuery) use ($search) {
                            $authorQuery->where('name', 'LIKE', '%' . $search . '%');
                        });
                });
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        /*
        |--------------------------------------------------------------------------
        | Results
        |--------------------------------------------------------------------------
        */

        $bookRequests = $query->get();

        return view(
            'admin.book-requests.index',
            compact('bookRequests')
        );
    }

    /**
     * Create page.
     *
     * Book Requests are created from the frontend
     * through Sell a Book, so admin does not need
     * to manually create a request.
     */
    public function create()
    {
        return redirect()
            ->route('admin.book.requests.index');
    }

    /**
     * Store is not used for admin book requests.
     *
     * Seller creates the request from Sell a Book.
     */
    public function store(Request $request)
    {
        return redirect()
            ->route('admin.book.requests.index')
            ->with(
                'error',
                'Book requests are created by sellers from the Sell a Book page.'
            );
    }

    /**
     * Show/edit a seller book request.
     */
    public function edit(Book $request)
    {
        $request->load([
            'seller',
            'category',
            'author',
            'publisher',
        ]);

        return view(
            'admin.book-requests.edit',
            [
                'bookRequest' => $request,
            ]
        );
    }

    /**
     * Update seller book request.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],
        ]);

        $book->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.book.requests.index')
            ->with(
                'success',
                'Book request status updated successfully.'
            );
    }

    /**
     * Delete a seller book request.
     *
     * This deletes the actual book submission.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('admin.book.requests.index')
            ->with(
                'success',
                'Book request deleted successfully.'
            );
    }
}