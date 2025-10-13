<?php
// app/Http/Controllers/Auth/UnifiedLoginController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class UnifiedLoginController extends Controller
{
    public function create()
    {
        return view('auth.login'); // your single login form
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ]);
        $remember = (bool) $request->boolean('remember');

        // 1) If the email exists in admins table, try admin guard first
        $isAdminEmail = Admin::where('email', $credentials['email'])->exists();

        if ($isAdminEmail) {
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            // fall through to user check only if you want to allow same email in both tables
        }

        // 2) Try normal user
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // 3) If admin email but failed admin login, keep error generic (don’t leak role)
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        // Log out from whichever guard is active (or both)
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Optional: send admins to admin login; users to public login
        return redirect()->route('login');
    }
}
