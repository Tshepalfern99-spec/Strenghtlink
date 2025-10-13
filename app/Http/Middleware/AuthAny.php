<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAny
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check() || Auth::guard('admin')->check()) {
            return $next($request);
        }
        // Default to user login (change if you prefer admin login)
        return redirect()->route('login');
    }
}
