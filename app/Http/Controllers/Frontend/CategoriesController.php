<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display all categories.
     */
    public function index()
    {
        $categories = Category::latest()->get();

        return view('Frontend.categories', compact('categories'));
    }
}