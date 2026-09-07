<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BackupController extends Controller
{
    public function index()
    {
        return view('admin.backup.index');
    }
}