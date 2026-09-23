<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of banners.
     */
    public function index(Request $request)
    {
        $query = Banner::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('subtitle', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Order by position first, then newest
        $banners = $query
            ->orderBy('position')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created banner.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',

            'position' => 'required|integer|min:0',

            'status' => 'required|in:active,inactive',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Upload image
        $validated['image'] = $request->file('image')
            ->store('banners', 'public');

        Banner::create($validated);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified banner.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',

            'position' => 'required|integer|min:0',

            'status' => 'required|in:active,inactive',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Replace image if a new one was uploaded
        if ($request->hasFile('image')) {

            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $validated['image'] = $request->file('image')
                ->store('banners', 'public');
        }

        $banner->update($validated);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified banner.
     */
    public function destroy(Banner $banner)
    {
        // Delete image from storage
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
}