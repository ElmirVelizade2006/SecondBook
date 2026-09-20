<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HelpCenterController extends Controller
{
    /**
     * Display the Help Center page.
     */
    public function index()
    {
        return view('Frontend.help-center');
    }
}