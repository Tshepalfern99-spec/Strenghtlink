<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile • Strengthlink</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      :root { --b:#111; --muted:#666; }
      body{font-family:system-ui,Arial,sans-serif;padding:2rem;max-width:900px;margin:auto}
      .grid{display:grid;grid-template-columns:1fr 1fr;gap:24px}`
      .card{border:1px solid #ddd;border-radius:12px;padding:16px}
      label{display:block;margin-top:10px}
      input[type="text"],input[type="email"],input[type="password"],select{
          width:100%;padding:10px;margin-top:6px;border:1px solid #ccc;border-radius:8px
      }
      .row{display:flex;gap:12px}
      .btn{margin-top:14px;padding:10px 16px;border:0;border-radius:8px;background:var(--b);color:#fff;cursor:pointer}
      .muted{color:var(--muted)}
      .alert{background:#e8f5ff;border:1px solid #9ed0ff;padding:10px 12px;border-radius:8px;margin-bottom:16px}
      .danger{background:#ffecec;border:1px solid #ffb3b3}
      @media (max-width: 780px){ .grid{grid-template-columns:1fr} }
    </style>
</head>
<body>

    <h1>Edit Profile</h1>
    <p class="muted">Manage your public profile, account details, and password.</p>

    @if (session('status'))
      <div class="alert">{{ session('status') }}</div>
    @endif

    {{-- PROFILE INFO (user_profiles) --}}
    <div class="card">
        <h2>Profile</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('PATCH')

            <label>Display name
                <input type="text" name="display_name" value="{{ old('display_name', optional($user->profile)->display_name) }}">
            </label>

            <label>Privacy
                <select name="is_private">
                    <option value="0" {{ old('is_private', optional($user->profile)->is_private) ? '' : 'selected' }}>Public</option>
                    <option value="1" {{ old('is_private', optional($user->profile)->is_private) ? 'selected' : '' }}>Private</option>
                </select>
            </label>

            <div class="row">
                <label style="flex:1">City
                    <input type="text" name="city" value="{{ old('city', optional($user->profile)->city) }}">
                </label>
                <label style="flex:1">Province
                    <input type="text" name="province" value="{{ old('province', optional($user->profile)->province) }}">
                </label>
            </div>

            <label>Phone
                <input type="text" name="phone" value="{{ old('phone', optional($user->profile)->phone) }}">
            </label>

            <button class="btn" type="submit">Save Profile</button>

            @if ($errors->any())
                <ul style="color:#b00;margin-top:10px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>

    <div class="grid" style="margin-top:24px;">

        {{-- ACCOUNT INFO (users: name/email) --}}
        <div class="card">
            <h2>Account</h2>
            <form method="POST" action="{{ route('profile.account.update') }}">
                @csrf @method('PATCH')

                <label>Name
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </label>

                <label>Email
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </label>

                @if (! $user->hasVerifiedEmail())
                    <p class="muted" style="margin-top:8px;">
                        Your email is not verified. <a href="{{ route('verification.notice') }}">Verify now</a>
                    </p>
                @endif

                <button class="btn" type="submit">Save Account</button>
            </form>
        </div>

        {{-- PASSWORD --}}
        <div class="card">
            <h2>Password</h2>
            <form method="POST" action="{{ route('profile.password.update') }}">
                @csrf @method('PATCH')

                <label>Current password
                    <input type="password" name="current_password" required>
                </label>

                <label>New password
                    <input type="password" name="password" required>
                </label>

                <label>Confirm new password
                    <input type="password" name="password_confirmation" required>
                </label>

                <button class="btn" type="submit">Update Password</button>
            </form>
        </div>
    </div>

    {{-- DANGER ZONE --}}
    <div class="card danger" style="margin-top:24px;">
        <h2>Delete Account</h2>
        <p class="muted">This action is permanent and cannot be undone.</p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf @method('DELETE')

            <label>Confirm with your password
                <input type="password" name="password" required>
            </label>

            <button class="btn" type="submit" onclick="return confirm('Are you sure you want to delete your account? This cannot be undone.')">Delete my account</button>
        </form>
    </div>

    <p style="margin-top:16px"><a href="{{ route('dashboard') }}">← Back to dashboard</a></p>
</body>
</html>

</x-app-layout>
