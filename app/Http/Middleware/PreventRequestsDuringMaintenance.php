<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventRequestsDuringMaintenance
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
         * Maintenance mode is controlled from
         * Admin Settings.
         */
        if (
            Setting::get('maintenance_mode', false)
            && ! $request->is('admin')
            && ! $request->is('admin/*')
        ) {
            return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}