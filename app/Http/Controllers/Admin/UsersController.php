<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $role = $request->query('role');
        $status = $request->query('status');

        $usersQuery = User::query()->latest();

        if ($search !== '') {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($role !== null && Role::where('name', $role)->exists()) {
            $usersQuery->where(function ($query) use ($role) {
                $query->where('role', $role)->orWhereHas('roles', fn ($roleQuery) => $roleQuery->where('name', $role));
            });
        }

        if (in_array($status, ['active', 'inactive', 'banned'], true)) {
            $usersQuery->where('status', $status);
        }

        $users = $usersQuery->paginate(10)->withQueryString();

        $stats = [
            'total' => User::count(),
            'active' => User::where('status', 'active')->count(),
            'inactive' => User::whereIn('status', ['inactive', 'banned'])->count(),
            'admins' => User::where('role', 'admin')->count(),
        ];

        $roles = Role::orderBy('display_name')->get();

        return view('Admin.users.index', compact('users', 'stats', 'search', 'role', 'status', 'roles'));
    }

    public function create()
    {
        $roles = Role::orderBy('display_name')->get();

        return view('Admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateUser($request);
        $profilePhoto = $this->storeProfilePhoto($request);

        $user = User::create([
            ...$validated,
            'name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
            'role' => $this->legacyRoleFor($validated['role']),
            'profile_photo' => $profilePhoto,
        ]);
        $this->syncRole($user, $validated['role']);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->loadCount('orders')->loadSum('orders', 'total_price');

        return view('Admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('display_name')->get();

        return view('Admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $this->validateUser($request, $user, true);

        if ($request->filled('password')) {
            $validated['password'] = $request->input('password');
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('profile_photo')) {
            $this->deleteProfilePhoto($user->profile_photo);
            $validated['profile_photo'] = $this->storeProfilePhoto($request);
        }

        if (auth()->id() === $user->id) {
            $validated['role'] = $user->role;
            $validated['status'] = $user->status;
        } elseif ($validated['role'] === 'super-admin' && !auth()->user()->hasRole('super-admin')) {
            abort(403);
        }

        $validated['name'] = trim($validated['first_name'] . ' ' . $validated['last_name']);
        unset($validated['role']);
        $user->update($validated);
        if (auth()->id() !== $user->id) {
            $this->syncRole($user, $validated['role']);
        }

        return redirect()->route('admin.users.show', $user)->with('success', 'User updated successfully.');
    }

    public function updateStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['active', 'inactive', 'banned'])],
        ]);

        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot change your own account status.');
        }

        $user->update($validated);

        return back()->with('success', 'User status updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'The last administrator cannot be deleted.');
        }

        $this->deleteProfilePhoto($user->profile_photo);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    private function validateUser(Request $request, ?User $user = null, bool $isUpdate = false): array
    {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:100', Rule::unique('users', 'username')->ignore($user?->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => [$isUpdate ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'],
            'status' => ['required', Rule::in(['active', 'inactive', 'banned'])],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
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

    private function syncRole(User $user, string $roleName): void
    {
        $role = Role::where('name', $roleName)->firstOrFail();

        $user->update(['role' => $this->legacyRoleFor($roleName)]);
        $user->roles()->sync([$role->id]);
    }

    private function legacyRoleFor(string $roleName): string
    {
        return match ($roleName) {
            'seller' => 'seller',
            'super-admin', 'admin', 'manager', 'editor' => 'admin',
            default => 'user',
        };
    }
}
