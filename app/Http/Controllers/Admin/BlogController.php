<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('author');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $blogs = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = Auth::id();

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('blogs', 'public');
        }

        Blog::create($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = $blog->published_at ?? now();
        }

        if ($validated['status'] === 'draft') {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $validated['image'] = $request->file('image')
                ->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}