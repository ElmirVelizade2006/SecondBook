<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller
{
    /**
     * Display the Privacy Policy page.
     */
    public function index()
    {
        return view('Frontend.privacy-policy');
    }
}

