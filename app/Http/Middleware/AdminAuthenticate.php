<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('admin')->check()) {
            // Remember intended URL, then redirect to admin login
            session(['url.intended' => $request->fullUrl()]);
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
