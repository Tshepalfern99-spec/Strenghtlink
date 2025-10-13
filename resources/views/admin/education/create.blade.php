@php
    $isAdmin = auth('admin')->check();
@endphp



@extends('layouts.admin')
@section('title','Add Education • Admin')
@section('header','Add Educational Item')
@section('subtitle','Create content for Awareness, Rights, Services')

@section('content')
<div class="max-w-7xl mx-auto">
    @if(session('status')) 
    <div class="mb-6 glass-effect rounded-2xl p-4 border border-success/20 animate-fade-in">
        <div class="flex items-center gap-3">
            <div class="h-6 w-6 rounded-full bg-success/20 text-success grid place-items-center flex-shrink-0">
                <i class="fa-solid fa-check text-xs"></i>
            </div>
            <p class="text-success font-medium">{{ session('status') }}</p>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.education.store') }}" enctype="multipart/form-data"
          class="grid lg:grid-cols-4 gap-6">
        @csrf

        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Basic Information Card -->
            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-info-circle text-primary-500"></i>
                    Basic Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Title</label>
                        <input name="title" value="{{ old('title') }}" required 
                               class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50"
                               placeholder="Enter educational content title">
                        @error('title') 
                        <p class="text-danger text-sm mt-2 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Summary</label>
                        <textarea name="summary" rows="3"
                                  class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50 resize-none"
                                  placeholder="Brief description of the content">{{ old('summary') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Body Content</label>
                        <textarea name="body" rows="10"
                                  class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50 resize-none"
                                  placeholder="Detailed educational content">{{ old('body') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Category & Media Card -->
            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-tag text-primary-500"></i>
                    Category & Media
                </h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Category</label>
                        <select name="category" 
                                class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50">
                            <option value="awareness">Awareness</option>
                            <option value="rights">Rights</option>
                            <option value="services">Services</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Media Type</label>
                        <select name="media_type" 
                                class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50">
                            <option value="none">None</option>
                            <option value="video">Video (embed URL)</option>
                            <option value="image">Image (external)</option>
                            <option value="infographic">Infographic (external)</option>
                            <option value="link">External link</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Media URL</label>
                        <input name="media_url" value="{{ old('media_url') }}" 
                               class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50"
                               placeholder="https://...">
                    </div>
                </div>
            </div>

            <!-- Video Transcript Card -->
            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-closed-captioning text-primary-500"></i>
                    Video Transcript
                </h3>
                <label class="block text-sm font-medium text-secondary-700 mb-2">Transcript (for accessibility)</label>
                <textarea name="video_transcript" rows="4"
                          class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50 resize-none"
                          placeholder="Enter video transcript for accessibility">{{ old('video_transcript') }}</textarea>
            </div>

            <!-- Quiz Card -->
            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-question-circle text-primary-500"></i>
                    Optional Quiz
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Quiz Title</label>
                        <input name="quiz_title" value="{{ old('quiz_title') }}" 
                               class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50"
                               placeholder="Enter quiz title">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Questions JSON</label>
                        <textarea name="quiz_questions" rows="6"
                                  class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50 font-mono text-sm resize-none"
                                  placeholder='[{"q":"Question text?","choices":["Option A","Option B","Option C"],"answer":0,"explain":"Explanation"}]'>{{ old('quiz_questions') }}</textarea>
                        <p class="text-xs text-secondary-500 mt-2 flex items-center gap-1">
                            <i class="fa-solid fa-info-circle"></i>
                            Format: JSON array with questions, choices, correct answer index, and explanation
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Files Card -->
            <div class="glass-effect rounded-2xl p-6 shadow-card">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4">Files & Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Cover Image</label>
                        <div class="border-2 border-dashed border-secondary-200 rounded-xl p-4 text-center hover:border-primary-300 transition-colors">
                            <input type="file" name="cover_image" accept="image/*" 
                                   class="hidden" id="cover-image">
                            <label for="cover-image" class="cursor-pointer">
                                <i class="fa-solid fa-cloud-arrow-up text-3xl text-secondary-400 mb-2"></i>
                                <p class="text-sm text-secondary-600">Click to upload cover image</p>
                                <p class="text-xs text-secondary-400 mt-1">PNG, JPG, WebP (max 5MB)</p>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Downloadable PDF</label>
                        <div class="border-2 border-dashed border-secondary-200 rounded-xl p-4 text-center hover:border-primary-300 transition-colors">
                            <input type="file" name="download" accept="application/pdf" 
                                   class="hidden" id="pdf-file">
                            <label for="pdf-file" class="cursor-pointer">
                                <i class="fa-solid fa-file-pdf text-3xl text-danger mb-2"></i>
                                <p class="text-sm text-secondary-600">Upload PDF file</p>
                                <p class="text-xs text-secondary-400 mt-1">PDF only (max 10MB)</p>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 rounded-xl bg-primary-50 border border-primary-200">
                        <input type="checkbox" name="publish_now" value="1" id="publish-now" 
                               class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-secondary-300 rounded">
                        <label for="publish-now" class="text-sm font-medium text-secondary-700">Publish immediately</label>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="glass-effect rounded-2xl p-6 shadow-card">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4">Actions</h3>
                <div class="space-y-3">
                    <button type="submit" 
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Save Content
                    </button>
                    <a href="{{ route('admin.education.index') }}" 
                       class="w-full flex items-center justify-center gap-2 px-4 py-3 border border-secondary-300 text-secondary-700 hover:bg-secondary-50 font-medium rounded-xl transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                        Cancel
                    </a>
                </div>
            </div>

            <!-- Help Card -->
            <div class="glass-effect rounded-2xl p-6 shadow-card">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-primary-500"></i>
                    Quick Tips
                </h3>
                <div class="space-y-2 text-sm text-secondary-600">
                    <p class="flex items-start gap-2">
                        <i class="fa-solid fa-lightbulb text-warn mt-0.5"></i>
                        Use clear, engaging titles
                    </p>
                    <p class="flex items-start gap-2">
                        <i class="fa-solid fa-lightbulb text-warn mt-0.5"></i>
                        Add transcripts for videos
                    </p>
                    <p class="flex items-start gap-2">
                        <i class="fa-solid fa-lightbulb text-warn mt-0.5"></i>
                        Test quiz JSON format
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // File input preview handlers
    document.getElementById('cover-image')?.addEventListener('change', function(e) {
        const label = this.nextElementSibling;
        if (this.files[0]) {
            label.querySelector('p').textContent = this.files[0].name;
        }
    });

    document.getElementById('pdf-file')?.addEventListener('change', function(e) {
        const label = this.nextElementSibling;
        if (this.files[0]) {
            label.querySelector('p').textContent = this.files[0].name;
        }
    });
</script>
@endpush
@endsection