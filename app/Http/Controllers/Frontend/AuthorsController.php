<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;

class AuthorsController extends Controller
{
    /**
     * Display all authors.
     */
    public function index()
    {
        $authors = Author::latest()->get();

        return view('Frontend.authors', compact('authors'));
    }
}