<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $news->title }} - Strenghtlink</title>
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
        .prose {
            max-width: none;
            line-height: 1.75;
            color: #374151;
        }
        .prose p {
            margin-bottom: 1.25em;
        }
        .prose strong {
            color: #111827;
            font-weight: 600;
        }
        .prose a {
            color: #db2777;
            text-decoration: underline;
            font-weight: 500;
        }
        .prose a:hover {
            color: #be185d;
        }
        .prose ul, .prose ol {
            margin-bottom: 1.25em;
            padding-left: 1.625em;
        }
        .prose li {
            margin-bottom: 0.5em;
        }
        .prose h2 {
            font-size: 1.5em;
            font-weight: 700;
            color: #111827;
            margin-top: 2em;
            margin-bottom: 1em;
        }
        .prose h3 {
            font-size: 1.25em;
            font-weight: 600;
            color: #111827;
            margin-top: 1.6em;
            margin-bottom: 0.6em;
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
                            <h1 class="text-xl font-black gradient-text">News Article</h1>
                            <p class="text-secondary-600 text-sm">Community updates and information</p>
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
                    <!-- Back Navigation -->
                    <div class="mb-6">
                        <a href="javascript:history.back()" 
                           class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2 text-secondary-700 font-semibold hover:bg-secondary-50 transition-all duration-200">
                            <i class="fas fa-arrow-left"></i>
                            Back to News
                        </a>
                    </div>

                    <!-- Article Card -->
                    <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
                        <!-- Cover Image -->
                        @if(isset($news->cover_image_path) && $news->cover_image_path)
                            <img src="{{ asset('storage/'.$news->cover_image_path) }}" 
                                 alt="{{ $news->title }}" 
                                 class="w-full h-64 md:h-80 object-cover">
                        @else
                            <div class="w-full h-64 md:h-80 bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-5xl"></i>
                            </div>
                        @endif

                        <!-- Article Content -->
                        <div class="p-8">
                            <!-- Article Header -->
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        News Article
                                    </span>
                                    <span class="text-secondary-500 text-sm">
                                        {{ $news->published_at ? $news->published_at->format('M d, Y \\a\\t H:i') : 'Draft' }}
                                    </span>
                                </div>
                                
                                <h1 class="text-3xl md:text-4xl font-black text-secondary-900 leading-tight">
                                    {{ $news->title }}
                                </h1>

                                @if(isset($news->excerpt) && $news->excerpt)
                                    <p class="mt-4 text-lg text-secondary-600 leading-relaxed">
                                        {{ $news->excerpt }}
                                    </p>
                                @endif
                            </div>

                            <!-- Article Body -->
                            <div class="prose prose-lg max-w-none border-t border-secondary-100 pt-6">
                                {!! nl2br(e($news->body)) !!}
                            </div>

                            <!-- Article Footer -->
                            <div class="mt-8 pt-6 border-t border-secondary-100">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div class="text-sm text-secondary-500">
                                        Published {{ $news->published_at ? $news->published_at->diffForHumans() : 'as draft' }}
                                    </div>
                                    <div class="flex gap-3">
                                        <a href="/news" 
                                           class="inline-flex items-center gap-2 rounded-xl border border-primary-200 bg-white px-4 py-2 text-primary-700 font-semibold hover:bg-primary-50 transition-all duration-200">
                                            <i class="fas fa-newspaper"></i>
                                            All News
                                        </a>
                                        <a href="/dashboard" 
                                           class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-4 py-2 text-white font-semibold hover:bg-primary-600 transition-all duration-200">
                                            <i class="fas fa-home"></i>
                                            Dashboard
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Support Resources -->
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
                            <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                                <i class="fas fa-hands-helping"></i>
                                Need Support?
                            </h3>
                            <p class="text-blue-100 mb-4">Find help and resources in your area</p>
                            <a href="/resources" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-blue-600 font-bold hover:bg-gray-100 transition-all duration-200">
                                <i class="fas fa-search"></i>
                                Find Resources
                            </a>
                        </div>

                        <!-- Community Forum -->
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white">
                            <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                                <i class="fas fa-comments"></i>
                                Join Discussion
                            </h3>
                            <p class="text-green-100 mb-4">Connect with others in our community</p>
                            <a href="/forum" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-green-600 font-bold hover:bg-gray-100 transition-all duration-200">
                                <i class="fas fa-users"></i>
                                Visit Forum
                            </a>
                        </div>
                    </div>

                    <!-- Emergency Section -->
                    <div class="mt-6 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-6 text-white text-center">
                        <h3 class="text-xl font-bold mb-3">Need Immediate Help?</h3>
                        <p class="text-red-100 mb-4">If you're in immediate danger, contact emergency services right away</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="tel:112" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-red-600 font-bold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-phone"></i>
                                Emergency: 112
                            </a>
                            <a href="/report/create" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-6 py-3 text-white font-bold hover:bg-white/30 transition-all duration-200">
                                <i class="fas fa-flag"></i>
                                Report Urgent Incident
                            </a>
                        </div>
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

        // Add reading time estimation
        document.addEventListener('DOMContentLoaded', function() {
            const articleBody = document.querySelector('.prose');
            if (articleBody) {
                const text = articleBody.textContent || articleBody.innerText;
                const wordCount = text.trim().split(/\s+/).length;
                const readingTime = Math.ceil(wordCount / 200); // 200 words per minute
                
                // You could display reading time in the article header
                // const readingTimeElement = document.createElement('span');
                // readingTimeElement.className = 'text-secondary-500 text-sm';
                // readingTimeElement.textContent = ` · ${readingTime} min read`;
                // document.querySelector('.article-header').appendChild(readingTimeElement);
            }
        });
    </script>
</body>
</html>