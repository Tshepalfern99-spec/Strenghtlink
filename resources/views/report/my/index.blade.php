{{-- resources/views/report/my/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Reports - Strenghtlink</title>
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
                <a href="/dashboard" class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center mr-3">
                        <i class="fas fa-home text-primary-600"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="/resources" class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3">
                        <i class="fas fa-database text-blue-600"></i>
                    </div>
                    <span class="font-medium">Find Resources</span>
                </a>
                <a href="/report/create" class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center mr-3">
                        <i class="fas fa-flag text-red-600"></i>
                    </div>
                    <span class="font-medium">Report Incident</span>
                </a>
                <a href="/my/reports" class="flex items-center px-4 py-3 bg-primary-50 text-primary-600 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3">
                        <i class="fas fa-list-check text-primary-600"></i>
                    </div>
                    <span class="font-medium">My Reports</span>
                </a>
                <a href="/forum" class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
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
                        <button class="text-secondary-500 hover:text-primary-600 focus:outline-none lg:hidden transition-colors duration-200" id="menu-toggle" aria-label="Open navigation">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <!-- Page Title -->
                        <div>
                            <h1 class="text-2xl font-black gradient-text">My Reports</h1>
                            <p class="text-secondary-600 text-sm">Manage and track your incident reports</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <!-- Quick Exit -->
                        <button onclick="window.location.href='https://www.google.com';" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-4 py-2.5 text-white font-semibold hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all duration-200 transform hover:scale-105 shadow-lg" title="Quickly leave this page" aria-label="Quick exit">
                            <i class="fas fa-person-running"></i>
                            Quick Exit
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-6 animate-fade-in">
                <!-- Hero Section -->
                <div class="bg-gradient-to-br from-primary-500 to-purple-600 rounded-2xl p-8 text-white shadow-card mb-8">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-3xl font-black mb-4">Your Incident Reports</h2>
                        <p class="text-primary-100 text-lg mb-6">Track the status and details of all your submitted reports</p>
                        <a href="{{ route('report.create') }}" 
                           class="inline-flex items-center gap-3 rounded-xl bg-white px-8 py-4 text-primary-600 font-bold hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-plus"></i>
                            New Report
                        </a>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="glass-effect rounded-2xl p-6 text-center card-hover">
                        <div class="h-12 w-12 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="text-2xl font-bold text-secondary-800 mb-1">{{ $reports->total() }}</div>
                        <p class="text-secondary-600 text-sm">Total Reports</p>
                    </div>

                    <div class="glass-effect rounded-2xl p-6 text-center card-hover">
                        <div class="h-12 w-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="text-2xl font-bold text-secondary-800 mb-1">
                            @php
                                $openCount = $reports->getCollection()->whereIn('status', ['pending','in_review','new'])->count();
                            @endphp
                            {{ $openCount }}
                        </div>
                        <p class="text-secondary-600 text-sm">Open Reports</p>
                    </div>

                    <div class="glass-effect rounded-2xl p-6 text-center card-hover">
                        <div class="h-12 w-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="text-2xl font-bold text-secondary-800 mb-1">
                            @php
                                $resolvedCount = $reports->getCollection()->where('status', 'resolved')->count();
                            @endphp
                            {{ $resolvedCount }}
                        </div>
                        <p class="text-secondary-600 text-sm">Resolved</p>
                    </div>
                </div>

                <!-- Reports Table -->
                <div class="glass-effect rounded-2xl shadow-card overflow-hidden mb-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-secondary-100 bg-secondary-50/50">
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Reference</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Created</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-secondary-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-secondary-100">
                                @forelse($reports as $r)
                                    @php
                                        $ref = $r->reference ?? ('R-'.str_pad($r->id, 6, '0', STR_PAD_LEFT));
                                        $statusBadge = match($r->status){
                                            'resolved'  => 'bg-green-100 text-green-700 border border-green-200',
                                            'in_review' => 'bg-blue-100 text-blue-700 border border-blue-200',
                                            'pending','new' => 'bg-amber-100 text-amber-700 border border-amber-200',
                                            default     => 'bg-secondary-100 text-secondary-700 border border-secondary-200'
                                        };
                                        $cat = is_string($r->category) ? str_replace('_',' ', $r->category) : '—';
                                    @endphp
                                    <tr class="hover:bg-primary-50/30 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="h-8 w-8 rounded-lg bg-primary-100 text-primary-600 grid place-items-center flex-shrink-0">
                                                    <i class="fas fa-flag text-xs"></i>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-secondary-800">{{ $ref }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="capitalize text-secondary-700">{{ $cat }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium {{ $statusBadge }}">
                                                <i class="fas fa-circle text-xs"></i>
                                                {{ ucfirst(str_replace('_',' ', $r->status ?? 'unknown')) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-secondary-800">{{ optional($r->created_at)->format('M j, Y') }}</div>
                                            <div class="text-xs text-secondary-500">{{ optional($r->created_at)->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('my.reports.show', $r) }}"
                                                   class="inline-flex items-center gap-1 rounded-lg border border-secondary-300 px-3 py-1.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-colors">
                                                    <i class="fas fa-eye text-xs"></i>
                                                    View
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="h-16 w-16 rounded-2xl bg-secondary-100 text-secondary-400 grid place-items-center mx-auto mb-4">
                                                <i class="fas fa-flag text-2xl"></i>
                                            </div>
                                            <h3 class="text-lg font-semibold text-secondary-700 mb-2">No reports yet</h3>
                                            <p class="text-secondary-500 max-w-md mx-auto mb-4">
                                                You haven't submitted any reports yet. Create your first report to get started.
                                            </p>
                                            <a href="{{ route('report.create') }}" 
                                               class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-3 text-sm font-medium text-white hover:shadow-glow transition-all duration-200">
                                                <i class="fas fa-plus"></i>
                                                Create First Report
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if($reports->hasPages())
                <div class="glass-effect rounded-2xl shadow-card p-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-secondary-600">
                            Page {{ $reports->currentPage() }} of {{ $reports->lastPage() }}
                        </div>
                        <div class="flex gap-2">
                            @if($reports->onFirstPage())
                                <span class="inline-flex items-center gap-2 rounded-xl bg-secondary-100 px-4 py-2 text-secondary-400 font-semibold cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                    Previous
                                </span>
                            @else
                                <a href="{{ $reports->previousPageUrl() }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-50 px-4 py-2 text-primary-700 font-semibold hover:bg-primary-100 transition-all duration-200">
                                    <i class="fas fa-chevron-left"></i>
                                    Previous
                                </a>
                            @endif
                            @if($reports->hasMorePages())
                                <a href="{{ $reports->nextPageUrl() }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-50 px-4 py-2 text-primary-700 font-semibold hover:bg-primary-100 transition-all duration-200">
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
                        <a href="/resources" class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-red-600 font-bold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-hands-helping"></i>
                            Find Support Resources
                        </a>
                        <a href="/report/create" class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-6 py-3 text-white font-bold hover:bg-white/30 transition-all duration-200">
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
        <a href="/resources?q=emergency" class="inline-flex items-center gap-3 rounded-full bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 text-white font-bold hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-2xl">
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