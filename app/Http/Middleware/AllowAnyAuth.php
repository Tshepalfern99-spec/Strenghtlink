<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowAnyAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() || auth('admin')->check()) {
            return $next($request);
        }
        // If not authenticated in either guard, send to user login (or choose admin)
        return redirect()->route('login');
    }
}
