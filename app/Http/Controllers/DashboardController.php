<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        $user = Auth::user()->loadMissing('profile');

        // Ensure a profile exists (for older users)
        if (! $user->profile) {
            $user->profile()->create();
            $user->load('profile');
        }

        $displayName = trim(optional($user->profile)->display_name ?? '') !== ''
            ? $user->profile->display_name
            : $user->name;

        return view('dashboard', compact('user', 'displayName'));
    }

    public function updateDisplayName(Request $request)
    {
        $data = $request->validate([
            'display_name' => ['nullable', 'string', 'max:120'],
        ]);

        $user = Auth::user()->loadMissing('profile');
        if (! $user->profile) {
            $user->profile()->create();
            $user->load('profile');
        }

        $name = trim($data['display_name'] ?? '');
        $user->profile->update([
            'display_name' => $name !== '' ? $name : null, // null clears it
        ]);

        return redirect()
            ->route('dashboard')
            ->with('status', $name !== '' ? 'Display name updated.' : 'Display name cleared. Using your account name.');
    }
}
