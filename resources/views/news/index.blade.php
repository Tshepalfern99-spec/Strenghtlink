<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News & Updates - Strenghtlink</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Fonts and Icons -->
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
                        purple: {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            500: '#a855f7',
                            600: '#9333ea'
                        }
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
        .card-hover { 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }
        .card-hover:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1), 0 0 20px rgba(236, 72, 153, 0.1);
            border-color: #fbcfe8;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Dashboard Layout Container -->
    <div class="min-h-screen flex">
        <!-- Overlay for mobile -->
        <div class="overlay hidden lg:hidden" id="overlay"></div>

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-soft border-r border-primary-100 hidden lg:block" aria-label="Primary">
            <!-- Logo Section -->
            <div class="p-6 border-b border-primary-100">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center shadow-lg">
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
                <a href="/dashboard"
                   class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center mr-3">
                        <i class="fas fa-home text-primary-600"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="/resources"
                   class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3">
                        <i class="fas fa-database text-blue-600"></i>
                    </div>
                    <span class="font-medium">Find Resources</span>
                </a>

                <a href="/report/create"
                   class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center mr-3">
                        <i class="fas fa-flag text-red-600"></i>
                    </div>
                    <span class="font-medium">Report Incident</span>
                </a>

                <a href="/news"
                   class="flex items-center px-4 py-3 bg-primary-50 text-primary-600 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3">
                        <i class="fas fa-newspaper text-primary-600"></i>
                    </div>
                    <span class="font-medium">News & Updates</span>
                </a>

                <a href="/forum"
                   class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center mr-3">
                        <i class="fas fa-comments text-green-600"></i>
                    </div>
                    <span class="font-medium">Community Forum</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="glass-effect shadow-soft sticky top-0 z-30">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-4">
                        <button class="text-secondary-500 hover:text-primary-600 focus:outline-none lg:hidden transition-colors duration-200" 
                                id="menu-toggle" 
                                aria-label="Open navigation">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        
                        <!-- Page Title -->
                        <div>
                            <h1 class="text-2xl font-black gradient-text">News & Updates</h1>
                            <p class="text-secondary-600 text-sm">Stay informed with the latest community news and resources</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <!-- Quick Exit -->
                        <button
                            onclick="window.location.href='https://www.google.com';"
                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-4 py-2.5 text-white font-semibold hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all duration-200 transform hover:scale-105 shadow-lg"
                            title="Quickly leave this page" 
                            aria-label="Quick exit">
                            <i class="fas fa-person-running"></i>
                            Quick Exit
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-6 animate-fade-in">
                <!-- Hero Section -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-8 text-white shadow-card mb-8">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-3xl font-black mb-4">Community Updates & Resources</h2>
                        <p class="text-purple-100 text-lg mb-6">Stay informed about the latest news, support services, and community initiatives</p>

                        <!-- Search Form -->
                        <form method="GET" class="max-w-2xl mx-auto">
                            <div class="flex gap-3">
                                <input name="q" 
                                       value="{{ request('q') }}" 
                                       placeholder="Search news, updates, resources..."
                                       class="flex-1 rounded-xl px-4 py-3 border-0 focus:outline-none focus:ring-2 focus:ring-white/50 bg-white/10 backdrop-blur-sm text-white placeholder-white/70" />
                                <button class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-purple-600 font-bold hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 transform hover:scale-105">
                                    <i class="fas fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- News Grid -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-secondary-900 flex items-center gap-2">
                            <i class="fas fa-newspaper text-primary-600"></i>
                            Latest Updates
                            @if(isset($news) && $news->total() > 0)
                                <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $news->total() }} articles
                                </span>
                            @endif
                        </h3>
                        
                        @if(isset($news) && $news->count() > 0)
                        <div class="text-sm text-secondary-500">
                            Showing {{ $news->firstItem() }}-{{ $news->lastItem() }} of {{ $news->total() }}
                        </div>
                        @endif
                    </div>

                    @if(!isset($news) || $news->count() === 0)
                        <!-- Empty State -->
                        <div class="bg-white rounded-2xl shadow-soft p-12 text-center">
                            <div class="w-20 h-20 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-newspaper text-secondary-400 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-secondary-900 mb-2">No news found</h3>
                            <p class="text-secondary-600 mb-6">
                                @if(request('q'))
                                    No articles match your search "{{ request('q') }}". Try different keywords.
                                @else
                                    There are no news articles available at the moment.
                                @endif
                            </p>
                            @if(request('q'))
                                <a href="/news" 
                                   class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-6 py-3 text-white font-semibold hover:bg-primary-600 transition-all duration-200">
                                    <i class="fas fa-refresh"></i>
                                    Clear Search
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($news as $n)
                                <article class="bg-white rounded-2xl shadow-soft overflow-hidden card-hover group">
                                    <a href="/news/{{ $n->slug }}" class="block relative">
                                        @if(isset($n->cover_image_path) && $n->cover_image_path)
                                            <img src="{{ asset('storage/'.$n->cover_image_path) }}"
                                                 alt="{{ $n->title }}" 
                                                 class="h-48 w-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="h-48 w-full bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center">
                                                <i class="fas fa-newspaper text-white text-3xl"></i>
                                            </div>
                                        @endif
                                        <div class="absolute top-4 left-4">
                                            <span class="bg-white/90 backdrop-blur-sm text-primary-600 px-3 py-1 rounded-full text-xs font-semibold">
                                                {{ $n->published_at ? $n->published_at->format('M d, Y') : 'Draft' }}
                                            </span>
                                        </div>
                                    </a>
                                    
                                    <div class="p-6">
                                        <a href="/news/{{ $n->slug }}" 
                                           class="block group-hover:text-primary-600 transition-colors duration-200">
                                            <h4 class="text-lg font-bold text-secondary-900 line-clamp-2 mb-2">
                                                {{ $n->title }}
                                            </h4>
                                        </a>
                                        
                                        @if(isset($n->excerpt) && $n->excerpt)
                                            <p class="text-secondary-600 text-sm line-clamp-3 mb-4">
                                                {{ $n->excerpt }}
                                            </p>
                                        @endif
                                        
                                        <div class="flex items-center justify-between">
                                            <a href="/news/{{ $n->slug }}" 
                                               class="inline-flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition-colors duration-200 group-hover:translate-x-1 transition-transform duration-200">
                                                Read More
                                                <i class="fas fa-arrow-right text-sm"></i>
                                            </a>
                                            
                                            <div class="text-xs text-secondary-500">
                                                {{ $n->published_at ? $n->published_at->diffForHumans() : 'Draft' }}
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if(isset($news) && $news->hasPages())
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-secondary-600">
                                Page {{ $news->currentPage() }} of {{ $news->lastPage() }}
                            </div>
                            <div class="flex gap-2">
                                @if($news->onFirstPage())
                                    <span class="inline-flex items-center gap-2 rounded-xl bg-secondary-100 px-4 py-2 text-secondary-400 font-semibold cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $news->previousPageUrl() }}" 
                                       class="inline-flex items-center gap-2 rounded-xl bg-primary-50 px-4 py-2 text-primary-700 font-semibold hover:bg-primary-100 transition-all duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                        Previous
                                    </a>
                                @endif

                                @if($news->hasMorePages())
                                    <a href="{{ $news->nextPageUrl() }}" 
                                       class="inline-flex items-center gap-2 rounded-xl bg-primary-50 px-4 py-2 text-primary-700 font-semibold hover:bg-primary-100 transition-all duration-200">
                                        Next
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-2 rounded-xl bg-secondary-100 px-4 py-2 text-secondary-400 font-semibold cursor-not-allowed">
                                        Next
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Emergency Section -->
                <div class="mt-8 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-6 text-white text-center">
                    <h3 class="text-xl font-bold mb-3">Need Immediate Help?</h3>
                    <p class="text-red-100 mb-4">Remember, support is available whenever you need it</p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="/resources" 
                           class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-red-600 font-bold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-hands-helping"></i>
                            Find Support Resources
                        </a>
                        <a href="/report/create" 
                           class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-6 py-3 text-white font-bold hover:bg-white/30 transition-all duration-200">
                            <i class="fas fa-flag"></i>
                            Report Incident
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Floating Emergency Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="/resources?q=emergency" 
           class="inline-flex items-center gap-3 rounded-full bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 text-white font-bold hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-2xl">
            <i class="fas fa-ambulance text-xl"></i>
            Emergency Help
        </a>
    </div>

    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('menu-toggle');
        const overlay = document.getElementById('overlay');
        const sidebar = document.querySelector('aside');

        if (menuBtn && overlay && sidebar) {
            menuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
                overlay.classList.toggle('hidden');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.add('hidden');
                this.classList.add('hidden');
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