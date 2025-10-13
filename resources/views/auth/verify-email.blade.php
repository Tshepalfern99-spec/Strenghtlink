<x-guest-layout>
  {{-- resources/views/auth/verify-email.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify your email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>body{font-family: system-ui, Arial, sans-serif; padding: 2rem; max-width: 680px; margin: auto;} .card{border:1px solid #ddd;border-radius:12px;padding:24px} .btn{padding:10px 16px;border:0;border-radius:8px;background:#111;color:#fff;cursor:pointer} .muted{color:#666}</style>
</head>
<body>
    <div class="card">
        <h1>Verify your email</h1>
        <p class="muted">
            Thanks for registering. We’ve sent a verification link to your email address.
            Please click the link to activate your account.
        </p>

        @if (session('status'))
            <p><strong>{{ session('status') }}</strong></p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn" type="submit">Resend verification email</button>
        </form>

        <p class="muted" style="margin-top:12px;">
            Wrong account? <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
        </p>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" style="display:none;">
            @csrf
        </form>
    </div>
</body>
</html>

</x-guest-layout>
