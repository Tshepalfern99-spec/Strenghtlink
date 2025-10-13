<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Forum Post - Strenghtlink</title>
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
        .file-input {
            background: linear-gradient(135deg, #fdf2f8 0%, #f8fafc 100%);
            border: 2px dashed #fbcfe8;
            transition: all 0.3s ease;
        }
        .file-input:hover {
            border-color: #ec4899;
            background: linear-gradient(135deg, #fce7f3 0%, #f8fafc 100%);
        }
        .file-input.dragover {
            border-color: #ec4899;
            background: linear-gradient(135deg, #fce7f3 0%, #f8fafc 100%);
            box-shadow: 0 0 20px rgba(236, 72, 153, 0.2);
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
                            <h1 class="text-2xl font-black gradient-text">Create Forum Post</h1>
                            <p class="text-secondary-600 text-sm">Share your thoughts with the community</p>
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
                        <a href="/forum" 
                           class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2 text-secondary-700 font-semibold hover:bg-secondary-50 transition-all duration-200">
                            <i class="fas fa-arrow-left"></i>
                            Back to Forum
                        </a>
                    </div>

                    <!-- Success Message -->
                    @if (session('status'))
                        <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-green-600 text-lg"></i>
                                <p class="text-green-700 font-medium">{{ session('status') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Create Post Form -->
                    <div class="bg-white rounded-2xl shadow-soft p-8">
                        <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf

                            <!-- Form Help Text -->
                            <div class="bg-primary-50 rounded-xl p-4 border border-primary-200">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-info-circle text-primary-600 mt-0.5"></i>
                                    <div>
                                        <p class="text-primary-700 font-medium">Create a new community forum post</p>
                                        <p class="text-primary-600 text-sm mt-1">Title and content are required. You may optionally include an image or a video link.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Title Field -->
                            <div>
                                <label for="title" class="block text-sm font-semibold text-secondary-700 mb-2">
                                    <i class="fas fa-heading text-primary-600 mr-2"></i>
                                    Post Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="title"
                                       name="title"
                                       value="{{ old('title') }}"
                                       required
                                       maxlength="150"
                                       class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white"
                                       placeholder="Give your post a clear, descriptive title">
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2" role="alert">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Content Field -->
                            <div>
                                <label for="body" class="block text-sm font-semibold text-secondary-700 mb-2">
                                    <i class="fas fa-align-left text-primary-600 mr-2"></i>
                                    Post Content <span class="text-red-500">*</span>
                                </label>
                                <textarea id="body"
                                          name="body"
                                          rows="8"
                                          required
                                          class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white resize-vertical"
                                          placeholder="Share your thoughts, questions, or experiences with the community...">{{ old('body') }}</textarea>
                                @error('body')
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2" role="alert">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label for="media" class="block text-sm font-semibold text-secondary-700 mb-2">
                                    <i class="fas fa-image text-primary-600 mr-2"></i>
                                    Add Image (Optional)
                                </label>
                                <div class="file-input rounded-xl p-6 text-center cursor-pointer transition-all duration-300"
                                     id="fileDropZone">
                                    <input type="file"
                                           id="media"
                                           name="media"
                                           accept="image/*"
                                           class="hidden"
                                           aria-describedby="fileHelp">
                                    <div class="space-y-2">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-primary-400 mb-2"></i>
                                        <p class="text-secondary-600 font-medium">Click to upload or drag and drop</p>
                                        <p class="text-secondary-500 text-sm">PNG, JPG, WebP up to 2MB</p>
                                        <button type="button" 
                                                onclick="document.getElementById('media').click()"
                                                class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-4 py-2 text-white font-semibold hover:bg-primary-600 transition-all duration-200 mt-2">
                                            <i class="fas fa-upload"></i>
                                            Choose File
                                        </button>
                                    </div>
                                </div>
                                <p id="fileHelp" class="mt-2 text-xs text-secondary-500">Recommended max size ~2MB, common formats (JPG/PNG/WebP).</p>
                                @error('media')
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2" role="alert">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Video URL -->
                            <div>
                                <label for="video_url" class="block text-sm font-semibold text-secondary-700 mb-2">
                                    <i class="fas fa-video text-primary-600 mr-2"></i>
                                    Video URL (Optional)
                                </label>
                                <input type="url"
                                       id="video_url"
                                       name="video_url"
                                       value="{{ old('video_url') }}"
                                       class="w-full rounded-xl border border-secondary-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white"
                                       placeholder="https://www.youtube.com/embed/VIDEO_ID"
                                       aria-describedby="videoHelp">
                                <p id="videoHelp" class="mt-2 text-xs text-secondary-500">Use an embeddable URL (e.g., YouTube <code class="bg-secondary-100 px-1 rounded">/embed/</code> link).</p>
                                @error('video_url')
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2" role="alert">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-secondary-100">
                                <a href="/forum"
                                   class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-6 py-3 text-secondary-700 font-semibold hover:bg-secondary-50 transition-all duration-200 w-full sm:w-auto justify-center">
                                    <i class="fas fa-times"></i>
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-3 text-white font-semibold hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200 transform hover:scale-105 shadow-lg w-full sm:w-auto justify-center">
                                    <i class="fas fa-paper-plane"></i>
                                    Publish Post
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Community Guidelines -->
                    <div class="mt-6 bg-blue-50 rounded-2xl p-6 border border-blue-200">
                        <h3 class="text-lg font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <i class="fas fa-users text-blue-600"></i>
                            Community Guidelines
                        </h3>
                        <ul class="space-y-2 text-blue-700 text-sm">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-shield-alt text-blue-500 mt-0.5"></i>
                                <span>Be respectful and supportive of others</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-lock text-blue-500 mt-0.5"></i>
                                <span>Maintain confidentiality - avoid sharing personal information</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-heart text-blue-500 mt-0.5"></i>
                                <span>This is a safe space for sharing and healing</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-flag text-blue-500 mt-0.5"></i>
                                <span>Report any concerning content to moderators</span>
                            </li>
                        </ul>
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

        // File upload drag and drop
        const fileDropZone = document.getElementById('fileDropZone');
        const fileInput = document.getElementById('media');

        if (fileDropZone && fileInput) {
            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            // Highlight drop zone when item is dragged over it
            ['dragenter', 'dragover'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, unhighlight, false);
            });

            // Handle dropped files
            fileDropZone.addEventListener('drop', handleDrop, false);

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight() {
                fileDropZone.classList.add('dragover');
            }

            function unhighlight() {
                fileDropZone.classList.remove('dragover');
            }

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                
                // Update UI to show file name
                if (files.length > 0) {
                    fileDropZone.innerHTML = `
                        <div class="space-y-2">
                            <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                            <p class="text-secondary-600 font-medium">File selected</p>
                            <p class="text-secondary-500 text-sm">${files[0].name}</p>
                            <button type="button" 
                                    onclick="document.getElementById('media').click()"
                                    class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-4 py-2 text-white font-semibold hover:bg-primary-600 transition-all duration-200 mt-2">
                                <i class="fas fa-sync"></i>
                                Change File
                            </button>
                        </div>
                    `;
                }
            }

            // Handle file input change
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileDropZone.innerHTML = `
                        <div class="space-y-2">
                            <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                            <p class="text-secondary-600 font-medium">File selected</p>
                            <p class="text-secondary-500 text-sm">${this.files[0].name}</p>
                            <button type="button" 
                                    onclick="document.getElementById('media').click()"
                                    class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-4 py-2 text-white font-semibold hover:bg-primary-600 transition-all duration-200 mt-2">
                                <i class="fas fa-sync"></i>
                                Change File
                            </button>
                        </div>
                    `;
                }
            });
        }

        // Character counter for title
        const titleInput = document.getElementById('title');
        if (titleInput) {
            titleInput.addEventListener('input', function() {
                const counter = document.getElementById('titleCounter') || (function() {
                    const counter = document.createElement('div');
                    counter.id = 'titleCounter';
                    counter.className = 'text-xs text-secondary-500 mt-1 text-right';
                    titleInput.parentNode.appendChild(counter);
                    return counter;
                })();
                
                counter.textContent = `${this.value.length}/150 characters`;
                
                if (this.value.length > 140) {
                    counter.classList.add('text-orange-500');
                    counter.classList.remove('text-secondary-500');
                } else {
                    counter.classList.remove('text-orange-500');
                    counter.classList.add('text-secondary-500');
                }
            });
        }
    </script>
</body>
</html>