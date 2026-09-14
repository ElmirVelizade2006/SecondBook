<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('frontend.auth.login');
        }

        $user = Auth::user();
        $role = strtolower((string) ($user->role ?? ''));

        if (
            !in_array($role, ['admin', 'superadmin', 'administrator'], true)
            && !$user->hasRole('super-admin')
            && !$user->hasRole('admin')
            && !$user->roles()->exists()
        ) {
            abort(403);
        }

        return $next($request);
    }
}
