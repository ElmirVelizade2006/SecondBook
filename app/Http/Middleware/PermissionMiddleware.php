<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = (string) $request->route()?->getName();

        if (!str_starts_with($routeName, 'admin.')) {
            return $next($request);
        }

        $permission = $this->permissionForRoute($routeName, $request->method());

        if ($permission === null || $request->user()?->hasPermission($permission)) {
            return $next($request);
        }

        abort(403);
    }

    private function permissionForRoute(string $routeName, string $method): ?string
    {
        $routeName = substr($routeName, strlen('admin.'));
        $module = match (true) {
            str_starts_with($routeName, 'book.conditions.') => 'book_conditions',
            str_starts_with($routeName, 'book.requests.') => 'book_requests',
            str_starts_with($routeName, 'email.settings.') => 'email_settings',
            str_starts_with($routeName, 'activity.logs.') => 'activity_logs',
            str_starts_with($routeName, 'roles.') => 'roles',
            str_starts_with($routeName, 'faq.') => 'faq',
            str_starts_with($routeName, 'backup.') => 'backup',
            default => str($routeName)->before('.')->toString(),
        };

        $action = str($routeName)->afterLast('.')->toString();

        if ($action === 'status' || $action === 'toggle-status') {
            if ($module === 'refunds') {
                return in_array($request->input('status'), ['approved', 'rejected'], true)
                    ? 'refunds.approve'
                    : ($request->input('status') === 'processed' ? 'refunds.process' : 'refunds.edit');
            }
            return in_array($module, ['users', 'sellers'], true)
                ? $module . '.ban'
                : $module . '.edit';
        }

        return match (true) {
            in_array($action, ['index', 'show', 'sales', 'users', 'books', 'download'], true) => $module . '.view',
            in_array($action, ['create', 'store'], true) => $module . '.create',
            in_array($action, ['edit', 'update'], true) => $module . '.edit',
            in_array($action, ['destroy', 'delete'], true) => $module . '.delete',
            in_array($action, ['send'], true) => $module . '.create',
            default => $module . '.view',
        };
    }
}
