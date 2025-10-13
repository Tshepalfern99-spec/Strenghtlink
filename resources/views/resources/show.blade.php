<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $resource->name }} • Resource - Strenghtlink</title>
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
            transform: translateY(-2px); 
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 0 15px rgba(236, 72, 153, 0.1);
            border-color: #fbcfe8;
        }
        .resource-badge {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
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
                            <h1 class="text-xl font-black gradient-text">Resource Details</h1>
                            <p class="text-secondary-600 text-sm">Contact information and service details</p>
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
                    <!-- Resource Header Card -->
                    <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl p-8 text-white shadow-card mb-6">
                        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                            <div class="flex-1">
                                <div class="resource-badge bg-white/20 backdrop-blur-sm mb-4">
                                    {{ optional($resource->category)->name ?? 'General Support' }}
                                </div>
                                <h2 class="text-3xl font-black mb-2">{{ $resource->name }}</h2>
                                <div class="flex items-center gap-2 text-primary-100">
                                    <i class="fas fa-location-dot"></i>
                                    <span>{{ trim(($resource->city ?? '').', '.($resource->province ?? ''), ', ') }}</span>
                                </div>
                            </div>
                            
                            <!-- Quick Actions -->
                            <div class="flex flex-wrap gap-3">
                                @php
                                    $tel = $resource->phone ? 'tel:'.preg_replace('/[^+0-9]/','', $resource->phone) : null;
                                    $sms = $resource->phone ? 'sms:'.preg_replace('/[^+0-9]/','', $resource->phone) : null;
                                @endphp
                                
                                @if($tel)
                                    <a href="{{ $tel }}" 
                                       class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-primary-600 font-bold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 shadow-lg"
                                       aria-label="Call {{ $resource->name }}">
                                        <i class="fas fa-phone"></i>
                                        Call Now
                                    </a>
                                @endif
                                
                                @if($sms)
                                    <a href="{{ $sms }}" 
                                       class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-6 py-3 text-white font-semibold hover:bg-white/30 transition-all duration-200"
                                       aria-label="Text {{ $resource->name }}">
                                        <i class="fas fa-comment"></i>
                                        Send Text
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Contact Methods -->
                        <div class="bg-white rounded-2xl shadow-soft p-6 card-hover">
                            <h3 class="text-xl font-bold text-secondary-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-address-book text-primary-600"></i>
                                Contact Information
                            </h3>
                            
                            <div class="space-y-4">
                                @if($resource->phone)
                                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-phone text-green-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-secondary-900">Phone Number</p>
                                                <p class="text-green-600">{{ $resource->phone }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ $tel }}" 
                                           class="inline-flex items-center gap-2 rounded-lg bg-green-500 px-4 py-2 text-white font-semibold hover:bg-green-600 transition-all duration-200">
                                            <i class="fas fa-phone"></i>
                                            Call
                                        </a>
                                    </div>
                                @endif

                                @if($resource->email)
                                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-envelope text-blue-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-secondary-900">Email Address</p>
                                                <p class="text-blue-600">{{ $resource->email }}</p>
                                            </div>
                                        </div>
                                        <a href="mailto:{{ $resource->email }}" 
                                           class="inline-flex items-center gap-2 rounded-lg bg-blue-500 px-4 py-2 text-white font-semibold hover:bg-blue-600 transition-all duration-200">
                                            <i class="fas fa-envelope"></i>
                                            Email
                                        </a>
                                    </div>
                                @endif

                                @if($resource->website)
                                    <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-globe text-purple-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-secondary-900">Website</p>
                                                <p class="text-purple-600 text-sm truncate">{{ $resource->website }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ $resource->website }}" 
                                           target="_blank" 
                                           rel="noopener"
                                           class="inline-flex items-center gap-2 rounded-lg bg-purple-500 px-4 py-2 text-white font-semibold hover:bg-purple-600 transition-all duration-200">
                                            <i class="fas fa-external-link-alt"></i>
                                            Visit
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Location Details -->
                        <div class="bg-white rounded-2xl shadow-soft p-6 card-hover">
                            <h3 class="text-xl font-bold text-secondary-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-primary-600"></i>
                                Location Information
                            </h3>
                            
                            <div class="space-y-4">
                                @if($resource->address)
                                    <div class="flex items-start gap-3 p-4 bg-secondary-50 rounded-xl">
                                        <i class="fas fa-map-pin text-secondary-600 mt-1"></i>
                                        <div>
                                            <p class="font-semibold text-secondary-900">Full Address</p>
                                            <p class="text-secondary-600">{{ $resource->address }}</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="p-4 bg-secondary-50 rounded-xl">
                                        <p class="font-semibold text-secondary-900 text-sm">City</p>
                                        <p class="text-secondary-600">{{ $resource->city ?: 'Not specified' }}</p>
                                    </div>
                                    
                                    <div class="p-4 bg-secondary-50 rounded-xl">
                                        <p class="font-semibold text-secondary-900 text-sm">Province</p>
                                        <p class="text-secondary-600">{{ $resource->province ?: 'Not specified' }}</p>
                                    </div>
                                    
                                    <div class="p-4 bg-secondary-50 rounded-xl">
                                        <p class="font-semibold text-secondary-900 text-sm">Postal Code</p>
                                        <p class="text-secondary-600">{{ $resource->postal_code ?: 'Not specified' }}</p>
                                    </div>
                                    
                                    <div class="p-4 bg-secondary-50 rounded-xl">
                                        <p class="font-semibold text-secondary-900 text-sm">Category</p>
                                        <p class="text-secondary-600">{{ optional($resource->category)->name ?? 'General' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                            <div class="flex flex-wrap gap-3">
                                <button onclick="goBack()" 
                                        class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-6 py-3 text-secondary-700 font-semibold hover:bg-secondary-50 transition-all duration-200">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Results
                                </button>
                                <a href="{{ route('resources.index') }}" 
                                   class="inline-flex items-center gap-2 rounded-xl border border-primary-200 bg-white px-6 py-3 text-primary-700 font-semibold hover:bg-primary-50 transition-all duration-200">
                                    <i class="fas fa-database"></i>
                                    All Resources
                                </a>
                            </div>
                            
                            <!-- Additional Actions -->
                            <div class="flex gap-3">
                                @if($sms)
                                    <a href="{{ $sms }}" 
                                       class="inline-flex items-center gap-2 rounded-xl bg-blue-500 px-6 py-3 text-white font-semibold hover:bg-blue-600 transition-all duration-200">
                                        <i class="fas fa-comment"></i>
                                        Send Text
                                    </a>
                                @endif
                                <a href="{{ route('dashboard') }}" 
                                   class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-6 py-3 text-white font-semibold hover:bg-primary-600 transition-all duration-200">
                                    <i class="fas fa-home"></i>
                                    Dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Section -->
                    <div class="mt-6 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-6 text-white text-center">
                        <h3 class="text-xl font-bold mb-3">Need Immediate Assistance?</h3>
                        <p class="text-red-100 mb-4">If this resource cannot help or you're in immediate danger, contact emergency services</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="tel:112" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-red-600 font-bold hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-phone"></i>
                                Emergency: 112
                            </a>
                            <a href="{{ route('resources.index') }}?q=emergency" 
                               class="inline-flex items-center gap-2 rounded-xl bg-white/20 backdrop-blur-sm px-6 py-3 text-white font-bold hover:bg-white/30 transition-all duration-200">
                                <i class="fas fa-ambulance"></i>
                                Find Emergency Resources
                            </a>
                        </div>
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
        function goBack(){ 
            if (history.length > 1) history.back(); 
            else window.location.href = '{{ route('resources.index') }}'; 
        }

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

        // Add copy to clipboard functionality for contact info
        document.addEventListener('DOMContentLoaded', function() {
            // You could add copy functionality here for phone numbers/emails
            // Example: document.querySelector('.phone-number').addEventListener('click', copyToClipboard);
        });
    </script>
</body>
</html>