<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $item->title }} — Education • Strengthlink</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
    </style>
</head>
<body class="antialiased">
    @php
        use Illuminate\Support\Facades\Storage;
        $isAdmin = auth('admin')->check();

        // Build safe URLs for cover and download if present
        $coverUrl = $item->cover_path && Storage::disk('public')->exists($item->cover_path)
            ? Storage::disk('public')->url($item->cover_path)
            : null;

        $downloadUrl = $item->download_path && Storage::disk('public')->exists($item->download_path)
            ? Storage::disk('public')->url($item->download_path)
            : null;
    @endphp

    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-200 rounded-full mix-blend-multiply filter blur-xl opacity-20"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary-300 rounded-full mix-blend-multiply filter blur-xl opacity-20"></div>
    </div>

    <div class="max-w-4xl mx-auto p-6 relative z-10">
        <!-- Back Navigation -->
        <a href="{{ route('education.index') }}" 
           class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium transition-colors mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Education Resources
        </a>

        <!-- Main Content Card -->
        <div class="glass-effect rounded-2xl shadow-card p-8 animate-fade-in">
            <!-- Header Section -->
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-secondary-800">{{ $item->title }}</h1>
                            <div class="flex items-center gap-3 mt-2">
                                @if($item->category)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium 
                                    @if($item->category === 'awareness') bg-blue-100 text-blue-700
                                    @elseif($item->category === 'rights') bg-green-100 text-green-700
                                    @else bg-purple-100 text-purple-700 @endif">
                                    <i class="fa-solid 
                                        @if($item->category === 'awareness') fa-lightbulb
                                        @elseif($item->category === 'rights') fa-scale-balanced
                                        @else fa-handshake-angle @endif text-xs"></i>
                                    {{ ucfirst($item->category) }}
                                </span>
                                @endif
                                @if($item->published_at)
                                <span class="text-sm text-secondary-500">
                                    <i class="fa-solid fa-clock mr-1"></i>
                                    Published {{ $item->published_at->diffForHumans() }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cover Image -->
            @if($coverUrl)
            <div class="rounded-2xl overflow-hidden shadow-soft mb-8">
                <img src="{{ $coverUrl }}" alt="Cover for {{ $item->title }}" class="w-full h-80 object-cover">
            </div>
            @endif

            <!-- Video Embed -->
            @if($item->video_url)
            <div class="rounded-2xl overflow-hidden shadow-soft mb-8">
                <div class="aspect-video bg-black">
                    <iframe
                        src="{{ $item->video_url }}"
                        class="w-full h-full"
                        frameborder="0"
                        allowfullscreen
                        referrerpolicy="strict-origin-when-cross-origin"
                        title="Educational video: {{ $item->title }}"></iframe>
                </div>
            </div>
            @endif

            <!-- Body Content -->
            @if($item->body)
            <div class="prose prose-lg max-w-none mb-8">
                <div class="bg-white rounded-xl p-6 border border-secondary-200">
                    {!! nl2br(e($item->body)) !!}
                </div>
            </div>
            @endif

            <!-- Download Section -->
            @if($downloadUrl)
            <div class="bg-gradient-to-r from-primary-50 to-secondary-50 rounded-2xl p-6 border border-primary-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-xl bg-primary-100 text-primary-600 grid place-items-center">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-secondary-800">Download Resource</h3>
                            <p class="text-secondary-600 text-sm">Access the complete educational material</p>
                        </div>
                    </div>
                    <a href="{{ route('education.download', $item) }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                        <i class="fa-solid fa-download"></i>
                        Download PDF
                    </a>
                </div>
                <p class="text-xs text-secondary-500 mt-3 flex items-center gap-1">
                    <i class="fa-solid fa-info-circle"></i>
                    If your download doesn't start automatically, right-click the button and select "Save link as..."
                </p>
            </div>
            @endif
        </div>

        <!-- Admin Actions -->
   

        <!-- Quick Navigation -->
        <div class="glass-effect rounded-2xl shadow-card p-6 mt-6 text-center">
            <p class="text-secondary-600 mb-4">Explore more educational resources</p>
            <a href="{{ route('education.index') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 border border-primary-500 text-primary-600 hover:bg-primary-50 font-semibold rounded-xl transition-all duration-200">
                <i class="fa-solid fa-graduation-cap"></i>
                Browse All Resources
            </a>
        </div>
    </div>

    <!-- Floating Help Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="/resources?q=education" 
           class="inline-flex items-center gap-3 rounded-full bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-4 text-white font-bold hover:shadow-glow transform hover:scale-105 transition-all duration-200 shadow-2xl">
            <i class="fa-solid fa-circle-question text-xl"></i>
            Get Help
        </a>
    </div>

    <script>
        // Add smooth animations on scroll
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

            // Observe main content for animation
            const mainContent = document.querySelector('.animate-fade-in');
            if (mainContent) {
                mainContent.style.opacity = '0';
                mainContent.style.transform = 'translateY(20px)';
                mainContent.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(mainContent);
            }
        });
    </script>
</body>
</html>