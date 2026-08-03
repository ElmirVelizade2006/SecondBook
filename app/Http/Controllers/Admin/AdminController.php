<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $recentBooks = Book::latest()->take(1)->get();
        $recentUsers = User::latest()->take(1)->get();
        $recentCategories = Category::latest()->take(1)->get();

        return view('admin.dashboard', [
            'totalBooks' => Book::count(),
            'totalUsers' => User::count(),
            'totalCategories' => Category::count(),
            'totalAuthors' => Author::count(),
            'recentBooks' => $recentBooks,
            'recentUsers' => $recentUsers,
            'recentCategories' => $recentCategories,
        ]);
    }
}
