@extends('layouts.admin')

@section('title', 'Edit Education • ' . $item->title)
@section('header', 'Education')
@section('subtitle', 'Edit: ' . $item->title)

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center">
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-secondary-800">Edit Education Item</h1>
                    <p class="text-secondary-600">Update the content and settings</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.education.show', $item) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-secondary-100 hover:bg-secondary-200 text-secondary-700 font-medium rounded-xl transition-all duration-200">
                    <i class="fa-solid fa-eye"></i>
                    Preview
                </a>
                <a href="{{ route('admin.education.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-secondary-100 hover:bg-secondary-200 text-secondary-700 font-medium rounded-xl transition-all duration-200">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <form method="POST" action="{{ route('admin.education.update', $item) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="glass-effect rounded-2xl shadow-card p-6">
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-info-circle text-primary-500"></i>
                        Basic Information
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Title *</label>
                            <input type="text" name="title" value="{{ old('title', $item->title) }}" required
                                   class="w-full rounded-xl border border-secondary-300 px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200"
                                   placeholder="Enter education item title">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $item->slug) }}"
                                   class="w-full rounded-xl border border-secondary-300 px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200"
                                   placeholder="URL-friendly slug (auto-generated if empty)">
                        </div>
                    </div>
                </div>

                <!-- Content Details -->
                <div class="glass-effect rounded-2xl shadow-card p-6">
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-file-lines text-primary-500"></i>
                        Content Details
                    </h3>
                    <div class="space-y-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-secondary-700 mb-2">Category</label>
                                <select name="category" class="w-full rounded-xl border border-secondary-300 px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200">
                                    <option value="">Select Category</option>
                                    <option value="awareness" @selected(old('category', $item->category) === 'awareness')>Awareness</option>
                                    <option value="rights" @selected(old('category', $item->category) === 'rights')>Rights</option>
                                    <option value="services" @selected(old('category', $item->category) === 'services')>Services</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-secondary-700 mb-2">Type</label>
                                <select name="type" class="w-full rounded-xl border border-secondary-300 px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200">
                                    @foreach(['article','video','infographic','download'] as $t)
                                        <option value="{{ $t }}" @selected(old('type', $item->type) === $t)>{{ ucfirst($t) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Video URL</label>
                            <input type="url" name="video_url" value="{{ old('video_url', $item->video_url) }}"
                                   class="w-full rounded-xl border border-secondary-300 px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200"
                                   placeholder="https://www.youtube.com/embed/...">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Body Content</label>
                            <textarea name="body" rows="8" 
                                      class="w-full rounded-xl border border-secondary-300 px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200"
                                      placeholder="Enter the main content...">{{ old('body', $item->body) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- File Uploads -->
                <div class="glass-effect rounded-2xl shadow-card p-6">
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4">Media & Files</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Cover Image</label>
                            <input type="file" name="cover" accept="image/*" 
                                   class="block w-full text-sm text-secondary-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                            @if($item->cover_path)
                            <p class="text-xs text-secondary-500 mt-2 flex items-center gap-1">
                                <i class="fa-solid fa-image"></i>
                                Current: {{ basename($item->cover_path) }}
                            </p>
                            @endif
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Downloadable File</label>
                            <input type="file" name="download" 
                                   class="block w-full text-sm text-secondary-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                            @if($item->download_path)
                            <p class="text-xs text-secondary-500 mt-2 flex items-center gap-1">
                                <i class="fa-solid fa-file"></i>
                                Current: {{ basename($item->download_path) }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Publication Status -->
                <div class="glass-effect rounded-2xl shadow-card p-6">
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4">Publication</h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 border border-secondary-200 rounded-xl hover:bg-secondary-50 transition-colors duration-200 cursor-pointer">
                            <input type="checkbox" name="publish_now" value="1" 
                                   class="rounded border-secondary-300 text-primary-600 focus:ring-primary-500">
                            <div>
                                <div class="font-medium text-secondary-800">Publish Now</div>
                                <div class="text-sm text-secondary-500">Make this item publicly visible</div>
                            </div>
                        </label>

                        <label class="flex items-center gap-3 p-3 border border-secondary-200 rounded-xl hover:bg-secondary-50 transition-colors duration-200 cursor-pointer">
                            <input type="checkbox" name="unpublish" value="1"
                                   class="rounded border-secondary-300 text-primary-600 focus:ring-primary-500">
                            <div>
                                <div class="font-medium text-secondary-800">Unpublish</div>
                                <div class="text-sm text-secondary-500">Change status to draft</div>
                            </div>
                        </label>

                        <!-- Current Status -->
                        <div class="p-3 bg-secondary-50 rounded-xl border border-secondary-200">
                            <div class="text-sm font-medium text-secondary-700 mb-1">Current Status</div>
                            @if($item->published_at)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-success/20 text-success text-sm font-medium">
                                <i class="fa-solid fa-check text-xs"></i>
                                Published
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-warn/20 text-warn text-sm font-medium">
                                <i class="fa-solid fa-pen text-xs"></i>
                                Draft
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="glass-effect rounded-2xl shadow-card p-6">
                    <h3 class="text-lg font-semibold text-secondary-800 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                            <i class="fa-solid fa-save"></i>
                            Save Changes
                        </button>
                        
                        <a href="{{ route('admin.education.index') }}" 
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 border border-secondary-300 text-secondary-700 hover:bg-secondary-50 font-medium rounded-xl transition-all duration-200">
                            <i class="fa-solid fa-times"></i>
                            Cancel
                        </a>

                        <!-- Quick Actions -->
                        <div class="border-t border-secondary-200 pt-3 mt-3">
                            @if($item->published_at)
                            <form method="POST" action="{{ route('admin.education.unpublish', $item) }}">
                                @csrf
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-amber-100 hover:bg-amber-200 text-amber-700 font-medium rounded-xl transition-all duration-200">
                                    <i class="fa-solid fa-eye-slash"></i>
                                    Unpublish Now
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('admin.education.publish', $item) }}">
                                @csrf
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-success to-success/80 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                                    <i class="fa-solid fa-rocket"></i>
                                    Publish Now
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection