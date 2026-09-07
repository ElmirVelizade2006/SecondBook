<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RefundsController extends Controller
{
    public function index()
    {
        return view('admin.refunds.index');
    }
}