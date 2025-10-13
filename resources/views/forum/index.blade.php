<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Forum - Connect & Share</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .nav-item.active {
            position: relative;
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
            border-radius: 0 4px 4px 0;
        }
        .post-card {
            transition: all 0.3s ease;
        }
        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="antialiased">
    <div class="flex min-h-screen">
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
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="glass-effect border-b border-gray-100 py-4 px-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-secondary-800">Community Forum</h1>
                        <p class="text-sm text-secondary-500 mt-1">Share, discuss and connect with the community</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-full bg-white shadow-soft text-secondary-500 hover:text-primary-600 transition-colors">
                            <i class="fas fa-bell"></i>
                        </button>
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold text-sm">
                            U
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Header Actions -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                        <div class="mb-4 md:mb-0">
                            <h2 class="text-2xl font-bold gradient-text">Community Discussions</h2>
                            <p class="text-secondary-600 mt-1">Join the conversation and share your thoughts</p>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <a href="{{ route('dashboard') }}"
                               class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to Dashboard
                            </a>
                            <a href="{{ route('forum.create') }}"
                               class="inline-flex items-center rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-4 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                New Post
                            </a>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-8">
                        <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            <div class="relative flex-1 max-w-md">
                                <i class="fas fa-search absolute left-3 top-3 text-secondary-400"></i>
                                <input type="search" name="q" value="{{ $q ?? '' }}"
                                       class="w-full rounded-xl border-gray-200 px-4 py-2.5 pl-10 bg-white shadow-soft focus:ring-2 focus:ring-primary-200 focus:border-primary-400 transition-all duration-200"
                                       placeholder="Search posts, topics, or users...">
                            </div>
                            <button class="rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-4 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all duration-200">
                                Search
                            </button>
                            @if(($q ?? '') !== '')
                                <a href="{{ route('forum.index') }}"
                                   class="text-sm text-secondary-600 hover:text-primary-600 transition-colors flex items-center">
                                    <i class="fas fa-times mr-1"></i>
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Forum Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-white rounded-xl shadow-soft p-4 flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-primary-50 flex items-center justify-center mr-4">
                                <i class="fas fa-comments text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-secondary-500">Total Posts</p>
                                <p class="text-xl font-bold text-secondary-800">{{ $posts->total() }}</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-soft p-4 flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center mr-4">
                                <i class="fas fa-users text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-secondary-500">Active Members</p>
                                <p class="text-xl font-bold text-secondary-800">{{ rand(50, 200) }}</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-soft p-4 flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center mr-4">
                                <i class="fas fa-fire text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-secondary-500">Hot Topics</p>
                                <p class="text-xl font-bold text-secondary-800">{{ rand(5, 20) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Posts Grid -->
                    @if($posts->count() > 0)
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 animate-fade-in">
                            @foreach($posts as $post)
                                <article class="post-card bg-white rounded-2xl shadow-card overflow-hidden h-full flex flex-col">
                                    {{-- Image --}}
@if($post->media_image_path)
<img src="{{ asset('storage/'.$post->media_image_path) }}"
     alt="{{ $post->title }} image"
     class="max-h-[420px] w-full rounded-lg object-cover">
@endif

{{-- Video iframe --}}
@if($post->media_video_url)
<div class="mb-4 aspect-video">
  <iframe src="{{ $post->media_video_url }}" class="h-full w-full rounded-lg" frameborder="0" allowfullscreen></iframe>
</div>


                                    @else
                                        <div class="h-48 bg-gradient-to-r from-primary-100 to-primary-50 flex items-center justify-center">
                                            <i class="fas fa-comments text-primary-300 text-5xl"></i>
                                        </div>
                                    @endif
                                    <div class="p-5 flex-1 flex flex-col">
                                        <div class="flex items-center text-xs text-secondary-500 mb-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            <span>{{ $post->created_at->diffForHumans() }}</span>
                                            @if($post->user)
                                                <span class="mx-2">•</span>
                                                <i class="fas fa-user mr-1"></i>
                                                <span>{{ $post->user->name }}</span>
                                            @endif
                                        </div>
                                        <h3 class="font-bold text-lg text-secondary-800 line-clamp-2 mb-2">{{ $post->title }}</h3>
                                        <p class="text-secondary-600 text-sm line-clamp-3 mb-4 flex-1">{{ \Illuminate\Support\Str::limit(strip_tags($post->body), 160) }}</p>
                                        <div class="mt-auto">
                                            <a href="{{ route('forum.show', $post) }}"
                                               class="inline-flex items-center text-primary-600 font-medium text-sm hover:text-primary-700 transition-colors group">
                                                Read more
                                                <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-white rounded-2xl shadow-card p-8 text-center animate-fade-in">
                            <div class="w-20 h-20 rounded-full bg-primary-50 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-comments text-primary-500 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-secondary-800 mb-2">No posts yet</h3>
                            <p class="text-secondary-600 mb-6 max-w-md mx-auto">
                                @if(($q ?? '') !== '')
                                    No posts match your search criteria. Try different keywords or clear your search.
                                @else
                                    Be the first to start a discussion in our community forum.
                                @endif
                            </p>
                            @if(($q ?? '') === '')
                                <a href="{{ route('forum.create') }}"
                                   class="inline-flex items-center rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-5 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all duration-200">
                                    <i class="fas fa-plus mr-2"></i>
                                    Create First Post
                                </a>
                            @endif
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if($posts->hasPages())
                        <div class="mt-8 flex justify-center">
                            <div class="bg-white rounded-xl shadow-soft px-4 py-3 flex items-center space-x-1">
                                {{ $posts->onEachSide(1)->links('vendor.pagination.tailwind') }}
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        // Add some interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to post cards on scroll
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
            
            // Animate post cards
            document.querySelectorAll('.post-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.transitionDelay = `${index * 0.1}s`;
                
                observer.observe(card);
            });
        });
    </script>
</body>
</html>