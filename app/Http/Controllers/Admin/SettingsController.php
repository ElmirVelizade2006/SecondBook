<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme' => 'nullable|in:light,dark',
        ]);

        if (!empty($validated['theme'])) {
            session(['admin_theme' => $validated['theme']]);
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
