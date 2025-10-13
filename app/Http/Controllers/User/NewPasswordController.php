<?php 
// app/Http/Controllers/Auth/User/NewPasswordController.php
namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    public function create(string $token)
    {
        return view('auth.reset-password', ['token' => $token]); // user-facing view
    }

    public function store(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::broker('users')->reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user) use ($request) {
                $user->forceFill(['password' => Hash::make($request->password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
