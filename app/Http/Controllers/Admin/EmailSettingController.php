<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EmailSettingController extends Controller
{
    public function index()
    {
        return view('admin.email-settings.index');
    }
}