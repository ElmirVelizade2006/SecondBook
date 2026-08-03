<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookConditionController extends Controller
{
    protected function getDefaultConditions(): array
    {
        return [
            [
                'id' => 'new',
                'name' => 'New',
                'description' => 'Unused copy with no marks, folds, or shelf wear.',
                'status' => 1,
            ],
            [
                'id' => 'like_new',
                'name' => 'Like New',
                'description' => 'Barely used and looks almost brand new.',
                'status' => 1,
            ],
            [
                'id' => 'good',
                'name' => 'Good',
                'description' => 'Used with light wear but fully readable.',
                'status' => 1,
            ],
            [
                'id' => 'fair',
                'name' => 'Fair',
                'description' => 'Readable copy with visible wear and signs of use.',
                'status' => 1,
            ],
        ];
    }

    protected function getConditions(): array
    {
        $savedConditions = session('admin_book_conditions');
        $savedConditions = is_array($savedConditions) ? $savedConditions : [];

        $conditions = [];

        foreach ($this->getDefaultConditions() as $defaultCondition) {
            $savedCondition = collect($savedConditions)->firstWhere('id', $defaultCondition['id']);
            $condition = $savedCondition ? array_merge($defaultCondition, $savedCondition) : $defaultCondition;

            $booksQuery = Book::query()->where('condition', $condition['id']);
            $condition['books_count'] = (int) $booksQuery->count();
            $condition['created_at'] = $booksQuery->orderBy('created_at')->value('created_at')
                ?? ($savedCondition['created_at'] ?? now()->format('Y-m-d'));

            $conditions[] = $condition;
        }

        foreach ($savedConditions as $savedCondition) {
            if (!collect($conditions)->contains(fn ($condition) => $condition['id'] === $savedCondition['id'])) {
                $booksQuery = Book::query()->where('condition', $savedCondition['id']);
                $savedCondition['books_count'] = (int) $booksQuery->count();
                $savedCondition['created_at'] = $booksQuery->orderBy('created_at')->value('created_at')
                    ?? ($savedCondition['created_at'] ?? now()->format('Y-m-d'));
                $conditions[] = $savedCondition;
            }
        }

        return $conditions;
    }

    protected function saveConditions(array $conditions): void
    {
        session(['admin_book_conditions' => $conditions]);
    }

    public function index(Request $request)
    {
        $conditions = $this->getConditions();

        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $conditions = array_values(array_filter($conditions, function ($condition) use ($search) {
                return str_contains(strtolower($condition['name']), $search);
            }));
        }

        if ($request->filled('status')) {
            $status = $request->status;
            $conditions = array_values(array_filter($conditions, function ($condition) use ($status) {
                return $status === 'active' ? (int) $condition['status'] === 1 : (int) $condition['status'] === 0;
            }));
        }

        return view('admin.book-condition.index', compact('conditions'));
    }

    public function create()
    {
        return view('admin.book-condition.form');
    }

    public function store(Request $request)
    {
        $conditions = $this->getConditions();

        $conditions[] = [
            'id' => 'custom-' . uniqid(),
            'name' => $request->input('name'),
            'description' => $request->input('description', ''),
            'status' => (int) $request->input('status', 1),
            'books_count' => 0,
            'created_at' => now()->format('Y-m-d'),
        ];

        $this->saveConditions($conditions);

        return redirect()->route('admin.book.conditions.index')->with('success', 'Condition added successfully.');
    }

    public function edit(string $condition)
    {
        $conditions = $this->getConditions();
        $selectedCondition = collect($conditions)->firstWhere('id', $condition);

        if (!$selectedCondition) {
            abort(404);
        }

        return view('admin.book-condition.form', compact('condition', 'selectedCondition'));
    }

    public function update(Request $request, string $condition)
    {
        $conditions = $this->getConditions();
        $index = collect($conditions)->search(fn ($item) => $item['id'] === $condition);

        if ($index !== false) {
            $conditions[$index]['name'] = $request->input('name');
            $conditions[$index]['description'] = $request->input('description', '');
            $conditions[$index]['status'] = (int) $request->input('status', 1);
            $this->saveConditions($conditions);
        }

        return redirect()->route('admin.book.conditions.index')->with('success', 'Condition updated successfully.');
    }

    public function status(string $condition)
    {
        $conditions = $this->getConditions();
        $index = collect($conditions)->search(fn ($item) => $item['id'] === $condition);

        if ($index !== false) {
            $conditions[$index]['status'] = (int) $conditions[$index]['status'] === 1 ? 0 : 1;
            $this->saveConditions($conditions);
        }

        return redirect()->route('admin.book.conditions.index')->with('success', 'Condition status updated successfully.');
    }

    public function destroy(string $condition)
    {
        $conditions = $this->getConditions();
        $conditions = array_values(array_filter($conditions, fn ($item) => $item['id'] !== $condition));
        $this->saveConditions($conditions);

        return redirect()->route('admin.book.conditions.index')->with('success', 'Condition deleted successfully.');
    }
}
