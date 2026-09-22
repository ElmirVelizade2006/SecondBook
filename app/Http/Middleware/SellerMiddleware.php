<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Please login to access the seller panel.');
        }

        if (!auth()->user()->isSeller()) {
            return redirect()
                ->route('frontend.home')
                ->with('error', 'You do not have access to the seller panel.');
        }

        return $next($request);
    }
}