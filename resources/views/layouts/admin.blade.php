<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Strengthlink • Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: { 
                50: '#fdf2f8', 
                100: '#fce7f3', 
                200: '#fbcfe8', 
                300: '#f9a8d4', 
                400: '#f472b6', 
                500: '#ec4899', 
                600: '#db2777', 
                700: '#be185d',
                800: '#9d174d',
                900: '#831843'
              },
              secondary: {
                50: '#f8fafc',
                100: '#f1f5f9',
                200: '#e2e8f0',
                300: '#cbd5e1',
                400: '#94a3b8',
                500: '#64748b',
                600: '#475569',
                700: '#334155',
                800: '#1e293b',
                900: '#0f172a'
              },
              success: '#10b981',
              info: '#3b82f6',
              warn: '#f59e0b',
              danger: '#ef4444'
            },
            boxShadow: {
              'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
              'glow': '0 0 20px rgba(236, 72, 153, 0.15)',
              'card': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)'
            },
            animation: {
              'fade-in': 'fadeIn 0.5s ease-in-out',
              'slide-in': 'slideIn 0.3s ease-out'
            },
            keyframes: {
              fadeIn: {
                '0%': { opacity: '0', transform: 'translateY(10px)' },
                '100%': { opacity: '1', transform: 'translateY(0)' }
              },
              slideIn: {
                '0%': { transform: 'translateX(-100%)' },
                '100%': { transform: 'translateX(0)' }
              }
            }
          }
        }
      }
    </script>
    <style>
      body { 
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #fdf2f8 0%, #f8fafc 50%, #f0f9ff 100%);
        min-height: 100vh;
      }
      .glass-effect {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
      }
      .gradient-text {
        background: linear-gradient(135deg, #ec4899 0%, #db2777 50%, #be185d 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }
      .smooth-card { 
        transition: transform .2s ease, box-shadow .2s ease; 
      }
      .smooth-card:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
      }
      .active-nav { 
        background: #fce7f3; 
        color: #db2777; 
        border-left: 4px solid #ec4899;
      }
      .nav-item {
        transition: all 0.3s ease;
      }
      .nav-item:hover {
        background: #fdf2f8;
        transform: translateX(5px);
      }
    </style>

    @stack('styles')
</head>
<body class="antialiased">
<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="hidden lg:block w-80 p-6">
        <div class="sticky top-6 space-y-6">

            {{-- Brand --}}
            <div class="glass-effect rounded-2xl p-6 shadow-card">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center shadow-glow">
                        <i class="fa-solid fa-shield text-lg"></i>
                    </div>
                    <div>
                        <div class="font-bold text-lg gradient-text">Strengthlink Admin</div>
                        <div class="text-xs text-secondary-500 mt-1">Manage & Respond</div>
                    </div>
                </div>
            </div>

            {{-- Primary Navigation --}}
            <nav class="glass-effect rounded-2xl p-4 shadow-card">
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-item flex items-center gap-3 rounded-xl px-4 py-3.5 smooth-card
                              {{ request()->routeIs('admin.dashboard') ? 'active-nav' : 'text-secondary-700' }}">
                        <i class="fa-solid fa-home w-5 text-center"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.reports.index') }}"
                       class="nav-item flex items-center gap-3 rounded-xl px-4 py-3.5 smooth-card
                              {{ request()->routeIs('admin.reports.*') ? 'active-nav' : 'text-secondary-700' }}">
                        <i class="fa-solid fa-flag w-5 text-center"></i>
                        <span class="font-medium">Incident Reports</span>
                    </a>

                    <a href="{{ route('admin.resources.index') }}"
                       class="nav-item flex items-center gap-3 rounded-xl px-4 py-3.5 smooth-card
                              {{ request()->routeIs('admin.resources.*') ? 'active-nav' : 'text-secondary-700' }}">
                        <i class="fa-solid fa-database w-5 text-center"></i>
                        <span class="font-medium">Resource Hub</span>
                    </a>

                    <a href="{{ route('admin.news.index') }}"
                       class="nav-item flex items-center gap-3 rounded-xl px-4 py-3.5 smooth-card
                              {{ request()->routeIs('admin.news.*') ? 'active-nav' : 'text-secondary-700' }}">
                        <i class="fa-solid fa-newspaper w-5 text-center"></i>
                        <span class="font-medium">News & Updates</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="nav-item flex items-center gap-3 rounded-xl px-4 py-3.5 smooth-card
                              {{ request()->routeIs('admin.users.*') ? 'active-nav' : 'text-secondary-700' }}">
                        <i class="fa-solid fa-users w-5 text-center"></i>
                        <span class="font-medium">User Management</span>
                    </a>

                    <a href="{{ route('admin.forum.posts.index') }}"
   class="nav-item flex items-center gap-3 rounded-xl px-4 py-3.5 smooth-card {{ request()->routeIs('admin.forum.*') ? 'active-nav' : 'text-secondary-700' }}">
  <i class="fas fa-comments mr-0.5"></i>
  <span>Forums</span>
</a>
<a href="{{ route('admin.education.index') }}"
   class="nav-item flex items-center gap-3 rounded-xl px-4 py-3.5 smooth-card {{ request()->routeIs('admin.education.*') ? 'active-nav' : 'text-secondary-700' }}">
  <i class="fa-solid fa-graduation-cap"></i> <span>Education</span>
</a>

    
                </div>
            </nav>

            {{-- Admin Profile --}}
            @php($admin = Auth::guard('admin')->user())
            <div class="glass-effect rounded-2xl p-5 shadow-card">
                <div class="text-xs text-secondary-500 mb-3 font-medium">ADMIN ACCOUNT</div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-r from-primary-400 to-primary-600 text-white grid place-items-center font-semibold text-sm">
                        {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-secondary-800 truncate">{{ $admin->name ?? 'Admin' }}</div>
                        <div class="text-xs text-secondary-500 truncate">{{ $admin->email ?? '' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
                    @csrf
                    <button class="w-full flex items-center justify-center gap-2 rounded-xl bg-secondary-100 px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-200 transition-colors">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 min-w-0">
        {{-- Topbar --}}
        <header class="sticky top-0 z-10 glass-effect border-b border-white/60">
            <div class="mx-auto max-w-7xl px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button id="mobileNavBtn" class="lg:hidden h-10 w-10 rounded-xl bg-white shadow-soft grid place-items-center text-secondary-600 hover:text-primary-600 transition-colors">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div>
                        <div class="text-xs text-secondary-500 font-medium">@yield('subtitle','Overview')</div>
                        <h1 class="text-xl font-bold text-secondary-800">@yield('header','Dashboard')</h1>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <div class="hidden sm:flex items-center gap-2 text-sm text-secondary-500">
                        <i class="fa-solid fa-circle text-xs text-success"></i>
                        <span>System Online</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <section class="mx-auto max-w-7xl px-6 py-8">
            @yield('content')
        </section>
    </main>
</div>

{{-- Mobile Drawer --}}
<div id="mobileDrawer" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40" onclick="toggleDrawer(false)"></div>
    <div class="absolute left-0 top-0 h-full w-80 bg-white p-6 shadow-xl">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center">
                    <i class="fa-solid fa-shield"></i>
                </div>
                <div class="font-bold text-lg gradient-text">Strengthlink</div>
            </div>
            <button onclick="toggleDrawer(false)" class="h-10 w-10 rounded-xl bg-secondary-100 grid place-items-center text-secondary-600 hover:text-primary-600 transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3.5 {{ request()->routeIs('admin.dashboard') ? 'active-nav' : 'text-secondary-700 hover:bg-primary-50' }}">
                <i class="fa-solid fa-home w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.reports.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3.5 {{ request()->routeIs('admin.reports.*') ? 'active-nav' : 'text-secondary-700 hover:bg-primary-50' }}">
                <i class="fa-solid fa-flag w-5 text-center"></i>
                <span class="font-medium">Incident Reports</span>
            </a>
            <a href="{{ route('admin.resources.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3.5 {{ request()->routeIs('admin.resources.*') ? 'active-nav' : 'text-secondary-700 hover:bg-primary-50' }}">
                <i class="fa-solid fa-database w-5 text-center"></i>
                <span class="font-medium">Resource Hub</span>
            </a>
            <a href="{{ route('admin.news.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3.5 {{ request()->routeIs('admin.news.*') ? 'active-nav' : 'text-secondary-700 hover:bg-primary-50' }}">
                <i class="fa-solid fa-newspaper w-5 text-center"></i>
                <span class="font-medium">News & Updates</span>
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3.5 {{ request()->routeIs('admin.users.*') ? 'active-nav' : 'text-secondary-700 hover:bg-primary-50' }}">
                <i class="fa-solid fa-users w-5 text-center"></i>
                <span class="font-medium">User Management</span>
            </a>
            <a href="{{ route('forum.index') }}" target="_blank"
               class="flex items-center gap-3 rounded-xl px-4 py-3.5 text-secondary-700 hover:bg-primary-50">
                <i class="fa-solid fa-comments w-5 text-center"></i>
                <span class="font-medium">Community Forum</span>
            </a>
            <a href="{{ route('admin.feedback.index') }}"
            class="flex items-center gap-3 rounded-xl px-4 py-3.5 {{ request()->routeIs('admin.feedback.*') ? 'active-nav' : '' }}">
   <i class="fa-solid fa-star"></i>
   <span class="font-medium">Feedback</span>
</a>

        </nav>

        <div class="absolute bottom-6 left-6 right-6">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-xl bg-secondary-100 px-4 py-3 text-sm font-medium text-secondary-700 hover:bg-secondary-200 transition-colors">
                    <i class="fa-solid fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

<script>
  const btn = document.getElementById('mobileNavBtn');
  const drawer = document.getElementById('mobileDrawer');
  function toggleDrawer(show=true){ 
      drawer.classList.toggle('hidden', !show);
      document.body.style.overflow = show ? 'hidden' : '';
  }
  if (btn) btn.addEventListener('click', ()=>toggleDrawer(true));
</script>

@stack('scripts')
</body>
</html>