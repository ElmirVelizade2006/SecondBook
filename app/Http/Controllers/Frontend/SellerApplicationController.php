<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SellerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SellerApplicationController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->isSeller()) {
            return redirect()
                ->route('frontend.home')
                ->with('info', 'You are already a seller.');
        }

        $application = $user->sellerApplications()
            ->latest()
            ->first();

        return view('Frontend.seller-application', compact('application'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->isSeller()) {
            return redirect()
                ->route('frontend.home')
                ->with('info', 'You are already a seller.');
        }

        $existingApplication = $user->sellerApplications()
            ->where('status', 'pending')
            ->exists();

        if ($existingApplication) {
            return back()
                ->with('info', 'You already have a pending seller application.');
        }

        $validated = $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:1000'],
        ]);

        SellerApplication::create([
            'user_id' => $user->id,
            'store_name' => $validated['store_name'],
            'description' => $validated['description'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('frontend.seller-application')
            ->with(
                'success',
                'Your seller application has been submitted successfully and is waiting for admin approval.'
            );
    }
}