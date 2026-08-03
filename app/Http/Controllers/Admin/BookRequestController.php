<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookRequestController extends Controller
{
    protected function getBookRequests(): array
    {
        $requests = session('admin_book_requests', []);

        if (!is_array($requests) || empty($requests)) {
            $requests = [[
                'id' => 'req_1',
                'title' => 'Atomic Habits',
                'requester' => 'Nigar Hasanli',
                'category' => 'self_development',
                'budget' => '18.00',
                'note' => 'Looking for a used copy with good condition.',
                'status' => 'pending',
                'created_at' => now()->format('Y-m-d'),
                'updated_at' => now()->format('Y-m-d'),
            ]];

            session(['admin_book_requests' => $requests]);
        }

        return $requests;
    }

    protected function saveBookRequests(array $requests): void
    {
        session(['admin_book_requests' => $requests]);
    }

    public function index(Request $request)
    {
        $bookRequests = $this->getBookRequests();

        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $bookRequests = array_values(array_filter($bookRequests, function ($item) use ($search) {
                return str_contains(strtolower($item['title']), $search)
                    || str_contains(strtolower($item['requester']), $search);
            }));
        }

        if ($request->filled('status')) {
            $bookRequests = array_values(array_filter($bookRequests, fn ($item) => $item['status'] === $request->status));
        }

        return view('admin.book-requests.index', compact('bookRequests'));
    }

    public function create()
    {
        return view('admin.book-requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'requester' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric|min:0',
            'note' => 'nullable|string|max:2000',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        $requests = $this->getBookRequests();
        $requests[] = [
            'id' => 'req_' . uniqid(),
            'title' => $request->title,
            'requester' => $request->requester ?? 'Unknown',
            'category' => $request->category ?? 'general',
            'budget' => $request->budget ?? '0',
            'note' => $request->note,
            'status' => $request->status ?? 'pending',
            'created_at' => now()->format('Y-m-d'),
            'updated_at' => now()->format('Y-m-d'),
        ];

        $this->saveBookRequests($requests);

        return redirect()->route('admin.book.requests.index')->with('success', 'Book request created successfully.');
    }

    public function edit($requestId)
    {
        $bookRequests = $this->getBookRequests();
        $bookRequest = collect($bookRequests)->firstWhere('id', $requestId);

        if (!$bookRequest) {
            abort(404);
        }

        return view('admin.book-requests.edit', compact('bookRequest'));
    }

    public function update(Request $request, $requestId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'requester' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric|min:0',
            'note' => 'nullable|string|max:2000',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        $requests = $this->getBookRequests();
        $index = collect($requests)->search(fn ($item) => $item['id'] === $requestId);

        if ($index !== false) {
            $requests[$index]['title'] = $request->title;
            $requests[$index]['requester'] = $request->requester ?? $requests[$index]['requester'];
            $requests[$index]['category'] = $request->category ?? $requests[$index]['category'];
            $requests[$index]['budget'] = $request->budget ?? $requests[$index]['budget'];
            $requests[$index]['note'] = $request->note;
            $requests[$index]['status'] = $request->status ?? $requests[$index]['status'];
            $requests[$index]['updated_at'] = now()->format('Y-m-d');
            $this->saveBookRequests($requests);
        }

        return redirect()->route('admin.book.requests.index')->with('success', 'Book request #' . $requestId . ' updated successfully.');
    }

    public function destroy($requestId)
    {
        $requests = $this->getBookRequests();
        $requests = array_values(array_filter($requests, fn ($item) => $item['id'] !== $requestId));
        $this->saveBookRequests($requests);

        return redirect()->route('admin.book.requests.index')->with('success', 'Book request #' . $requestId . ' deleted successfully.');
    }
}