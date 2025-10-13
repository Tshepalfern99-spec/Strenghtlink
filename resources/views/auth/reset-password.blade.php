<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Set New Password • Strengthlink</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen grid place-items-center bg-gray-50">
  <div class="w-full max-w-md bg-white rounded-xl shadow p-6">
    <h1 class="text-xl font-semibold">Choose a new password</h1>

    <form class="mt-6 space-y-4" method="POST" action="{{ route('password.update') }}">
      @csrf

      {{-- REQUIRED by Laravel: token + email --}}
      <input type="hidden" name="token" value="{{ $token }}">

      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email"
               name="email"
               value="{{ old('email', request('email')) }}"
               required
               class="w-full rounded-md border-gray-300 focus:ring-rose-500 focus:border-rose-500">
        @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">New password</label>
        <input type="password" name="password" required
               class="w-full rounded-md border-gray-300 focus:ring-rose-500 focus:border-rose-500">
        @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Confirm password</label>
        <input type="password" name="password_confirmation" required
               class="w-full rounded-md border-gray-300 focus:ring-rose-500 focus:border-rose-500">
      </div>

      <button class="w-full rounded-md bg-rose-600 text-white py-2.5 hover:bg-rose-700">
        Update password
      </button>
    </form>

    <div class="mt-4 text-sm">
      <a class="text-rose-600 hover:underline" href="{{ route('login') }}">Back to sign in</a>
    </div>
  </div>
</body>
</html>
