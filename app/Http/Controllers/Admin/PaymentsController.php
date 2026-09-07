<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function index()
    {
        return view('admin.payments.index');
    }
}