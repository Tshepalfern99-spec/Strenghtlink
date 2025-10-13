<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // If it's an admin URL, send to admin login; otherwise user login
            return $request->is('admin') || $request->is('admin/*')
                ? route('admin.login')
                : route('login');
        }
        return null;
    }
}
