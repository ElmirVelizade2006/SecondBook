<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->with(['category', 'author', 'seller'])
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhereHas('author', function ($authorQuery) use ($search) {
                            $authorQuery->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('seller', function ($sellerQuery) use ($search) {
                            $sellerQuery->where('name', 'like', '%' . $search . '%');
                        });
                    });
            })
            ->when(request('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->when(request('condition'), function ($query, $condition) {
                $query->where('condition', $condition);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $authors    = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        $sellers    = User::orderBy('name')->get();

        return view('admin.books.create', compact('categories', 'authors', 'publishers', 'sellers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|max:255',
            'isbn'             => 'nullable|string|max:20',
            'category_id'      => 'nullable|exists:categories,id',
            'author_id'        => 'nullable|exists:authors,id',
            'publisher_id'     => 'nullable|exists:publishers,id',
            'seller_id'        => 'nullable|exists:users,id',
            'price'            => 'nullable|numeric|min:0',
            'stock'            => 'nullable|integer|min:0',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'pages'            => 'nullable|integer|min:1',
            'cover'            => 'nullable|image|max:2048',
            'condition'        => 'nullable|in:new,like_new,good,fair',
            'status'           => 'nullable|in:pending,approved,rejected',
        ]);

        $image = null;

        if ($request->hasFile('cover')) {
            $image = $request->file('cover')->store('books', 'public');
        }

        Book::create([
            'title'            => $request->title,
            'isbn'             => $request->isbn,
            'category_id'      => $request->category_id,
            'author_id'        => $request->author_id,
            'publisher_id'     => $request->publisher_id,
            'seller_id'        => $request->seller_id,
            'description'      => $request->description,
            'cover'            => $image,
            'publication_year' => $request->publication_year,
            'pages'            => $request->pages,
            'language'         => $request->language ?? 'English',
            'price'            => $request->price ?? 0,
            'stock'            => $request->stock ?? 1,
            'condition'        => $request->condition ?? 'good',
            'status'           => $request->status ?? 'pending',
        ]);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Book added successfully');

    }

    public function show(Book $book)
    {
        $book->load(['category', 'author', 'publisher', 'seller']);

        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        $authors    = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        $sellers    = User::orderBy('name')->get();

        return view('admin.books.edit', compact('book', 'categories', 'authors', 'publishers', 'sellers'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'            => 'required|max:255',
            'isbn'             => 'nullable|string|max:20',
            'category_id'      => 'nullable|exists:categories,id',
            'author_id'        => 'nullable|exists:authors,id',
            'publisher_id'     => 'nullable|exists:publishers,id',
            'seller_id'        => 'nullable|exists:users,id',
            'price'            => 'nullable|numeric|min:0',
            'stock'            => 'nullable|integer|min:0',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'pages'            => 'nullable|integer|min:1',
            'cover'            => 'nullable|image|max:2048',
            'condition'        => 'nullable|in:new,like_new,good,fair',
            'status'           => 'nullable|in:pending,approved,rejected',
        ]);

        $image = $book->cover;

        if ($request->hasFile('cover')) {
            if (!empty($book->cover) && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            $image = $request->file('cover')->store('books', 'public');
        }

        $book->update([
            'title'            => $request->title,
            'isbn'             => $request->isbn,
            'category_id'      => $request->category_id,
            'author_id'        => $request->author_id,
            'publisher_id'     => $request->publisher_id,
            'seller_id'        => $request->seller_id,
            'description'      => $request->description,
            'cover'            => $image,
            'publication_year' => $request->publication_year,
            'pages'            => $request->pages,
            'language'         => $request->language ?? 'English',
            'price'            => $request->price ?? 0,
            'stock'            => $request->stock ?? 1,
            'condition'        => $request->condition ?? 'good',
            'status'           => $request->status ?? 'pending',
        ]);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        if (!empty($book->cover) && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Book deleted successfully');
    }
}
