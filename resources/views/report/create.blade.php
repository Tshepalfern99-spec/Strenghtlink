<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report an Incident • Strengthlink</title>
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
                        'glow': '0 0 20px rgba(236, 72, 153, 0.15)'
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
        .tooltip {
            border-bottom: 1px dashed #cbd5e1;
            cursor: help;
            position: relative;
        }
        .tooltip:hover::after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #1f2937;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
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
                            <h1 class="text-2xl font-black gradient-text">Report an Incident</h1>
                            <p class="text-secondary-600 text-sm">Your safety matters. Report securely and anonymously.</p>
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
                    <!-- Safety Notice -->
                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-6 text-white shadow-lg mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-shield-alt text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-lg mb-1">Your Privacy & Safety First</h4>
                                <p class="text-red-100">All reports are handled with strict confidentiality. You can choose to remain completely anonymous.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Report Form Card -->
                    <div class="bg-white rounded-2xl shadow-soft p-6 card-hover mb-6">
                        <form method="POST" action="{{ route('report.store') }}" id="reportForm">
                            @csrf

                            <!-- Anonymity Toggle -->
                            <div class="flex items-center gap-4 mb-6 p-4 bg-primary-50 rounded-xl">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" class="sr-only">
                                        <div class="w-6 h-6 border-2 border-primary-300 rounded-md flex items-center justify-center transition-all duration-200">
                                            <svg class="w-3 h-3 text-primary-600 opacity-0 transition-opacity duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="font-semibold text-primary-700">Submit anonymously</span>
                                </label>
                                <span class="tooltip text-sm text-secondary-500" title="Your identity will not be linked to this report. We store no personal identifiers.">
                                    <i class="fas fa-info-circle"></i>
                                    What does anonymous mean?
                                </span>
                            </div>

                            <!-- Form Grid -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                                <!-- Category Selection -->
                                <div>
                                    <label class="block text-sm font-semibold text-secondary-700 mb-2">
                                        <i class="fas fa-tag text-primary-600 mr-2"></i>
                                        Incident Category
                                    </label>
                                    <select name="category" id="category" required
                                            class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $value => [$label,$emoji,$color])
                                            <option value="{{ $value }}">{{ $emoji }} {{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-sm text-secondary-500 mt-2">Choose the closest match. You can pick "Other" if unsure.</div>
                                </div>

                                <!-- Contact Email -->
                                <div id="contactEmailBlock">
                                    <label class="block text-sm font-semibold text-secondary-700 mb-2">
                                        <i class="fas fa-envelope text-primary-600 mr-2"></i>
                                        Contact Email (Optional)
                                    </label>
                                    <input type="email" 
                                           name="contact_email" 
                                           id="contact_email" 
                                           placeholder="you@example.com" 
                                           @if(isset($user) && $user) value="{{ $user->email }}" @endif
                                           class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">
                                    <div class="text-sm text-secondary-500 mt-2">We'll send a confirmation + resource link. Not shown publicly.</div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-secondary-700 mb-2">
                                    <i class="fas fa-align-left text-primary-600 mr-2"></i>
                                    Describe what happened
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          minlength="20" 
                                          maxlength="2000" 
                                          required 
                                          placeholder="Please include as much detail as you feel comfortable sharing..."
                                          class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white min-h-32 resize-vertical"></textarea>
                                <div class="flex justify-between items-center mt-2">
                                    <div class="text-sm text-secondary-500">Min 20, max 2000 characters. Avoid personal info that could identify you if anonymous.</div>
                                    <div class="text-sm font-medium text-secondary-700"><span id="descCount">0</span>/2000</div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-secondary-700 mb-2">
                                    <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>
                                    Approximate Location (Optional)
                                </label>
                                <input type="text" 
                                       name="location_text" 
                                       id="location_text" 
                                       placeholder="e.g., Durban CBD, near ABC Street"
                                       class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">

                                <!-- Map Toggle -->
                                <div class="flex items-center gap-3 mt-3 p-3 bg-secondary-50 rounded-xl">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="use_map" value="1" class="sr-only">
                                            <div class="w-5 h-5 border-2 border-secondary-300 rounded-md flex items-center justify-center transition-all duration-200">
                                                <svg class="w-3 h-3 text-primary-600 opacity-0 transition-opacity duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <span class="font-medium text-secondary-700">Use map picker (non-anonymous only)</span>
                                    </label>
                                    <span class="tooltip text-sm text-secondary-500" title="Toggle to drop a pin (approximate). Coordinates will be saved as text.">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                </div>

                                <!-- Map Container -->
                                <div id="mapWrap" class="mt-3 hidden">
                                    <div id="map" class="w-full h-64 rounded-xl border border-secondary-200"></div>
                                    <div class="text-sm text-secondary-500 mt-2">Move the map or drag the marker to update the location.</div>
                                </div>
                            </div>

                            <!-- Error Display -->
                            @if ($errors->any())
                                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                                    <ul class="text-red-700 text-sm">
                                        @foreach ($errors->all() as $err)
                                            <li class="flex items-center gap-2">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $err }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-secondary-100">
                                <div class="flex gap-3">
                                    <button type="button" 
                                            onclick="goBack()"
                                            class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-6 py-3 text-secondary-700 font-semibold hover:bg-secondary-50 transition-all duration-200">
                                        <i class="fas fa-arrow-left"></i>
                                        Back
                                    </button>
                                    <a href="{{ route('dashboard') }}" 
                                       class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-6 py-3 text-secondary-700 font-semibold hover:bg-secondary-50 transition-all duration-200">
                                        <i class="fas fa-home"></i>
                                        Dashboard
                                    </a>
                                </div>
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-3 text-white font-semibold hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-paper-plane"></i>
                                    Submit Report
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Category Legend -->
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <h3 class="text-lg font-semibold text-secondary-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-list-ul text-primary-600"></i>
                            Incident Categories
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @foreach($categories as $value => [$label,$emoji,$color])
                                <div class="flex items-center gap-3 p-3 bg-secondary-50 rounded-xl">
                                    <span class="text-lg">{{ $emoji }}</span>
                                    <span class="text-sm font-medium text-secondary-700">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Floating Emergency Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="{{ route('resources.index') }}" 
           class="inline-flex items-center gap-3 rounded-full bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 text-white font-bold hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-2xl">
            <i class="fas fa-ambulance text-xl"></i>
            Emergency Resources
        </a>
    </div>

    <script>
        function goBack(){ 
            if (history.length > 1) history.back(); 
            else window.location.href = '{{ route('dashboard') }}'; 
        }

        // Character counter + auto-save
        const desc = document.getElementById('description');
        const counter = document.getElementById('descCount');
        const emailBlock = document.getElementById('contactEmailBlock');
        const isAnon = document.getElementById('is_anonymous');
        const useMap = document.getElementById('use_map');
        const mapWrap = document.getElementById('mapWrap');
        const locInput = document.getElementById('location_text');
        const category = document.getElementById('category');
        const contactEmail = document.getElementById('contact_email');
        const form = document.getElementById('reportForm');

        const CURRENT_USER_ID = {{ auth()->id() ?? 'null' }};
        const DRAFT_KEY = 'reportDraft_' + (CURRENT_USER_ID ?? 'guest');

        function loadDraft(){
            try{
                const raw = localStorage.getItem(DRAFT_KEY);
                if(!raw) return;
                const d = JSON.parse(raw);
                if(d.category) category.value = d.category;
                if(d.description) desc.value = d.description;
                if(d.location_text) locInput.value = d.location_text;
                if(d.is_anonymous) { 
                    isAnon.checked = true; 
                    isAnon.parentElement.querySelector('svg').classList.remove('opacity-0');
                    toggleAnon(); 
                }
                if(d.contact_email) contactEmail.value = d.contact_email;
                updateCount();
            }catch(e){}
        }

        function saveDraft(){
            const d = {
                category: category.value,
                description: desc.value,
                location_text: locInput.value,
                is_anonymous: isAnon.checked,
                contact_email: contactEmail ? contactEmail.value : ''
            };
            localStorage.setItem(DRAFT_KEY, JSON.stringify(d));
        }

        function clearDraft(){ localStorage.removeItem(DRAFT_KEY); }

        function updateCount(){ counter.textContent = desc.value.length; }

        function toggleAnon(){
            const anon = isAnon.checked;
            // Hide contact email + map when anonymous
            emailBlock.style.display = anon ? 'none' : 'block';
            if (anon) {
                useMap.checked = false;
                useMap.parentElement.querySelector('svg').classList.add('opacity-0');
                toggleMap(false);
            }
        }

        // Map functionality
        let map, marker, mapsLoaded = false;
        
        function toggleMap(force){
            const on = typeof force === 'boolean' ? force : useMap.checked;
            if(on){
                mapWrap.classList.remove('hidden');
                if(!mapsLoaded){
                    // Initialize map here if needed
                    setTimeout(() => {
                        mapWrap.innerHTML = '<div class="flex items-center justify-center h-64 bg-secondary-50 rounded-xl"><div class="text-center"><i class="fas fa-map text-3xl text-secondary-400 mb-2"></i><p class="text-secondary-500">Map would load here with API key</p></div></div>';
                    }, 500);
                }
            }else{
                mapWrap.classList.add('hidden');
            }
        }

        // Event listeners for checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checkIcon = this.parentElement.querySelector('svg');
                if (this.checked) {
                    checkIcon.classList.remove('opacity-0');
                } else {
                    checkIcon.classList.add('opacity-0');
                }
            });
        });

        // Hooks
        desc.addEventListener('input', ()=>{ updateCount(); saveDraft(); });
        category.addEventListener('change', saveDraft);
        locInput.addEventListener('input', saveDraft);
        if(contactEmail) contactEmail.addEventListener('input', saveDraft);
        isAnon.addEventListener('change', ()=>{ toggleAnon(); saveDraft(); });
        useMap.addEventListener('change', ()=> toggleMap());

        form.addEventListener('submit', ()=>{ clearDraft(); });

        // Initialize
        updateCount();
        loadDraft();
        toggleAnon();

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
    </script>
</body>
</html>