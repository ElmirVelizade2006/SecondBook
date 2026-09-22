<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreSettingsController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()
                ->route('frontend.home')
                ->with('error', 'Your store could not be found.');
        }

        return view('seller.settings.index', compact('store'));
    }

    public function update(Request $request)
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()
                ->route('frontend.home')
                ->with('error', 'Your store could not be found.');
        }

        $validated = $request->validate([
            'processing_time' => [
                'required',
                'integer',
                'min:1',
                'max:30',
            ],

            'minimum_order_amount' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
            ],

            'order_note' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'accept_orders' => [
                'nullable',
                'boolean',
            ],

            'auto_approve_orders' => [
                'nullable',
                'boolean',
            ],
        ]);

        $store->update([
            'accept_orders' => $request->boolean('accept_orders'),
            'auto_approve_orders' => $request->boolean('auto_approve_orders'),
            'processing_time' => $validated['processing_time'],
            'minimum_order_amount' => $validated['minimum_order_amount'],
            'order_note' => $validated['order_note'] ?? null,
        ]);

        return redirect()
            ->route('seller.settings')
            ->with('success', 'Store settings updated successfully.');
    }
}