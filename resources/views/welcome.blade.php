<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}" class="h-full" data-theme="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Strenghtlink — Empowering Survivors of GBV</title>
    <meta name="description" content="Strenghtlink: Find support, resources, and community. Anonymous reporting, resource hub, and educational tools for GBV awareness." />
    <meta name="color-scheme" content="dark light" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              brand: { 
                50: '#fdf2f8', 
                100: '#fce7f3', 
                200: '#fbcfe8', 
                500: '#ec4899', 
                600: '#db2777', 
                700: '#be185d',
                900: '#831843' 
              },
              redbrand: { 
                50: '#fff1f2', 
                100: '#ffe4e6', 
                500: '#ef4444', 
                600: '#dc2626', 
                700: '#b91c1c' 
              }
            },
            boxShadow: { 
              'focus': '0 0 0 3px rgba(236, 72, 153, 0.35)',
              'glow': '0 0 20px rgba(236, 72, 153, 0.15)',
              'glow-lg': '0 0 40px rgba(236, 72, 153, 0.2)'
            },
            animation: {
              'float': 'float 6s ease-in-out infinite',
              'pulse-soft': 'pulse-soft 2s ease-in-out infinite',
              'fade-in': 'fade-in 0.8s ease-out forwards'
            },
            keyframes: {
              float: {
                '0%, 100%': { transform: 'translateY(0px)' },
                '50%': { transform: 'translateY(-10px)' }
              },
              'pulse-soft': {
                '0%, 100%': { opacity: '1' },
                '50%': { opacity: '0.8' }
              },
              'fade-in': {
                '0%': { opacity: '0', transform: 'translateY(20px)' },
                '100%': { opacity: '1', transform: 'translateY(0)' }
              }
            }
          }
        }
      }
    </script>
    <style>
      :root { 
        --bg: #fff; 
        --fg: #0b0b0c; 
        --muted: #4b5563; 
        --card: #fff; 
        --border: #e5e7eb; 
        --accent: #ec4899; 
      }
      html[data-theme="dark"] { 
        --bg: #0f0f1a; 
        --fg: #f9fafb; 
        --muted: #cbd5e1; 
        --card: #1a1a2e; 
        --border: #2d3748; 
        --accent: #ec4899; 
      }
      body { 
        background: var(--bg); 
        color: var(--fg); 
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
      }
      .card { 
        background: var(--card); 
        border-color: var(--border); 
      }
      .muted { 
        color: var(--muted); 
      }
      .skip-link { 
        position: absolute; 
        left: 0; 
        top: -40px; 
        background: var(--fg); 
        color: var(--bg); 
        padding: .5rem 1rem; 
        border-radius: .375rem; 
        z-index: 50; 
        transition: top .2s; 
      }
      .skip-link:focus { 
        top: .5rem; 
        outline: none; 
        box-shadow: var(--shadow-focus); 
      }
      :focus-visible { 
        outline: 2px solid var(--accent); 
        outline-offset: 2px; 
      }
      
      /* Custom gradient backgrounds */
      .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      }
      
      .hero-gradient {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      }
      
      .feature-gradient {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      }
      
      /* Glass morphism effect */
      .glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
      }
      
      .glass-dark {
        background: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
      }
      
      /* Custom scrollbar */
      ::-webkit-scrollbar {
        width: 8px;
      }
      
      ::-webkit-scrollbar-track {
        background: var(--bg);
      }
      
      ::-webkit-scrollbar-thumb {
        background: var(--accent);
        border-radius: 4px;
      }
      
      ::-webkit-scrollbar-thumb:hover {
        background: #db2777;
      }
    </style>
    <script>
      (function() {
        const saved = localStorage.getItem('Strenghtlink-theme');
        if (saved) document.documentElement.setAttribute('data-theme', saved);
        else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          document.documentElement.setAttribute('data-theme', 'dark');
        }
      })();
    </script>
</head>

<body class="min-h-full antialiased selection:bg-brand-600 selection:text-white">
<a href="#main" class="skip-link">Skip to content</a>

<!-- Enhanced Header -->
<header class="sticky top-0 z-50 border-b glass" style="border-color: var(--border); background: rgba(var(--bg), 0.8);">
  <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" role="navigation" aria-label="Primary">
    <div class="flex h-16 items-center justify-between">
      <!-- Enhanced Logo -->
      <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="Strenghtlink Home">
        <div class="relative">
          @if(file_exists(public_path('IMAGES/logo.png')))
            <img src="{{ asset('IMAGES/logo.png') }}" 
                 alt="Strenghtlink logo" 
                 class="h-12 w-12 rounded-2xl shadow-lg transform group-hover:scale-110 transition-all duration-300" />
          @else
            <div class="h-12 w-12 bg-gradient-to-br from-brand-500 to-brand-700 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-all duration-300">
              <span class="text-white font-bold text-lg">SL</span>
            </div>
          @endif
        </div>
        <div class="leading-tight">
          <span class="block font-bold text-xl bg-gradient-to-r from-brand-600 to-purple-600 bg-clip-text text-transparent">Strenghtlink</span>
          <span class="block text-xs muted">Empowering Survivors of GBV</span>
        </div>
      </a>

      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center gap-1">
        <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium" aria-current="page">Home</a>
        <a href="{{ route('resources.index') }}" class="px-4 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Resources</a>
        <a href="{{ route('report.create') }}" class="px-4 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Report Incident</a>
        <a href="{{ route('forum.index') }}" class="px-4 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Community Forum</a>

        <!-- Language Selector -->
        <label for="lang" class="sr-only">Language</label>
        <select id="lang" class="ml-4 rounded-lg border px-3 py-2 text-sm bg-transparent card" aria-label="Select language">
          <option>English</option>
          <option>Français</option>
          <option>IsiZulu</option>
        </select>

        <!-- Theme Toggle -->
        <button id="themeToggle" class="ml-2 inline-flex items-center justify-center rounded-lg border px-3 py-2 text-sm card hover:shadow-glow transition-all duration-200" type="button" aria-pressed="false" aria-label="Toggle dark mode">
          <span class="sr-only">Toggle dark mode</span>
          <svg id="sun" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 3a1 1 0 011 1v1a1 1 0 11-2 0V4a1 1 0 011-1zM4.22 5.22a1 1 0 011.42 0L6.34 6a1 1 0 01-1.42 1.41L4.22 6.63a1 1 0 010-1.41zM3 10a1 1 0 011-1h1a1 1 0 110 2H4a1 1 0 01-1-1zm12 0a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1zm-.56-4.78a1 1 0 011.42 1.41L15.06 7a1 1 0 11-1.42-1.41l.8-.8zM10 15a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.78-.78a1 1 0 011.41 0l.8.8A1 1 0 016.01 17l-.8-.8a1 1 0 010-1.41zm9.56 0a1 1 0 011.41 1.41l-.8.8A1 1 0 0114 16.01l.78-.8zM10 6.5A3.5 3.5 0 1010 13.5 3.5 3.5 0 0010 6.5z"/>
          </svg>
          <svg id="moon" class="h-4 w-4 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8 8 0 1010.586 10.586z"/>
          </svg>
        </button>

        <!-- Auth Links -->
        @if (Route::has('login'))
          @auth
            <a href="{{ route('dashboard') }}" class="ml-4 inline-flex items-center rounded-lg bg-brand-600 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-700 transition-all duration-200 transform hover:scale-105">Dashboard</a>
          @else
            <a href="{{ route('login') }}" class="ml-4 px-4 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Log in</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="ml-2 inline-flex items-center rounded-lg bg-gradient-to-r from-brand-500 to-brand-600 px-4 py-2 text-sm font-semibold text-white hover:from-brand-600 hover:to-brand-700 transition-all duration-200 transform hover:scale-105 shadow-glow">Join Community</a>
            @endif
          @endauth
        @endif
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobileMenuBtn" class="md:hidden inline-flex items-center justify-center rounded-lg border px-3 py-2 card hover:shadow-glow transition-all duration-200" aria-haspopup="true" aria-expanded="false" aria-controls="mobileMenu" aria-label="Open menu">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="md:hidden hidden pb-4 glass rounded-lg mt-2" role="menu" aria-label="Mobile">
      <div class="mt-2 flex flex-col gap-1">
        <a href="{{ route('home') }}" class="px-4 py-3 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Home</a>
        <a href="{{ route('resources.index') }}" class="px-4 py-3 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Resources</a>
        <a href="{{ route('report.create') }}" class="px-4 py-3 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Report Incident</a>
        <a href="{{ route('forum.index') }}" class="px-4 py-3 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Community Forum</a>
        
        <div class="px-4 py-3">
          <label for="lang-m" class="sr-only">Language</label>
          <select id="lang-m" class="w-full rounded-lg border px-3 py-2 text-sm bg-transparent card">
            <option>English</option>
            <option>Français</option>
            <option>IsiZulu</option>
          </select>
        </div>
        
        <div class="px-4 py-3 flex items-center justify-between">
          <span class="text-sm font-medium">Dark mode</span>
          <button id="themeToggleM" class="inline-flex items-center justify-center rounded-lg border px-3 py-2 text-sm card hover:shadow-glow transition-all duration-200" type="button" aria-pressed="false" aria-label="Toggle dark mode (mobile)">
            <span class="sr-only">Toggle dark mode</span>
            <svg id="sunM" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path d="M10 3a1 1 0 011 1v1a1 1 0 11-2 0V4a1 1 0 011-1zM4.22 5.22a1 1 0 011.42 0L6.34 6a1 1 0 01-1.42 1.41L4.22 6.63a1 1 0 010-1.41zM3 10a1 1 0 011-1h1a1 1 0 110 2H4a1 1 0 01-1-1zm12 0a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1zm-.56-4.78a1 1 0 011.42 1.41L15.06 7a1 1 0 11-1.42-1.41l.8-.8zM10 15a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.78-.78a1 1 0 011.41 0l.8.8A1 1 0 016.01 17l-.8-.8a1 1 0 010-1.41zm9.56 0a1 1 0 011.41 1.41l-.8.8A1 1 0 0114 16.01l.78-.8zM10 6.5A3.5 3.5 0 1010 13.5 3.5 3.5 0 0010 6.5z"/>
            </svg>
            <svg id="moonM" class="h-4 w-4 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path d="M17.293 13.293A8 8 0 016.707 2.707a8 8 0 1010.586 10.586z"/>
            </svg>
          </button>
        </div>
        
        @if (Route::has('login'))
          @auth
            <a href="{{ route('dashboard') }}" class="px-4 py-3 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Dashboard</a>
          @else
            <a href="{{ route('login') }}" class="px-4 py-3 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-200 font-medium">Log in</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="px-4 py-3 rounded-lg bg-gradient-to-r from-brand-500 to-brand-600 text-white hover:from-brand-600 hover:to-brand-700 transition-all duration-200 font-medium text-center">Join Community</a>
            @endif
          @endauth
        @endif
      </div>
    </div>
  </nav>
</header>

<main id="main" tabindex="-1" class="animate-fade-in">
  <!-- Enhanced Hero Section -->
  <section class="relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute -top-40 -right-40 w-80 h-80 bg-brand-300/20 rounded-full animate-float"></div>
      <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-300/15 rounded-full animate-float" style="animation-delay: -2s;"></div>
      <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-pink-300/10 rounded-full animate-float" style="animation-delay: -4s;"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 sm:py-28">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="animate-fade-in" style="animation-delay: 0.2s;">
          <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-tight">
            You're Not Alone —
            <span class="bg-gradient-to-r from-brand-600 to-purple-600 bg-clip-text text-transparent">Find Support & Community</span>
          </h1>
          <p class="mt-6 text-xl muted leading-relaxed">
            Strenghtlink provides a safe space to discover shelters, learn about your rights, and connect with supportive communities — all while maintaining your privacy and safety.
          </p>

          <div class="mt-8 flex flex-wrap gap-4">
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="inline-flex items-center rounded-xl bg-gradient-to-r from-brand-500 to-brand-600 px-8 py-4 text-lg font-bold text-white hover:from-brand-600 hover:to-brand-700 transition-all duration-300 transform hover:scale-105 shadow-glow-lg">
                Join Our Community
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </a>
            @endif
            <a href="{{ route('forum.index') }}" class="inline-flex items-center rounded-xl border-2 border-brand-200 px-8 py-4 text-lg font-semibold hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-300 transform hover:scale-105">
              Explore Community Forum
            </a>
          </div>

          <!-- Trust Indicators -->
          <div class="mt-8 flex flex-wrap gap-6 text-sm muted">
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
              <span>100% Confidential</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
              <span>Secure Platform</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
              <span>Support Community</span>
            </div>
          </div>
        </div>

        <!-- Enhanced Hero Image -->
        <div class="relative animate-fade-in" style="animation-delay: 0.4s;">
          <div class="relative">
            @if(file_exists(public_path('IMAGES/logo.png')))
              <img src="{{ asset('IMAGES/lll (1).jpg') }}" 
                   alt="Strenghtlink Community Support" 
                   class="w-full max-w-2xl mx-auto rounded-3xl shadow-2xl transform hover:scale-105 transition-all duration-500"
                   style="height: 500px; object-fit: cover;" />
            @else
              <div class="w-full h-96 bg-gradient-to-br from-brand-500 via-purple-600 to-indigo-700 rounded-3xl shadow-2xl flex items-center justify-center transform hover:scale-105 transition-all duration-500">
                <div class="text-center text-white p-8">
                  <div class="w-32 h-32 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                    <span class="text-white font-black text-4xl">SL</span>
                  </div>
                  <h3 class="text-2xl font-bold mb-2">Welcome to Strenghtlink</h3>
                  <p class="text-white/80">Your safe space for support and community</p>
                </div>
              </div>
            @endif
            <!-- Floating elements around image -->
            <div class="absolute -top-6 -left-6 w-24 h-24 bg-brand-500/20 rounded-full animate-float backdrop-blur-sm"></div>
            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-purple-500/15 rounded-full animate-float backdrop-blur-sm" style="animation-delay: -3s;"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Enhanced Emergency Button -->
    <a href="{{ route('resources.index') }}?q=emergency"
       class="fixed bottom-6 right-6 z-40 inline-flex items-center gap-3 rounded-full bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 text-white font-semibold shadow-2xl hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300 animate-pulse-soft"
       aria-label="Get Immediate Help">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
      </svg>
      Emergency Help
    </a>
  </section>

  <!-- Enhanced Features Section -->
  <section class="py-20 bg-gradient-to-br from-gray-50 to-brand-50 dark:from-gray-900 dark:to-brand-900/20" aria-labelledby="features-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 id="features-heading" class="text-4xl sm:text-5xl font-black bg-gradient-to-r from-brand-600 to-purple-600 bg-clip-text text-transparent">How We Support You</h2>
        <p class="mt-4 text-xl muted max-w-3xl mx-auto">Access powerful tools and resources designed specifically for your safety, support, and empowerment</p>
      </div>

      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Resource Hub -->
        <article class="card border rounded-2xl p-6 h-full transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-glow-lg group">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Resource Hub</h3>
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-brand-500/10 text-brand-600 group-hover:scale-110 transition-transform duration-300" aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M3 5h18v2H3zM3 11h18v2H3zM3 17h18v2H3z"/>
              </svg>
            </span>
          </div>
          <p class="text-gray-600 dark:text-gray-300 mb-4">Comprehensive database of shelters, counseling services, and legal aid resources</p>
          <form class="mt-4" action="{{ route('resources.index') }}" method="GET" role="search" aria-label="Quick resource search">
            <label for="q" class="sr-only">Search resources</label>
            <div class="flex gap-2">
              <input id="q" name="q" type="search" placeholder="Search resources..." class="w-full rounded-xl border px-4 py-3 bg-transparent focus:ring-2 focus:ring-brand-500" />
              <button class="rounded-xl bg-brand-600 px-4 py-3 text-white hover:bg-brand-700 transition-colors duration-200">Search</button>
            </div>
          </form>
        </article>

        <!-- Community Forum -->
        <article class="card border rounded-2xl p-6 h-full transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-glow-lg group">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Community Forum</h3>
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500/10 text-purple-600 group-hover:scale-110 transition-transform duration-300" aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0H5z"/>
              </svg>
            </span>
          </div>
          <p class="text-gray-600 dark:text-gray-300 mb-4">Connect with peers, share experiences, and find support in our moderated community</p>
          @auth
            <a href="{{ route('forum.index') }}" class="inline-flex items-center rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 px-4 py-3 text-white font-semibold hover:from-purple-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 w-full justify-center">
              Enter Forum
            </a>
          @else
            <a href="{{ route('login') }}" class="inline-flex items-center rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 px-4 py-3 text-white font-semibold hover:from-purple-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 w-full justify-center">
              Login to Join Forum
            </a>
          @endauth
        </article>

        <!-- Education Center -->
        <article class="card border rounded-2xl p-6 h-full transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-glow-lg group">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Education Hub</h3>
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-500/10 text-blue-600 group-hover:scale-110 transition-transform duration-300" aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 3l9 5-9 5-9-5 9-5zm0 7l7 3.889V18l-7 3.889L5 18v-4.111L12 10z"/>
              </svg>
            </span>
          </div>
          <p class="text-gray-600 dark:text-gray-300 mb-4">Learn about your rights, prevention strategies, and available support services</p>
          <a href="{{ route('education.index') }}" class="inline-flex items-center rounded-xl bg-gradient-to-r from-red-500 to-blue-600 px-4 py-3 text-white font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-200 transform hover:scale-105 w-full justify-center">
            Education
          </a>
        </article>

        <!-- Reporting Tools -->
        <article class="card border rounded-2xl p-6 h-full transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-glow-lg group">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Reporting Tools</h3>
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-red-500/10 text-red-600 group-hover:scale-110 transition-transform duration-300" aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M5 3a2 2 0 00-2 2v14l4-2 4 2 4-2 4 2V5a2 2 0 00-2-2H5z"/>
              </svg>
            </span>
          </div>
          <p class="text-gray-600 dark:text-gray-300 mb-4">Submit anonymous reports securely and provide feedback on your experiences</p>
          <a href="{{ route('report.create') }}" class="inline-flex items-center rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-4 py-3 text-white font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-200 transform hover:scale-105 w-full justify-center">
            Report Anonymously
          </a>
        </article>
      </div>
    </div>
  </section>

  <!-- Enhanced News Section -->
  <section class="py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl sm:text-5xl font-black bg-gradient-to-r from-brand-600 to-purple-600 bg-clip-text text-transparent">Latest Updates</h2>
        <p class="mt-4 text-xl muted max-w-3xl mx-auto">Stay informed with the latest news and resources</p>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="border-b border-gray-200 dark:border-gray-700 px-8 py-6 flex items-center justify-between">
          <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Community News & Updates</h3>
          <form method="GET" action="{{ route('news.index') }}" class="flex items-center gap-3">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search news…"
                   class="w-64 rounded-xl border border-gray-300 dark:border-gray-600 px-4 py-2 bg-transparent focus:ring-2 focus:ring-brand-500" />
            <button class="rounded-xl bg-brand-600 px-6 py-2 text-white font-semibold hover:bg-brand-700 transition-colors duration-200">Search</button>
          </form>
        </div>
        
        <div class="p-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
          @php
            $dashNews = \App\Models\News::published()->latest('published_at')->take(3)->get();
          @endphp

          @forelse($dashNews as $n)
            <a href="{{ route('news.show',$n->slug) }}" class="block rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:border-brand-300 dark:hover:border-brand-600 transition-all duration-300 transform hover:scale-105 group">
              @if($n->cover_image_path)
                <img src="{{ asset('storage/'.$n->cover_image_path) }}" alt="{{ $n->title }}" class="h-48 w-full object-cover group-hover:scale-110 transition-transform duration-300">
              @else
                <div class="h-48 w-full bg-gradient-to-br from-brand-500 to-purple-600 flex items-center justify-center">
                  <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0V3m0 4V3"/>
                  </svg>
                </div>
              @endif
              <div class="p-6">
                <div class="text-sm text-brand-600 font-semibold">{{ optional($n->published_at)->format('M d, Y') }}</div>
                <div class="mt-2 text-xl font-bold text-gray-900 dark:text-white group-hover:text-brand-600 transition-colors duration-200 line-clamp-2">{{ $n->title }}</div>
                @if($n->excerpt)
                  <div class="mt-3 text-gray-600 dark:text-gray-300 line-clamp-3">{{ $n->excerpt }}</div>
                @endif
                <div class="mt-4 inline-flex items-center text-brand-600 font-semibold group-hover:translate-x-2 transition-transform duration-200">
                  Read More
                  <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                  </svg>
                </div>
              </div>
            </a>
          @empty
            <div class="col-span-3 text-center py-12">
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0V3m0 4V3"/>
              </svg>
              <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No news yet</h3>
              <p class="mt-2 text-gray-500 dark:text-gray-400">Check back later for updates and announcements.</p>
            </div>
          @endforelse
        </div>
        
        <div class="px-8 pb-6">
          <a href="{{ route('news.index') }}" class="inline-flex items-center text-brand-600 font-semibold hover:text-brand-700 transition-colors duration-200">
            View all news and updates
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Enhanced CTA Section -->
  <section class="py-20 bg-gradient-to-br from-brand-500 to-purple-600 text-white">
    <div class="mx-auto max-w-4xl text-center px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl sm:text-5xl font-black mb-6">Ready to Find Your Support Community?</h2>
      <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">Join thousands of survivors and supporters in our safe, confidential platform designed for healing and empowerment.</p>
      
      <div class="flex flex-wrap justify-center gap-4">
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="inline-flex items-center rounded-2xl bg-white px-8 py-4 text-lg font-bold text-brand-600 hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-2xl">
            Start Your Journey Today
            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        @endif
        <a href="{{ route('forum.index') }}" class="inline-flex items-center rounded-2xl border-2 border-white/30 px-8 py-4 text-lg font-semibold text-white hover:bg-white/10 transition-all duration-300 transform hover:scale-105">
          Explore Community Forum
        </a>
      </div>
      
      <p class="mt-8 text-white/80 text-sm">Already have an account? <a href="{{ route('login') }}" class="font-semibold underline hover:text-white transition-colors duration-200">Sign in here</a></p>
    </div>
  </section>
</main>

<!-- Enhanced Footer -->
<footer class="border-t" style="border-color: var(--border);">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
      <div>
        <div class="flex items-center gap-3 mb-4">
          @if(file_exists(public_path('IMAGES/logo.png')))
            <img src="{{ asset('IMAGES/logo.png') }}" 
                 alt="Strenghtlink logo" 
                 class="h-10 w-10 rounded-xl" />
          @else
            <div class="h-10 w-10 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center">
              <span class="text-white font-bold">SL</span>
            </div>
          @endif
          <span class="font-bold text-xl bg-gradient-to-r from-brand-600 to-purple-600 bg-clip-text text-transparent">Strenghtlink</span>
        </div>
        <p class="text-sm muted max-w-sm">Your safe space for support, resources, and community connection. Information & referrals to help you find support and safety.</p>
      </div>
      
      <div>
        <h3 class="font-semibold text-lg mb-4">Explore</h3>
        <ul class="space-y-3 text-sm">
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="{{ route('resources.index') }}">Resources Hub</a></li>
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="{{ route('report.create') }}">Report Incident</a></li>
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="{{ route('forum.index') }}">Community Forum</a></li>
          @if (Route::has('login'))
            @auth
              <li><a class="hover:text-brand-600 transition-colors duration-200" href="{{ route('dashboard') }}">Dashboard</a></li>
            @else
              <li><a class="hover:text-brand-600 transition-colors duration-200" href="{{ route('login') }}">Log in</a></li>
              @if (Route::has('register'))
                <li><a class="hover:text-brand-600 transition-colors duration-200" href="{{ route('register') }}">Register</a></li>
              @endif
            @endauth
          @endif
        </ul>
      </div>
      
      <div>
        <h3 class="font-semibold text-lg mb-4">Support</h3>
        <ul class="space-y-3 text-sm">
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="#">Help Center</a></li>
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="#">Safety Guidelines</a></li>
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="#">Community Rules</a></li>
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="mailto:support@Strenghtlink.org">Contact Support</a></li>
        </ul>
      </div>
      
      <div>
        <h3 class="font-semibold text-lg mb-4">Legal & Emergency</h3>
        <ul class="space-y-3 text-sm">
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="#">Privacy Policy</a></li>
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="#">Terms of Service</a></li>
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="tel:112">Emergency: 112</a></li>
          <li><a class="hover:text-brand-600 transition-colors duration-200" href="{{ route('resources.index') }}?q=emergency">Emergency Resources</a></li>
        </ul>
      </div>
    </div>
    
    <div class="mt-12 pt-8 border-t" style="border-color: var(--border);">
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <p class="text-sm muted">&copy; {{ now()->year }} Strenghtlink. Empowering survivors, building community.</p>
        <div class="flex items-center gap-4 text-sm muted">
          <span>Follow us:</span>
          <div class="flex gap-3">
            <a href="#" class="hover:text-brand-600 transition-colors duration-200" aria-label="Twitter">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
              </svg>
            </a>
            <a href="#" class="hover:text-brand-600 transition-colors duration-200" aria-label="Facebook">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<script>
  // Mobile menu functionality
  const mmBtn = document.getElementById('mobileMenuBtn');
  const mm = document.getElementById('mobileMenu');
  if (mmBtn && mm) {
    mmBtn.addEventListener('click', () => {
      const open = !mm.classList.contains('hidden');
      mm.classList.toggle('hidden');
      mmBtn.setAttribute('aria-expanded', String(!open));
    });
  }

  // Theme functionality
  function setTheme(mode) {
    document.documentElement.setAttribute('data-theme', mode);
    localStorage.setItem('Strenghtlink-theme', mode);
    const isDark = mode === 'dark';
    
    // Update theme toggle icons
    document.getElementById('sun')?.classList.toggle('hidden', isDark);
    document.getElementById('moon')?.classList.toggle('hidden', !isDark);
    document.getElementById('sunM')?.classList.toggle('hidden', isDark);
    document.getElementById('moonM')?.classList.toggle('hidden', !isDark);
    
    // Update aria-pressed state
    document.getElementById('themeToggle')?.setAttribute('aria-pressed', String(isDark));
    document.getElementById('themeToggleM')?.setAttribute('aria-pressed', String(isDark));
  }

  // Initialize theme
  const initial = document.documentElement.getAttribute('data-theme') || 'light';
  setTheme(initial);

  // Theme toggle event listeners
  document.getElementById('themeToggle')?.addEventListener('click', () => {
    const cur = document.documentElement.getAttribute('data-theme') || 'light';
    setTheme(cur === 'dark' ? 'light' : 'dark');
  });
  
  document.getElementById('themeToggleM')?.addEventListener('click', () => {
    const cur = document.documentElement.getAttribute('data-theme') || 'light';
    setTheme(cur === 'dark' ? 'light' : 'dark');
  });

  // Add scroll animations
  document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animationPlayState = 'running';
        }
      });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.animate-fade-in').forEach(el => {
      observer.observe(el);
    });
  });
</script>
</body>
</html>