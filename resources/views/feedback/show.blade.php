<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Details - Strenghtlink</title>
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
                <a href="/my/feedback" class="flex items-center px-4 py-3 bg-primary-50 text-primary-600 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3">
                        <i class="fas fa-star text-primary-600"></i>
                    </div>
                    <span class="font-medium">My Feedback</span>
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
                            <h1 class="text-2xl font-black gradient-text">Feedback Details</h1>
                            <p class="text-secondary-600 text-sm">Review your submitted feedback</p>
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
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-black mb-2">Your Feedback</h2>
                            <p class="text-primary-100 text-lg">Submitted {{ optional($feedback->created_at)->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            @php $stars = (int) ($feedback->rating ?? 0); @endphp
                            @if($stars > 0)
                                <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2">
                                    <span class="text-amber-300 text-lg">
                                        @for($i=0;$i<$stars;$i++)★@endfor
                                    </span>
                                    <span class="text-white/60 text-lg">
                                        @for($i=$stars;$i<5;$i++)☆@endfor
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Feedback Details Card -->
                <div class="glass-effect rounded-2xl shadow-card overflow-hidden mb-6 card-hover">
                    <div class="p-6 space-y-6">
                        <!-- Metadata -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-primary-50 rounded-xl p-4 text-center">
                                <div class="text-sm text-secondary-600 mb-1">Submitted</div>
                                <div class="font-semibold text-secondary-800">{{ optional($feedback->created_at)->toDayDateTimeString() }}</div>
                            </div>
                            
                            @if(!empty($feedback->context))
                            <div class="bg-primary-50 rounded-xl p-4 text-center">
                                <div class="text-sm text-secondary-600 mb-1">Context</div>
                                <div class="font-semibold text-secondary-800">{{ $feedback->context }}</div>
                            </div>
                            @endif
                            
                            <div class="bg-primary-50 rounded-xl p-4 text-center">
                                <div class="text-sm text-secondary-600 mb-1">Rating</div>
                                <div class="font-semibold text-secondary-800">
                                    @if($stars > 0)
                                        {{ $stars }}/5
                                    @else
                                        —
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Feedback Message -->
                        <div class="bg-white rounded-xl p-6 border border-secondary-200">
                            <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-comment-dots text-primary-600"></i>
                                Your Feedback
                            </h3>
                            <div class="whitespace-pre-line text-secondary-900 leading-relaxed text-lg">
                                {{ $feedback->message ?? '—' }}
                            </div>
                        </div>

                        <!-- Related Report -->
                        @if($feedback->report_id)
                            <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                                <h4 class="text-lg font-semibold text-secondary-800 mb-3 flex items-center gap-2">
                                    <i class="fas fa-flag text-blue-600"></i>
                                    Related Report
                                </h4>
                                <a href="{{ route('my.reports.show', $feedback->report_id) }}"
                                   class="inline-flex items-center gap-2 rounded-xl bg-blue-100 px-4 py-2 text-blue-700 font-semibold hover:bg-blue-200 transition-all duration-200">
                                    <i class="fas fa-external-link-alt"></i>
                                    View Related Report
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <a href="{{ route('my.feedback.index') }}" 
                       class="glass-effect rounded-2xl p-6 text-center card-hover group">
                        <div class="h-12 w-12 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <h3 class="font-semibold text-secondary-800 mb-2">Back to My Feedback</h3>
                        <p class="text-secondary-600 text-sm">Return to your feedback list</p>
                    </a>

                    <form action="{{ route('my.feedback.destroy', $feedback) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this feedback? This action cannot be undone.')"
                          class="glass-effect rounded-2xl p-6 text-center card-hover group">
                        @csrf
                        @method('DELETE')
                        <div class="h-12 w-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-trash"></i>
                        </div>
                        <h3 class="font-semibold text-secondary-800 mb-2">Delete Feedback</h3>
                        <p class="text-secondary-600 text-sm">Permanently remove this feedback</p>
                        <button type="submit" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-red-600 px-4 py-2 text-white font-semibold hover:bg-red-700 transition-all duration-200">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </form>
                </div>

                <!-- Emergency Section -->
                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-6 text-white text-center">
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