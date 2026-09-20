<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellBookController extends Controller
{
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        $authors = Author::orderBy('name')->get();

        $publishers = Publisher::orderBy('name')->get();

        return view('Frontend.sell-book', compact(
            'categories',
            'authors',
            'publishers'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'isbn' => [
                'nullable',
                'string',
                'max:50',
            ],

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'author_id' => [
                'required',
                'exists:authors,id',
            ],

            'publisher_id' => [
                'nullable',
                'exists:publishers,id',
            ],

            'description' => [
                'required',
                'string',
                'max:5000',
            ],

            'cover' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'publication_year' => [
                'nullable',
                'integer',
                'min:1000',
                'max:' . date('Y'),
            ],

            'pages' => [
                'nullable',
                'integer',
                'min:1',
                'max:100000',
            ],

            'language' => [
                'required',
                'string',
                'max:50',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'stock' => [
                'required',
                'integer',
                'min:1',
                'max:999999',
            ],

            'condition' => [
                'required',
                'in:new,like_new,good,fair',
            ],
        ]);

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')
                ->store('books/covers', 'public');
        }

        Book::create([
            'title' => $validated['title'],
            'isbn' => $validated['isbn'] ?? null,
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'publisher_id' => $validated['publisher_id'] ?? null,

            'seller_id' => Auth::id(),

            'description' => $validated['description'],

            'cover' => $coverPath,

            'publication_year' =>
                $validated['publication_year'] ?? null,

            'pages' =>
                $validated['pages'] ?? null,

            'language' => $validated['language'],

            'price' => $validated['price'],

            'stock' => $validated['stock'],

            'condition' => $validated['condition'],

            'status' => 'pending',
        ]);

        return redirect()
            ->route('frontend.sell-book')
            ->with(
                'success',
                'Your book has been submitted successfully and is waiting for admin approval.'
            );
    }
}