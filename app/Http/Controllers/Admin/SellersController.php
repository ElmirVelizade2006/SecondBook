<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SellersController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $status = $request->query('status');
        $sort = $request->query('sort', 'newest');

        $sellersQuery = User::query()
            ->where('role', 'seller')
            ->withCount('books');

        if ($search !== '') {
            $sellersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if (in_array($status, ['active', 'inactive', 'banned'], true)) {
            $sellersQuery->where('status', $status);
        }

        match ($sort) {
            'oldest' => $sellersQuery->oldest(),
            'name_asc' => $sellersQuery->orderBy('name'),
            'name_desc' => $sellersQuery->orderByDesc('name'),
            default => $sellersQuery->latest(),
        };

        $sellers = $sellersQuery->paginate(10)->withQueryString();

        $stats = [
            'total' => User::where('role', 'seller')->count(),
            'active' => User::where('role', 'seller')->where('status', 'active')->count(),
            'inactive' => User::where('role', 'seller')->where('status', 'inactive')->count(),
            'banned' => User::where('role', 'seller')->where('status', 'banned')->count(),
        ];

        return view('Admin.sellers.index', compact('sellers', 'stats', 'search', 'status', 'sort'));
    }

    public function create()
    {
        return view('Admin.sellers.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateSeller($request);
        [$firstName, $lastName] = $this->splitName($validated['name']);

        User::create([
            'name' => $validated['name'],
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $this->makeUsername($validated['name'], $validated['email']),
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => $validated['password'],
            'role' => 'seller',
            'status' => $validated['status'],
            'profile_photo' => $this->storeProfilePhoto($request),
        ]);

        return redirect()->route('admin.sellers.index')->with('success', 'Seller created successfully.');
    }

    public function show(User $seller)
    {
        $this->assertSeller($seller);

        $bookQuery = $seller->books()->latest();
        $books = $bookQuery->paginate(10)->withQueryString();
        $bookStats = [
            'total' => $seller->books()->count(),
            'approved' => $seller->books()->where('status', 'approved')->count(),
            'pending' => $seller->books()->where('status', 'pending')->count(),
            'rejected' => $seller->books()->where('status', 'rejected')->count(),
        ];

        return view('Admin.sellers.show', compact('seller', 'books', 'bookStats'));
    }

    public function edit(User $seller)
    {
        $this->assertSeller($seller);

        return view('Admin.sellers.edit', compact('seller'));
    }

    public function update(Request $request, User $seller)
    {
        $this->assertSeller($seller);
        $validated = $this->validateSeller($request, $seller, true);
        [$firstName, $lastName] = $this->splitName($validated['name']);

        $seller->name = $validated['name'];
        $seller->first_name = $firstName;
        $seller->last_name = $lastName;
        $seller->email = $validated['email'];
        $seller->phone = $validated['phone'] ?? null;
        $seller->status = $validated['status'];

        if ($request->filled('password')) {
            $seller->password = $validated['password'];
        }

        if ($request->hasFile('profile_photo')) {
            $this->deleteProfilePhoto($seller->profile_photo);
            $seller->profile_photo = $this->storeProfilePhoto($request);
        }

        $seller->save();

        return redirect()->route('admin.sellers.show', $seller)->with('success', 'Seller updated successfully.');
    }

    public function updateStatus(Request $request, User $seller)
    {
        $this->assertSeller($seller);

        if (auth()->id() === $seller->id) {
            return back()->with('error', 'You cannot change your own seller status.');
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in(['active', 'inactive', 'banned'])],
        ]);

        $seller->update($validated);

        return back()->with('success', 'Seller status updated successfully.');
    }

    public function destroy(User $seller)
    {
        $this->assertSeller($seller);

        if (auth()->id() === $seller->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($seller->books()->exists()) {
            return back()->with('error', 'This seller cannot be deleted while they have books. Reassign the books first.');
        }

        $this->deleteProfilePhoto($seller->profile_photo);
        $seller->delete();

        return redirect()->route('admin.sellers.index')->with('success', 'Seller deleted successfully.');
    }

    private function validateSeller(Request $request, ?User $seller = null, bool $isUpdate = false): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($seller?->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => [$isUpdate ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'status' => ['required', Rule::in(['active', 'inactive', 'banned'])],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }

    private function assertSeller(User $seller): void
    {
        abort_unless($seller->role === 'seller', 404);
    }

    private function splitName(string $name): array
    {
        $parts = preg_split('/\s+/', trim($name), 2);

        return [$parts[0], $parts[1] ?? $parts[0]];
    }

    private function makeUsername(string $name, string $email): string
    {
        $base = Str::slug($name, '_') ?: Str::before($email, '@');
        $username = $base;
        $suffix = 1;

        while (User::where('username', $username)->exists()) {
            $username = $base . '_' . $suffix++;
        }

        return $username;
    }

    private function storeProfilePhoto(Request $request): ?string
    {
        return $request->hasFile('profile_photo')
            ? $request->file('profile_photo')->store('profile-photos', 'public')
            : null;
    }

    private function deleteProfilePhoto(?string $profilePhoto): void
    {
        if ($profilePhoto) {
            Storage::disk('public')->delete($profilePhoto);
        }
    }
}