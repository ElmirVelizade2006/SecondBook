<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'dashboard' => ['view'],
            'books' => ['view', 'create', 'edit', 'delete', 'approve', 'reject'],
            'book_conditions' => ['view', 'create', 'edit', 'delete'],
            'book_requests' => ['view', 'create', 'edit', 'delete'],
            'categories' => ['view', 'create', 'edit', 'delete'],
            'authors' => ['view', 'create', 'edit', 'delete'],
            'publishers' => ['view', 'create', 'edit', 'delete'],
            'refunds' => ['view', 'create', 'edit', 'delete', 'approve', 'process'],
            'shipping' => ['view', 'create', 'edit', 'delete'],
            'coupons' => ['view', 'create', 'edit', 'delete'],
            'orders' => ['view', 'create', 'edit', 'delete', 'update_status'],
            'payments' => ['view', 'create', 'edit', 'delete', 'refund'],
            'users' => ['view', 'create', 'edit', 'delete', 'ban'],
            'sellers' => ['view', 'create', 'edit', 'delete', 'ban'],
            'reviews' => ['view', 'edit', 'delete', 'approve'],
            'banners' => ['view', 'create', 'edit', 'delete'],
            'blogs' => ['view', 'create', 'edit', 'delete'],
            'faq' => ['view', 'create', 'edit', 'delete'],
            'reports' => ['view'],
            'analytics' => ['view'],
            'settings' => ['view', 'edit'],
            'email_settings' => ['view', 'edit'],
            'notifications' => ['view', 'create', 'delete'],
            'activity_logs' => ['view'],
            'backup' => ['view', 'create'],
            'roles' => ['view', 'create', 'edit', 'delete'],
            'permissions' => ['view', 'assign'],
        ];

        $permissions = collect();

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $name = $module . '.' . $action;

                $permission = Permission::updateOrCreate(
                    ['name' => $name],
                    [
                        'display_name' => $this->displayName($module, $action),
                        'group_name' => $this->groupName($module),
                        'description' => 'Allows the user to ' .
                            Str::lower($this->displayName($module, $action)) . '.',
                    ]
                );

                $permissions->put($name, $permission);
            }
        }

        $all = $permissions->pluck('id')->all();

        $superAdmin = Role::updateOrCreate(
            ['name' => 'super-admin'],
            [
                'display_name' => 'Super Admin',
                'description' => 'Full access to every admin module.',
                'is_system' => true,
            ]
        );

        $superAdmin->permissions()->sync($all);

        $admin = Role::updateOrCreate(
            ['name' => 'admin'],
            [
                'display_name' => 'Admin',
                'description' => 'Operational access to marketplace management.',
                'is_system' => true,
            ]
        );

        $admin->permissions()->sync(
            $this->permissionIds($permissions, [
                'dashboard',
                'books',
                'book_conditions',
                'book_requests',
                'categories',
                'authors',
                'publishers',
                'refunds',
                'orders',
                'payments',
                'coupons',
                'shipping',
                'users',
                'sellers',
                'reviews',
                'reports',
                'analytics',
            ])
        );

        $manager = Role::updateOrCreate(
            ['name' => 'manager'],
            [
                'display_name' => 'Manager',
                'description' => 'Manages marketplace inventory and sales operations.',
                'is_system' => true,
            ]
        );

        $manager->permissions()->sync(
            $this->permissionIds($permissions, [
                'dashboard',
                'books',
                'refunds',
                'orders',
                'payments',
                'shipping',
                'coupons',
                'sellers',
                'reports',
                'analytics',
            ])
        );

        $editor = Role::updateOrCreate(
            ['name' => 'editor'],
            [
                'display_name' => 'Editor',
                'description' => 'Manages books and editorial content.',
                'is_system' => true,
            ]
        );

        $editor->permissions()->sync(
            $this->permissionIds($permissions, [
                'dashboard',
                'books',
                'categories',
                'authors',
                'publishers',
                'reviews',
                'banners',
                'blogs',
                'faq',
            ])
        );

        $seller = Role::updateOrCreate(
            ['name' => 'seller'],
            [
                'display_name' => 'Seller',
                'description' => 'Marketplace seller access.',
                'is_system' => true,
            ]
        );

        $seller->permissions()->sync(
            $this->permissionIds(
                $permissions,
                ['books'],
                ['view', 'create', 'edit']
            )
        );

        $member = Role::updateOrCreate(
            ['name' => 'user'],
            [
                'display_name' => 'Member',
                'description' => 'Standard marketplace account.',
                'is_system' => true,
            ]
        );

        $member->permissions()->sync([]);

        User::where('role', 'admin')
            ->get()
            ->each(
                fn (User $user) =>
                $user->roles()->sync([$superAdmin->id])
            );

        User::where('role', 'seller')
            ->get()
            ->each(
                fn (User $user) =>
                $user->roles()->sync([$seller->id])
            );

        User::where('role', 'user')
            ->get()
            ->each(
                fn (User $user) =>
                $user->roles()->sync([$member->id])
            );

        $this->command->info('Roles and permissions seeded successfully.');
    }

    private function permissionIds($permissions, array $modules, ?array $actions = null): array
    {
        return $permissions
            ->filter(function (Permission $permission) use ($modules, $actions) {
                [$module, $action] = explode('.', $permission->name, 2);

                return in_array($module, $modules, true)
                    && ($actions === null || in_array($action, $actions, true));
            })
            ->pluck('id')
            ->all();
    }

    private function groupName(string $module): string
    {
        return match ($module) {
            'book_conditions', 'book_requests' => 'Books',
            'email_settings', 'activity_logs' => 'System',
            default => Str::headline($module),
        };
    }

    private function displayName(string $module, string $action): string
    {
        return Str::headline($action) . ' ' . Str::headline($module);
    }
}