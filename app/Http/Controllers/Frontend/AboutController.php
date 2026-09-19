<?php

namespace App\Http\Controllers\Frontend;

class AboutController extends Controller
{
    public function index()
    {
        return view('Frontend.about');
    }
}