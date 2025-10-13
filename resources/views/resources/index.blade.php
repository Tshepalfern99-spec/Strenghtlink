<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Help • Resources - Strenghtlink</title>
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
                        success: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a'
                        },
                        blue: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb'
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
        .resource-badge {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
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
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
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
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center mr-3">
                        <i class="fas fa-home text-primary-600"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('resources.index') }}"
                   class="flex items-center px-4 py-3 bg-primary-50 text-primary-600 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3">
                        <i class="fas fa-database text-primary-600"></i>
                    </div>
                    <span class="font-medium">Find Resources</span>
                </a>

                <a href="{{ route('report.create') }}"
                   class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center mr-3">
                        <i class="fas fa-flag text-red-600"></i>
                    </div>
                    <span class="font-medium">Report Incident</span>
                </a>

                <a href="{{ route('news.index') }}"
                   class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center mr-3">
                        <i class="fas fa-newspaper text-purple-600"></i>
                    </div>
                    <span class="font-medium">News & Updates</span>
                </a>

                <a href="{{ route('forum.index') }}"
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
                            <h1 class="text-2xl font-black gradient-text">Find Help & Resources</h1>
                            <p class="text-secondary-600 text-sm">Search shelters, counseling, and legal aid services</p>
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
                <!-- Hero Search Section -->
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl p-8 text-white shadow-card mb-8">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-3xl font-black mb-4">Find Immediate Support</h2>
                        <p class="text-primary-100 text-lg mb-6">Search for shelters, counseling services, legal aid, and emergency resources in your area</p>

                        <!-- Search Form -->
                        <form method="GET" action="{{ route('resources.index') }}" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="md:col-span-2">
                                    <input type="text" 
                                           name="q" 
                                           value="{{ $filters['q'] ?? '' }}" 
                                           placeholder="Search by name, location, or service type..."
                                           class="w-full rounded-xl px-4 py-3 border-0 focus:outline-none focus:ring-2 focus:ring-white/50 bg-white/10 backdrop-blur-sm text-white placeholder-white/70">
                                </div>
                                <div>
                                    <select name="category_id" 
                                            aria-label="Filter by category"
                                            class="w-full rounded-xl px-4 py-3 border-0 focus:outline-none focus:ring-2 focus:ring-white/50 bg-white/10 backdrop-blur-sm text-white">
                                        <option value="" class="text-secondary-800">All categories</option>
                                        @foreach($categories as $c)
                                            <option value="{{ $c->id }}" @selected(($filters['category_id'] ?? '') == $c->id) class="text-secondary-800">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" 
                                    class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-3 text-primary-600 font-bold hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-search"></i>
                                Search Resources
                            </button>
                        </form>

                        <!-- Quick Navigation -->
                        <div class="flex flex-wrap justify-center gap-3 mt-6">
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-4 py-2 text-white font-semibold hover:bg-white/30 transition-all duration-200">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('report.create') }}" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-4 py-2 text-white font-semibold hover:bg-white/30 transition-all duration-200">
                                <i class="fas fa-flag"></i>
                                Report Incident
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Resources Grid -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-secondary-900 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-primary-600"></i>
                            Available Resources
                            <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $resources->total() }} found
                            </span>
                        </h3>
                        
                        @if($resources->count() > 0)
                        <div class="text-sm text-secondary-500">
                            Showing {{ $resources->firstItem() }}-{{ $resources->lastItem() }} of {{ $resources->total() }}
                        </div>
                        @endif
                    </div>

                    @if($resources->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($resources as $r)
                                @php
                                    $tel = $r->phone ? 'tel:'.preg_replace('/[^+0-9]/','', $r->phone) : null;
                                    $sms = $r->phone ? 'sms:'.preg_replace('/[^+0-9]/','', $r->phone) : null;
                                @endphp
                                
                                <div class="bg-white rounded-2xl shadow-soft p-6 card-hover">
                                    <!-- Category Badge -->
                                    <div class="resource-badge mb-4">
                                        {{ optional($r->category)->name ?? 'General Support' }}
                                    </div>

                                    <!-- Resource Name -->
                                    <h4 class="text-lg font-bold text-secondary-900 mb-2 line-clamp-2">{{ $r->name }}</h4>

                                    <!-- Location -->
                                    <div class="flex items-center gap-2 text-secondary-600 mb-4">
                                        <i class="fas fa-location-dot text-sm"></i>
                                        <span class="text-sm">{{ trim(($r->city ?? '').', '.($r->province ?? ''), ', ') }}</span>
                                    </div>

                                    <!-- Contact Actions -->
                                    <div class="grid grid-cols-2 gap-2 mb-4">
                                        @if($tel)
                                            <a href="{{ $tel }}" 
                                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-green-50 px-3 py-2 text-green-700 font-semibold hover:bg-green-100 transition-all duration-200 text-sm"
                                               aria-label="Call {{ $r->name }}">
                                                <i class="fas fa-phone"></i>
                                                Call
                                            </a>
                                        @endif
                                        
                                        @if($sms)
                                            <a href="{{ $sms }}" 
                                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-50 px-3 py-2 text-blue-700 font-semibold hover:bg-blue-100 transition-all duration-200 text-sm"
                                               aria-label="Text {{ $r->name }}">
                                                <i class="fas fa-comment"></i>
                                                Text
                                            </a>
                                        @endif
                                        
                                        @if($r->email)
                                            <a href="mailto:{{ $r->email }}" 
                                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-yellow-50 px-3 py-2 text-yellow-700 font-semibold hover:bg-yellow-100 transition-all duration-200 text-sm"
                                               aria-label="Email {{ $r->name }}">
                                                <i class="fas fa-envelope"></i>
                                                Email
                                            </a>
                                        @endif
                                        
                                        @if($r->website)
                                            <a href="{{ $r->website }}" 
                                               target="_blank" 
                                               rel="noopener"
                                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-purple-50 px-3 py-2 text-purple-700 font-semibold hover:bg-purple-100 transition-all duration-200 text-sm"
                                               aria-label="Open website for {{ $r->name }}">
                                                <i class="fas fa-globe"></i>
                                                Website
                                            </a>
                                        @endif
                                    </div>

                                    <!-- View Details -->
                                    <a href="{{ route('resources.show', $r) }}" 
                                       class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-50 px-4 py-2 text-primary-700 font-semibold hover:bg-primary-100 transition-all duration-200 w-full"
                                       aria-label="View details for {{ $r->name }}">
                                        <i class="fas fa-eye"></i>
                                        View Details
                                        <i class="fas fa-arrow-right text-sm"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-white rounded-2xl shadow-soft p-12 text-center">
                            <div class="w-20 h-20 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-search text-secondary-400 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-secondary-900 mb-2">No resources found</h3>
                            <p class="text-secondary-600 mb-6">Try adjusting your search terms or browse all categories</p>
                            <a href="{{ route('resources.index') }}" 
                               class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-6 py-3 text-white font-semibold hover:bg-primary-600 transition-all duration-200">
                                <i class="fas fa-refresh"></i>
                                Clear Filters
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($resources->hasPages())
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-secondary-600">
                                Page {{ $resources->currentPage() }} of {{ $resources->lastPage() }}
                            </div>
                            <div class="flex gap-2">
                                @if($resources->onFirstPage())
                                    <span class="inline-flex items-center gap-2 rounded-xl bg-secondary-100 px-4 py-2 text-secondary-400 font-semibold cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $resources->previousPageUrl() }}" 
                                       class="inline-flex items-center gap-2 rounded-xl bg-primary-50 px-4 py-2 text-primary-700 font-semibold hover:bg-primary-100 transition-all duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                        Previous
                                    </a>
                                @endif

                                @if($resources->hasMorePages())
                                    <a href="{{ $resources->nextPageUrl() }}" 
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
                <div class="mt-8 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-8 text-white text-center">
                    <h3 class="text-2xl font-bold mb-4">Need Immediate Help?</h3>
                    <p class="text-red-100 mb-6">If you're in immediate danger, contact emergency services right away</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="tel:112" 
                           class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-red-600 font-bold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-phone"></i>
                            Call Emergency: 112
                        </a>
                        <a href="{{ route('report.create') }}" 
                           class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-6 py-3 text-white font-bold hover:bg-white/30 transition-all duration-200">
                            <i class="fas fa-flag"></i>
                            Report Urgent Incident
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Floating Emergency Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="{{ route('resources.index') }}?q=emergency" 
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