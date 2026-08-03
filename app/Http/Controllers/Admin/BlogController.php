<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index');
    }
}