<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ReturnPolicyController extends Controller
{
    /**
     * Display the Return Policy page.
     */
    public function index()
    {
        return view('Frontend.return-policy');
    }
}

