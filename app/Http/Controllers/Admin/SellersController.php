<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SellersController extends Controller
{
    public function index()
    {
        return view('admin.sellers.index');
    }
}