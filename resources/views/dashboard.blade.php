<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Dashboard - Strenghtlink</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://cdn.tailwindcss.com"></script>
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
                            danger: '#ef4444',
                            success: '#10b981',
                            warning: '#f59e0b',
                            info: '#3b82f6'
                        },
                        boxShadow: {
                            'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                            'glow': '0 0 20px rgba(236, 72, 153, 0.15)',
                            'glow-lg': '0 0 40px rgba(236, 72, 153, 0.2)'
                        },
                        animation: {
                            'fade-in': 'fadeIn 0.5s ease-in-out',
                            'slide-in': 'slideIn 0.3s ease-out',
                            'float': 'float 6s ease-in-out infinite',
                            'pulse-soft': 'pulseSoft 2s ease-in-out infinite'
                        },
                        keyframes: {
                            fadeIn: {
                                '0%': { opacity: '0', transform: 'translateY(10px)' },
                                '100%': { opacity: '1', transform: 'translateY(0)' }
                            },
                            slideIn: {
                                '0%': { transform: 'translateX(-100%)' },
                                '100%': { transform: 'translateX(0)' }
                            },
                            float: {
                                '0%, 100%': { transform: 'translateY(0px)' },
                                '50%': { transform: 'translateY(-8px)' }
                            },
                            pulseSoft: {
                                '0%, 100%': { opacity: '1' },
                                '50%': { opacity: '0.8' }
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
            }
            .dashboard-container { 
                display: flex; 
                min-height: 100vh; 
            }
            .sidebar { 
                width: 280px; 
                background: linear-gradient(180deg, #ffffff 0%, #fdf2f8 100%);
                box-shadow: 0 0 25px rgba(0,0,0,.08);
                transition: all .3s ease;
                border-right: 1px solid #fce7f3;
            }
            .main-content { 
                flex: 1; 
                overflow: auto;
                background: transparent;
            }
            @media (max-width: 1024px) {
                .sidebar { 
                    transform: translateX(-100%); 
                    position: fixed; 
                    z-index: 50; 
                    height: 100vh;
                    box-shadow: 0 0 50px rgba(0,0,0,.1);
                }
                .sidebar.active { transform: translateX(0); }
                .overlay { 
                    display:none; 
                    position:fixed; 
                    inset:0; 
                    background-color: rgba(0,0,0,.4); 
                    z-index:40;
                    backdrop-filter: blur(4px);
                }
                .overlay.active { display:block; }
            }
            .nav-item { 
                transition: all .3s ease; 
                border-left: 4px solid transparent;
                margin: 4px 12px;
                border-radius: 12px;
            }
            .nav-item:hover { 
                background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
                border-left-color: #ec4899;
                transform: translateX(4px);
            }
            .nav-item.active { 
                background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
                border-left-color: #ec4899;
                color: #db2777;
                box-shadow: 0 4px 12px rgba(236, 72, 153, 0.15);
            }
            .card-hover { 
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border: 1px solid transparent;
            }
            .card-hover:hover { 
                transform: translateY(-5px); 
                box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1), 0 0 20px rgba(236, 72, 153, 0.1);
                border-color: #fbcfe8;
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .gradient-text {
                background: linear-gradient(135deg, #ec4899 0%, #db2777 50%, #be185d 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .status-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: #10b981;
                box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
            }
        </style>
    </head>
    <body class="antialiased">
    <div class="dashboard-container">
        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>

        <!-- Enhanced Sidebar -->
        <aside class="sidebar" id="sidebar" aria-label="Primary">
            <!-- Logo Section -->
            <div class="p-6 border-b border-primary-100">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-heart text-white text-lg"></i>
                    </div>
                    <div>
                        <span class="text-xl font-black gradient-text">Strenghtlink</span>
                        <p class="text-xs text-secondary-500 mt-1">Support Community</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-3" role="navigation">
                <a href="{{ route('dashboard') }}"
                   class="nav-item flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'active text-primary-600' : 'text-secondary-600' }}">
                    <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center mr-3">
                        <i class="fas fa-home text-primary-600"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('resources.index') }}"
                   class="nav-item flex items-center px-4 py-3 {{ request()->routeIs('resources.*') ? 'active text-primary-600' : 'text-secondary-600' }}">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3">
                        <i class="fas fa-database text-blue-600"></i>
                    </div>
                    <span class="font-medium">Find Resources</span>
                </a>

                <a href="{{ route('report.create') }}"
                   class="nav-item flex items-center px-4 py-3 {{ request()->routeIs('report.*') ? 'active text-primary-600' : 'text-secondary-600' }}">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center mr-3">
                        <i class="fas fa-flag text-red-600"></i>
                    </div>
                    <span class="font-medium">Report (Anonymous)</span>
                </a>

                <a href="{{ route('news.index') }}"
                   class="nav-item flex items-center px-4 py-3 {{ request()->routeIs('news.*') ? 'active text-primary-600' : 'text-secondary-600' }}">
                    <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center mr-3">
                        <i class="fas fa-newspaper text-purple-600"></i>
                    </div>
                    <span class="font-medium">News & Updates</span>
                </a>

                <a href="{{ route('forum.index') }}"
                   class="nav-item flex items-center px-4 py-3 {{ request()->routeIs('forum.*') ? 'active text-primary-600' : 'text-secondary-600' }}">
                    <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center mr-3">
                        <i class="fas fa-comments text-green-600"></i>
                    </div>
                    <span class="font-medium">Community Forum</span>
                </a>
                <a href="{{ route('education.index') }}"
                class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center justify-center text-center hover:shadow transition">
               <div class="p-3 rounded-full bg-rose-100 text-rose-600 mb-2">
                 <i class="fas fa-graduation-cap"></i>
               </div>
               <p class="text-sm font-medium">Education</p>
             </a>
             
                <a href="{{ route('profile.edit') }}"
                   class="nav-item flex items-center px-4 py-3 {{ request()->routeIs('profile.*') ? 'active text-primary-600' : 'text-secondary-600' }}">
                    <div class="w-8 h-8 rounded-lg bg-secondary-50 flex items-center justify-center mr-3">
                        <i class="fas fa-user-gear text-secondary-600"></i>
                    </div>
                    <span class="font-medium">Profile & Settings</span>
                </a>
            </nav>

            <!-- User Profile Section -->
            <div class="absolute bottom-0 w-full p-6 border-t border-primary-100 bg-white/50 backdrop-blur-sm">
                <div class="flex items-center mb-4">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U',0,1)) }}
                        </div>
                        <div class="status-dot absolute -bottom-1 -right-1"></div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-semibold text-secondary-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-secondary-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full gap-2 px-4 py-2 text-sm text-secondary-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 font-medium">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Enhanced Header -->
            <header class="glass-effect shadow-soft sticky top-0 z-30" role="banner">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-4">
                        <button class="text-secondary-500 hover:text-primary-600 focus:outline-none lg:hidden transition-colors duration-200" 
                                id="menu-toggle" 
                                aria-label="Open navigation">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        
                        <!-- Search Bar -->
                        <div class="relative w-80">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-search text-secondary-400" aria-hidden="true"></i>
                            </span>
                            <form action="{{ route('resources.index') }}" method="GET">
                                <input class="w-full pl-10 pr-4 py-3 rounded-xl border border-secondary-200 bg-white/80 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 placeholder-secondary-400"
                                       type="text" 
                                       placeholder="Search resources, help, support..." 
                                       name="q" 
                                       aria-label="Search resources">
                            </form>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <!-- Emergency Button -->
                        <button
                            onclick="window.location.href='https://www.google.com';"
                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-4 py-2.5 text-white font-semibold hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all duration-200 transform hover:scale-105 shadow-lg animate-pulse-soft"
                            title="Quickly leave this page" 
                            aria-label="Quick exit">
                            <i class="fas fa-person-running"></i>
                            Quick Exit
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-6 animate-fade-in" role="main">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-black text-secondary-900 mb-2">
                                Welcome back, <span class="gradient-text">{{ Auth::user()->name }}</span>! 👋
                            </h1>
                            <p class="text-secondary-600 text-lg">Your safe space for support, resources, and community connection.</p>
                        </div>
                        <div class="hidden lg:block">
                            <div class="text-right">
                                <p class="text-sm text-secondary-500">Last login</p>
                                <p class="text-sm font-medium text-secondary-700">{{ Auth::user()->last_login_at?->diffForHumans() ?? 'First time' }}</p>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->role === 'admin')
                        <div class="mt-4 rounded-2xl bg-gradient-to-r from-purple-500 to-purple-600 p-4 text-white shadow-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-shield-alt text-xl"></i>
                                    <div>
                                        <p class="font-semibold">Administrator Access</p>
                                        <p class="text-sm text-purple-100">You have full platform privileges</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="inline-flex items-center gap-2 rounded-lg bg-white/20 px-4 py-2 text-sm font-semibold backdrop-blur-sm hover:bg-white/30 transition-all duration-200">
                                    Admin Dashboard
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Quick Actions Grid -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-secondary-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-bolt text-primary-600"></i>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Resources Card -->
                        <a href="{{ route('resources.index') }}" 
                           class="bg-white rounded-2xl shadow-soft p-6 flex flex-col items-center text-center card-hover group">
                            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-map-location-dot text-2xl text-blue-600"></i>
                            </div>
                            <h4 class="font-semibold text-secondary-900 mb-2">Browse Resources</h4>
                            <p class="text-sm text-secondary-500">Find shelters, counseling, and support services</p>
                            <div class="mt-3 inline-flex items-center text-blue-600 text-sm font-medium">
                                Explore
                                <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                            </div>
                        </a>

                        <!-- Report Card -->
                        <a href="{{ route('report.create') }}" 
                           class="bg-white rounded-2xl shadow-soft p-6 flex flex-col items-center text-center card-hover group">
                            <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-flag text-2xl text-red-600"></i>
                            </div>
                            <h4 class="font-semibold text-secondary-900 mb-2">Anonymous Report</h4>
                            <p class="text-sm text-secondary-500">Submit reports securely and confidentially</p>
                            <div class="mt-3 inline-flex items-center text-red-600 text-sm font-medium">
                                Report
                                <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                            </div>
                        </a>

                        <!-- News Card -->
                        <a href="{{ route('news.index') }}" 
                           class="bg-white rounded-2xl shadow-soft p-6 flex flex-col items-center text-center card-hover group">
                            <div class="w-16 h-16 rounded-2xl bg-purple-50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-newspaper text-2xl text-purple-600"></i>
                            </div>
                            <h4 class="font-semibold text-secondary-900 mb-2">Latest News</h4>
                            <p class="text-sm text-secondary-500">Stay updated with community news</p>
                            <div class="mt-3 inline-flex items-center text-purple-600 text-sm font-medium">
                                Read
                                <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                            </div>
                        </a>

                        <!-- Community Card -->
                        <a href="{{ route('forum.index') }}" 
                           class="bg-white rounded-2xl shadow-soft p-6 flex flex-col items-center text-center card-hover group">
                            <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-comments text-2xl text-green-600"></i>
                            </div>
                            <h4 class="font-semibold text-secondary-900 mb-2">Community Forum</h4>
                            <p class="text-sm text-secondary-500">Connect with supportive peers</p>
                            <div class="mt-3 inline-flex items-center text-green-600 text-sm font-medium">
                                Connect
                                <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                            </div>
                        </a>
                          
                        <a href="{{ route('my.reports.index') }}"
                        class="bg-white rounded-2xl shadow-soft p-6 flex flex-col items-center text-center card-hover group">
                         <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                             <i class="fas fa-comments text-2xl text-green-600"></i>
                         </div>
                         <h4 class="font-semibold text-secondary-900 mb-2">My Reports</h4>
                         <p class="text-sm text-secondary-500">Cview report status</p>
                         <div class="mt-3 inline-flex items-center text-green-600 text-sm font-medium">
                             Connect
                             <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                         </div>
                     </a>
                     <a href="{{ route('site.feedback.create') }}"
                     class="bg-white rounded-2xl shadow-soft p-6 flex flex-col items-center text-center card-hover group">
                      <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                          <i class="fas fa-comments text-2xl text-green-600"></i>
                      </div>
                      <h4 class="font-semibold text-secondary-900 mb-2">website feedbacks</h4>
                      <p class="text-sm text-secondary-500">Cview report status</p>
                      <div class="mt-3 inline-flex items-center text-green-600 text-sm font-medium">
                          Connect
                          <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                      </div>
                  </a>
                    </div>
                    <a href="{{ route('education.index') }}"
                class="bg-white rounded-2xl shadow-soft p-6 flex flex-col items-center text-center card-hover group">
                 <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                     <i class="fas fa-flag text-2xl text-red-600"></i>
                 </div>
                 <h4 class="font-semibold text-secondary-900 mb-2">Education</h4>
                 <p class="text-sm text-secondary-500">view content</p>
                 <div class="mt-3 inline-flex items-center text-red-600 text-sm font-medium">
                     Report
                     <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                 </div>
                </a>
                </div>
                
             
                <!-- Main Dashboard Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Resource Search Panel -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-soft p-6 card-hover">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold text-secondary-900 flex items-center gap-2">
                                    <i class="fas fa-search-location text-primary-600"></i>
                                    Find Help Nearby
                                </h3>
                                <a class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium text-sm transition-colors duration-200" 
                                   href="{{ route('resources.index') }}">
                                    Browse all resources
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                            
                            <form method="GET" action="{{ route('resources.index') }}" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-secondary-700 mb-2">What are you looking for?</label>
                                        <input type="text" 
                                               name="q" 
                                               placeholder="Shelter, counseling, legal aid…"
                                               class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-secondary-700 mb-2">Resource Type</label>
                                        <select name="type" 
                                                class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">
                                            <option value="">All Resources</option>
                                            <option value="shelter">Shelter/Housing</option>
                                            <option value="counselling">Counseling</option>
                                            <option value="legal_aid">Legal Aid</option>
                                            <option value="medical">Medical Services</option>
                                            <option value="support_group">Support Groups</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-3 pt-2">
                                    <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-3 text-white font-semibold hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                        <i class="fas fa-search"></i>
                                        Search Resources
                                    </button>
                                    <a href="{{ route('resources.index') }}" 
                                       class="inline-flex items-center gap-2 rounded-xl border border-primary-200 bg-white px-6 py-3 text-primary-700 font-semibold hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200">
                                        <i class="fas fa-list"></i>
                                        View All
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Latest News Panel -->
                    <div class="bg-white rounded-2xl shadow-soft p-6 card-hover">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-secondary-900 flex items-center gap-2">
                                <i class="fas fa-newspaper text-purple-600"></i>
                                Latest Updates
                            </h3>
                            <a class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium text-sm transition-colors duration-200" 
                               href="{{ route('news.index') }}">
                                All news
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        
                        @php
                            $latestNews = \App\Models\News::whereNotNull('published_at')
                                ->where('published_at','<=', now())
                                ->latest('published_at')
                                ->take(3)->get();
                        @endphp
                        
                        <div class="space-y-4">
                            @forelse($latestNews as $n)
                                <a href="{{ route('news.show', $n->slug) }}" 
                                   class="block group transform hover:scale-105 transition-transform duration-200">
                                    <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-purple-50 transition-colors duration-200">
                                        @if($n->cover_image_path)
                                            <img src="{{ asset('storage/'.$n->cover_image_path) }}" 
                                                 alt="{{ $n->title }}"
                                                 class="w-16 h-16 rounded-xl object-cover flex-shrink-0 shadow-sm" />
                                        @else
                                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                                                <i class="fas fa-newspaper text-white text-lg"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-secondary-900 group-hover:text-purple-700 line-clamp-2 transition-colors duration-200">
                                                {{ $n->title }}
                                            </h4>
                                            <p class="text-xs text-secondary-500 mt-1">
                                                {{ optional($n->published_at)->toFormattedDateString() }}
                                            </p>
                                            @if($n->excerpt)
                                                <p class="text-sm text-secondary-600 mt-2 line-clamp-2">
                                                    {{ $n->excerpt }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-8">
                                    <i class="fas fa-newspaper text-4xl text-secondary-300 mb-3"></i>
                                    <p class="text-secondary-500">No news updates yet</p>
                                    <p class="text-sm text-secondary-400 mt-1">Check back later for updates</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Safety Notice -->
                <div class="mt-8 rounded-2xl bg-gradient-to-r from-red-500 to-red-600 p-6 text-white shadow-lg">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-lg mb-1">Your Safety is Our Priority</h4>
                            <p class="text-red-100">In immediate danger? Use the Quick Exit button and contact local emergency services immediately.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        const menuBtn = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (menuBtn && sidebar && overlay) {
            menuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                this.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        // Add smooth animations to cards on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all cards for animation
            document.querySelectorAll('.card-hover').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
    </body>
    </html>
</x-app-layout>