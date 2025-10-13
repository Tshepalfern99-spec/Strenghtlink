<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user()->load('profile');

        // If profile somehow missing (older accounts), ensure it exists:
        if (! $user->profile) {
            $user->profile()->create();
            $user->load('profile');
        }

        return view('profile.edit', compact('user'));
    }

    /**
     * Update PROFILE fields (user_profiles table).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'display_name' => ['nullable', 'string', 'max:120'],
            'is_private'   => ['nullable', 'boolean'],
            'city'         => ['nullable', 'string', 'max:120'],
            'province'     => ['nullable', 'string', 'max:120'],
            'phone'        => ['nullable', 'string', 'max:40'],
        ]);

        $data['is_private'] = (bool) ($data['is_private'] ?? false);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return back()->with('status', 'Profile updated.');
    }

    /**
     * Update ACCOUNT fields (name/email) on users table.
     * If email changes, require re-verification and redirect to notice page.
     */
    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:120'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        $emailChanged = $validated['email'] !== $user->email;

        $user->forceFill([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ])->save();

        if ($emailChanged) {
            $user->forceFill(['email_verified_at' => null])->save();
            $user->sendEmailVerificationNotification();

            return redirect()
                ->route('verification.notice')
                ->with('status', 'Email updated. Please verify your new email address.');
        }

        return back()->with('status', 'Account details updated.');
    }

    /**
     * Update PASSWORD.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'Password updated.');
    }

    /**
     * Delete account (requires current password).
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();

        Auth::logout();

        $user->delete();  // cascades to profile and other FK rows if you set cascade in migrations

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Your account has been deleted.');
    }
}
