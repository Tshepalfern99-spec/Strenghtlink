<?php 
// app/Http/Controllers/Auth/User/PasswordResetLinkController.php
namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password'); // user-facing view
    }

    public function store(Request $request)
    {
        $request->validate(['email' => ['required','email']]);

        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
