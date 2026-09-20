<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ShippingInformationController extends Controller
{
    /**
     * Display the Shipping Information page.
     */
    public function index()
    {
        return view('Frontend.shipping-information');
    }
}

