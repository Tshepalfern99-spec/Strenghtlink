<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Forum Post - Community Forum</title>
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
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
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
    </style>
</head>
<body class="antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
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

            
            <div class="px-6 mt-auto">
                <div class="glass-effect rounded-xl p-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold">
                            U
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-secondary-800">User Name</p>
                            <p class="text-xs text-secondary-500">Member</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="glass-effect border-b border-gray-100 py-4 px-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-secondary-800">Edit Forum Post</h1>
                        <p class="text-sm text-secondary-500 mt-1">Update your community contribution</p>
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
                <div class="max-w-3xl mx-auto">
                    <!-- Back Navigation -->
                    <div class="mb-6">
                        <a href="{{ route('forum.show', $post) }}"
                           class="inline-flex items-center text-sm text-secondary-600 hover:text-primary-600 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Post
                        </a>
                    </div>

                    <!-- Edit Form Card -->
                    <div class="bg-white rounded-2xl shadow-card overflow-hidden animate-fade-in">
                        <div class="bg-gradient-to-r from-primary-500 to-primary-600 p-6 text-white">
                            <h2 class="text-xl font-bold flex items-center">
                                <i class="fas fa-edit mr-3"></i>
                                Edit Your Post
                            </h2>
                            <p class="mt-1 text-primary-100">Update your content to keep the conversation going</p>
                        </div>
                        
                        <form action="{{ route('forum.update', $post) }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="p-6 space-y-6"
                              aria-describedby="edit-help">
                            @csrf
                            @method('PUT')

                            <div id="edit-help" class="sr-only">
                                Edit your forum post. You can change the title, content, replace or remove the image, and update the video link.
                            </div>

                            <!-- Title Field -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-secondary-700 mb-2">
                                    <span class="flex items-center">
                                        <i class="fas fa-heading text-primary-500 mr-2"></i>
                                        Title
                                        <span class="text-red-600 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="text"
                                           id="title"
                                           name="title"
                                           value="{{ old('title', $post->title) }}"
                                           required
                                           maxlength="150"
                                           class="form-input w-full rounded-xl border-gray-200 focus:border-primary-400 py-3 px-4 bg-secondary-50 transition-all duration-200">
                                    <div class="absolute right-3 top-3 text-xs text-secondary-400 bg-white px-2 py-1 rounded-lg">
                                        {{ strlen(old('title', $post->title)) }}/150
                                    </div>
                                </div>
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600 flex items-center" role="alert">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Body Field -->
                            <div>
                                <label for="body" class="block text-sm font-medium text-secondary-700 mb-2">
                                    <span class="flex items-center">
                                        <i class="fas fa-align-left text-primary-500 mr-2"></i>
                                        Content
                                        <span class="text-red-600 ml-1">*</span>
                                    </span>
                                </label>
                                <textarea id="body"
                                          name="body"
                                          rows="8"
                                          required
                                          class="form-input w-full rounded-xl border-gray-200 focus:border-primary-400 py-3 px-4 bg-secondary-50 transition-all duration-200">{{ old('body', $post->body) }}</textarea>
                                @error('body')
                                    <p class="mt-2 text-sm text-red-600 flex items-center" role="alert">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Current Image Preview -->
                            @php
                                $currentUrl = null;
                                if (!empty($post->media_image_path) && Storage::disk('public')->exists($post->media_image_path)) {
                                    $currentUrl = Storage::disk('public')->url($post->media_image_path);
                                }
                            @endphp

                            @if($currentUrl)
                                <div class="bg-secondary-50 rounded-xl p-4">
                                    <span class="block text-sm font-medium text-secondary-700 mb-2">
                                        <i class="fas fa-image text-primary-500 mr-2"></i>
                                        Current Image
                                    </span>
                                    <div class="flex flex-col md:flex-row gap-4">
                                        <div class="flex-1">
                                            <img src="{{ $currentUrl }}"
                                                 alt="Current image for {{ $post->title }}"
                                                 class="rounded-xl w-full max-h-56 object-cover shadow-soft"
                                                 loading="lazy">
                                        </div>
                                        <div class="flex items-start">
                                            <label class="inline-flex items-center gap-2 text-sm text-secondary-700 bg-white p-3 rounded-lg border border-gray-200">
                                                <input type="checkbox" name="remove_media" value="1" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                                Remove current image
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Replace Image -->
                            <div>
                                <label for="media" class="block text-sm font-medium text-secondary-700 mb-2">
                                    <i class="fas fa-upload text-primary-500 mr-2"></i>
                                    {{ $currentUrl ? 'Replace Image' : 'Image (optional)' }}
                                </label>
                                <div class="file-input rounded-xl p-6 text-center cursor-pointer transition-all duration-300"
                                     id="file-drop-area">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-primary-400 mb-3"></i>
                                    <p class="text-secondary-600 font-medium">Drag & drop your image here</p>
                                    <p class="text-xs text-secondary-500 mt-1">or click to browse</p>
                                    <input type="file"
                                           id="media"
                                           name="media"
                                           accept="image/*"
                                           class="hidden">
                                </div>
                                <p class="mt-2 text-xs text-secondary-500 flex items-center">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Recommended max size ~2MB, common formats (JPG/PNG/WebP).
                                </p>
                                @error('media')
                                    <p class="mt-2 text-sm text-red-600 flex items-center" role="alert">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Video URL -->
                            <div>
                                <label for="video_url" class="block text-sm font-medium text-secondary-700 mb-2">
                                    <span class="flex items-center">
                                        <i class="fas fa-video text-primary-500 mr-2"></i>
                                        Video URL (optional)
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="url"
                                           id="video_url"
                                           name="video_url"
                                           value="{{ old('video_url', $post->video_url) }}"
                                           class="form-input w-full rounded-xl border-gray-200 focus:border-primary-400 py-3 px-4 pl-10 bg-secondary-50 transition-all duration-200"
                                           placeholder="https://www.youtube.com/embed/VIDEO_ID">
                                    <i class="fas fa-link absolute left-3 top-3.5 text-secondary-400"></i>
                                </div>
                                <p class="mt-2 text-xs text-secondary-500 flex items-center">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Use an embeddable URL (e.g., YouTube <code class="bg-secondary-100 px-1 rounded">/embed/</code> link).
                                </p>
                                @error('video_url')
                                    <p class="mt-2 text-sm text-red-600 flex items-center" role="alert">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row items-center justify-between pt-6 border-t border-gray-100">
                                <a href="{{ route('forum.show', $post) }}"
                                   class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all duration-200 mb-3 sm:mb-0">
                                    <i class="fas fa-times mr-2"></i>
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-5 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all duration-200">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Status Message -->
                    @if (session('status'))
                        <div class="mt-6 rounded-xl bg-green-50 p-4 text-green-700 border border-green-200 animate-fade-in flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-500"></i>
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        // File upload interaction
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('media');
            const fileDropArea = document.getElementById('file-drop-area');
            
            if (fileDropArea) {
                fileDropArea.addEventListener('click', () => {
                    fileInput.click();
                });
                
                fileDropArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    fileDropArea.classList.add('dragover');
                });
                
                fileDropArea.addEventListener('dragleave', () => {
                    fileDropArea.classList.remove('dragover');
                });
                
                fileDropArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    fileDropArea.classList.remove('dragover');
                    if (e.dataTransfer.files.length) {
                        fileInput.files = e.dataTransfer.files;
                        updateFileLabel(e.dataTransfer.files[0]);
                    }
                });
                
                fileInput.addEventListener('change', () => {
                    if (fileInput.files.length) {
                        updateFileLabel(fileInput.files[0]);
                    }
                });
                
                function updateFileLabel(file) {
                    const fileName = file.name;
                    fileDropArea.innerHTML = `
                        <i class="fas fa-file-image text-2xl text-primary-500 mb-2"></i>
                        <p class="text-secondary-700 font-medium">${fileName}</p>
                        <p class="text-xs text-secondary-500 mt-1">Click or drag to change</p>
                    `;
                }
            }
            
            // Character counter for title
            const titleInput = document.getElementById('title');
            if (titleInput) {
                titleInput.addEventListener('input', function() {
                    const counter = this.parentElement.querySelector('.absolute .text-xs');
                    if (counter) {
                        counter.textContent = `${this.value.length}/150`;
                    }
                });
            }
        });
    </script>
</body>
</html>