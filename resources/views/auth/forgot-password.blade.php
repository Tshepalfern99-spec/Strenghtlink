<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Forgot Password • Strengthlink</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen grid place-items-center bg-gray-50">
  <div class="w-full max-w-md bg-white rounded-xl shadow p-6">
    <h1 class="text-xl font-semibold">Reset your password</h1>
    <p class="text-sm text-gray-600 mt-1">Enter your email and we’ll send you a reset link.</p>

    @if (session('status'))
      <div class="mt-4 rounded-md bg-green-50 text-green-700 px-3 py-2 text-sm">{{ session('status') }}</div>
    @endif

    <form class="mt-6 space-y-4" method="POST" action="{{ route('password.email') }}">
      @csrf
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" required value="{{ old('email') }}"
               class="w-full rounded-md border-gray-300 focus:ring-rose-500 focus:border-rose-500">
        @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <button class="w-full rounded-md bg-rose-600 text-white py-2.5 hover:bg-rose-700">Send reset link</button>
    </form>

    <div class="mt-4 text-sm">
      <a class="text-rose-600 hover:underline" href="{{ route('login') }}">Back to sign in</a>
    </div>
  </div>
</body>
</html>
