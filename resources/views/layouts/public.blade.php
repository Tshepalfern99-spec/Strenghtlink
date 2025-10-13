<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Strenghtlink')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
  <header class="bg-white border-b">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <a href="{{ route('home') }}" class="font-bold">Strenghtlink</a>

      <nav class="flex items-center gap-3 text-sm">
        <a href="{{ route('home') }}" class="hover:underline">Home</a>
        <a href="{{ route('resources.index') }}" class="hover:underline">Resources</a>
        <a href="{{ route('education.index') }}" class="hover:underline">Education</a>
        <a href="{{ route('report.create') }}" class="hover:underline">Report</a>

        @auth
          <a href="{{ route('dashboard') }}" class="rounded bg-gray-900 text-white px-3 py-1">Dashboard</a>
        @else
          <a href="{{ route('login') }}" class="hover:underline">Log in</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="rounded bg-rose-600 text-white px-3 py-1">Register</a>
          @endif
        @endauth
      </nav>
    </div>
  </header>

  <main class="py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      @yield('content')
    </div>
  </main>

  <footer class="border-t py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-sm text-gray-600">
      &copy; {{ now()->year }} Strenghtlink
    </div>
  </footer>
</body>
</html>
