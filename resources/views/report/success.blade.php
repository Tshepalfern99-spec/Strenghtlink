<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Submitted • Strengthlink</title>
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
                            600: '#16a34a',
                            700: '#15803d'
                        }
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'glow': '0 0 20px rgba(236, 72, 153, 0.15)'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite'
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
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' }
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
            transform: translateY(-2px); 
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 0 15px rgba(236, 72, 153, 0.1);
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
                   class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3">
                        <i class="fas fa-database text-blue-600"></i>
                    </div>
                    <span class="font-medium">Find Resources</span>
                </a>

                <a href="{{ route('report.create') }}"
                   class="flex items-center px-4 py-3 bg-primary-50 text-primary-600 rounded-xl transition-all duration-200 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3">
                        <i class="fas fa-flag text-primary-600"></i>
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
                            <h1 class="text-2xl font-black gradient-text">Report Submitted</h1>
                            <p class="text-secondary-600 text-sm">Thank you for your courage in reporting</p>
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
                <div class="max-w-4xl mx-auto">
                    <!-- Success Confirmation Card -->
                    <div class="bg-white rounded-2xl shadow-soft p-8 mb-6 text-center animate-bounce-gentle">
                        <div class="w-20 h-20 bg-gradient-to-br from-success-500 to-success-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-check text-white text-2xl"></i>
                        </div>
                        
                        <h2 class="text-3xl font-black text-success-600 mb-4">Thank You For Your Report</h2>
                        <p class="text-lg text-secondary-600 mb-6">We've received your submission and appreciate your courage in coming forward.</p>

                        <!-- Report Details -->
                        <div class="bg-success-50 rounded-xl p-6 max-w-md mx-auto mb-6">
                            <div class="grid grid-cols-2 gap-4 text-left">
                                <div>
                                    <p class="text-sm font-semibold text-secondary-700">Reference Number</p>
                                    <p class="text-lg font-black text-success-600">#{{ $report->id }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-secondary-700">Category</p>
                                    <p class="text-lg font-medium text-secondary-900">
                                        {{ $categories[$report->category][1] ?? '' }} {{ $categories[$report->category][0] ?? ucfirst($report->category) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Confirmation -->
                        <div class="bg-blue-50 rounded-xl p-4 max-w-md mx-auto mb-6">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-envelope text-blue-600 text-lg mt-1"></i>
                                <div class="text-left">
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{ route('resources.index') }}" 
                               class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-3 text-white font-semibold hover:from-primary-600 hover:to-primary-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-database"></i>
                                Browse Resources
                            </a>
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center gap-2 rounded-xl border border-primary-200 bg-white px-6 py-3 text-primary-700 font-semibold hover:bg-primary-50 transition-all duration-200">
                                <i class="fas fa-home"></i>
                                Go to Dashboard
                            </a>
                            <a href="{{ route('report.create') }}" 
                               class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-6 py-3 text-secondary-700 font-semibold hover:bg-secondary-50 transition-all duration-200">
                                <i class="fas fa-plus"></i>
                                Submit Another Report
                            </a>
                        </div>
                    </div>

                    <!-- Feedback Card -->
                    <div class="bg-white rounded-2xl shadow-soft p-6 card-hover">
                        <h3 class="text-xl font-bold text-secondary-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-comment-dots text-primary-600"></i>
                            Help Us Improve
                        </h3>
                        
                        <p class="text-secondary-600 mb-6">Your feedback helps us make the reporting process better for others.</p>

                        @if (session('status')) 
                            <div class="bg-success-50 border border-success-200 rounded-xl p-4 mb-6">
                                <p class="text-success-700 font-semibold flex items-center gap-2">
                                    <i class="fas fa-check-circle"></i>
                                    {{ session('status') }}
                                </p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('report.feedback') }}" class="space-y-6">
                            @csrf
                            <input type="hidden" name="report_id" value="{{ $report->id }}">

                            <!-- Rating -->
                            <div>
                                <label class="block text-sm font-semibold text-secondary-700 mb-3">
                                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                                    How was your experience with the reporting process?
                                </label>
                                <div class="flex gap-2 mb-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="rating" value="{{ $i }}" class="sr-only">
                                            <div class="w-12 h-12 rounded-xl bg-secondary-100 flex items-center justify-center text-secondary-400 group-hover:bg-yellow-100 group-hover:text-yellow-500 transition-all duration-200 font-semibold text-lg">
                                                {{ $i }}
                                            </div>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <!-- Comments -->
                            <div>
                                <label class="block text-sm font-semibold text-secondary-700 mb-2">
                                    <i class="fas fa-edit text-primary-600 mr-2"></i>
                                    Additional Comments (Optional)
                                </label>
                                <textarea name="message" 
                                          maxlength="500" 
                                          placeholder="Any suggestions to improve the reporting process? What worked well? What could be better?"
                                          class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white min-h-24 resize-vertical"></textarea>
                                <div class="text-sm text-secondary-500 mt-2">Maximum 500 characters</div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t border-secondary-100">
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-3 text-white font-semibold hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-paper-plane"></i>
                                    Send Feedback
                                </button>
                                <a href="{{ route('resources.index') }}" 
                                   class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-white px-6 py-3 text-red-700 font-semibold hover:bg-red-50 transition-all duration-200">
                                    <i class="fas fa-ambulance"></i>
                                    Emergency Resources
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Support Resources -->
                    <div class="mt-6 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl p-6 text-white text-center">
                        <h3 class="text-xl font-bold mb-3">Need Immediate Support?</h3>
                        <p class="mb-4 text-primary-100">Remember, you're not alone. Help is available whenever you need it.</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('resources.index') }}" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-primary-600 font-semibold hover:bg-gray-100 transition-all duration-200">
                                <i class="fas fa-hands-helping"></i>
                                Get Support Now
                            </a>
                            <a href="{{ route('forum.index') }}" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-6 py-3 text-white font-semibold hover:bg-white/30 transition-all duration-200">
                                <i class="fas fa-comments"></i>
                                Community Support
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Floating Emergency Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="{{ route('resources.index') }}" 
           class="inline-flex items-center gap-3 rounded-full bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 text-white font-bold hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-2xl animate-pulse">
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

        // Star rating interaction
        document.querySelectorAll('input[name="rating"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const stars = document.querySelectorAll('input[name="rating"]');
                stars.forEach((star, index) => {
                    const starDiv = star.parentElement.querySelector('div');
                    if (index < this.value) {
                        starDiv.classList.add('bg-yellow-100', 'text-yellow-500');
                        starDiv.classList.remove('bg-secondary-100', 'text-secondary-400');
                    } else {
                        starDiv.classList.remove('bg-yellow-100', 'text-yellow-500');
                        starDiv.classList.add('bg-secondary-100', 'text-secondary-400');
                    }
                });
            });
        });

        // Initialize star display
        document.querySelectorAll('input[name="rating"]').forEach(radio => {
            const starDiv = radio.parentElement.querySelector('div');
            starDiv.addEventListener('mouseenter', function() {
                const rating = this.parentElement.querySelector('input').value;
                const stars = document.querySelectorAll('input[name="rating"]');
                stars.forEach((star, index) => {
                    const hoverDiv = star.parentElement.querySelector('div');
                    if (index < rating) {
                        hoverDiv.classList.add('bg-yellow-100', 'text-yellow-500');
                    }
                });
            });

            starDiv.addEventListener('mouseleave', function() {
                const stars = document.querySelectorAll('input[name="rating"]');
                const selected = document.querySelector('input[name="rating"]:checked');
                stars.forEach((star, index) => {
                    const hoverDiv = star.parentElement.querySelector('div');
                    if (!selected || index >= selected.value) {
                        hoverDiv.classList.remove('bg-yellow-100', 'text-yellow-500');
                        hoverDiv.classList.add('bg-secondary-100', 'text-secondary-400');
                    }
                });
            });
        });
    </script>
</body>
</html>