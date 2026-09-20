<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display FAQ list.
     */
    public function index(Request $request)
    {
        $query = Faq::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', '%' . $search . '%')
                    ->orWhere('answer', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {
            $query->where(
                'is_active',
                $request->status === '1'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FAQ List
        |--------------------------------------------------------------------------
        */

        $faqs = $query
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Faq::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.faq.index', compact(
            'faqs',
            'categories'
        ));
    }

    /**
     * Show create FAQ form.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store new FAQ.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'question' => [
                'required',
                'string',
                'max:255',
            ],

            'answer' => [
                'required',
                'string',
                'max:5000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        Faq::create([
            'category' => $validated['category'],
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.faq.index')
            ->with(
                'success',
                'FAQ created successfully.'
            );
    }

    /**
     * Show edit FAQ form.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    /**
     * Update FAQ.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'question' => [
                'required',
                'string',
                'max:255',
            ],

            'answer' => [
                'required',
                'string',
                'max:5000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $faq->update([
            'category' => $validated['category'],
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.faq.index')
            ->with(
                'success',
                'FAQ updated successfully.'
            );
    }

    /**
     * Delete FAQ.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faq.index')
            ->with(
                'success',
                'FAQ deleted successfully.'
            );
    }
}