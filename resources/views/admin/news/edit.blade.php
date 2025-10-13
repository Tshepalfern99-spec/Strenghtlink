@extends('layouts.admin')
@section('title', 'Edit News')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-secondary-800">Edit: {{ $news->title }}</h1>
            <p class="text-secondary-600 mt-1">Update news article details and content</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.news.index') }}" 
               class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                <i class="fas fa-newspaper"></i>
                All News
            </a>
            <a href="{{ route('admin.news.show', $news) }}" 
               class="inline-flex items-center gap-2 rounded-xl bg-secondary-100 px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-200 transition-all">
                <i class="fas fa-eye"></i>
                View
            </a>
        </div>
    </div>
</div>

{{-- Publish Prompt Banner --}}
@if(session('showPublishPrompt') || $news->status === 'draft')
    <div class="smooth-card mb-6 rounded-2xl border border-yellow-200 bg-yellow-50 p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-yellow-100 text-yellow-600 grid place-items-center">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="font-semibold text-yellow-800">Ready to Publish?</div>
                    <div class="text-sm text-yellow-700 mt-1">
                        {{ session('status') ?? 'This post is currently a draft and not visible to the public.' }}
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.news.publish', $news) }}">
                @csrf
                <button class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-600 transition-all transform hover:scale-[1.02]">
                    <i class="fas fa-bolt"></i>
                    Publish Now
                </button>
            </form>
        </div>
    </div>
@endif

{{-- Edit Form --}}
<form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" 
      class="smooth-card bg-white rounded-2xl shadow-card p-8">
    @csrf @method('PUT')

    <div class="grid gap-8 md:grid-cols-2">
        {{-- Title --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-heading text-primary-500 mr-2"></i>
                Title <span class="text-red-500">*</span>
            </label>
            <input name="title" value="{{ old('title',$news->title) }}" required 
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200">
        </div>

        {{-- Slug --}}
        <div>
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-link text-primary-500 mr-2"></i>
                Slug <span class="text-red-500">*</span>
            </label>
            <input name="slug" value="{{ old('slug',$news->slug) }}" required 
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200">
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-bullhorn text-primary-500 mr-2"></i>
                Status
            </label>
            <select name="status" 
                    class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200">
                <option value="draft" {{ old('status',$news->status)==='draft'?'selected':'' }}>Draft</option>
                <option value="published" {{ old('status',$news->status)==='published'?'selected':'' }}>Published</option>
            </select>
            <p class="text-xs text-secondary-500 mt-2 flex items-center">
                <i class="fas fa-info-circle mr-1"></i>
                Use "Publish Now" button for immediate publishing
            </p>
        </div>

        {{-- Publish Date --}}
        <div>
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-calendar text-primary-500 mr-2"></i>
                Publish At
            </label>
            <input type="datetime-local" name="published_at"
                   value="{{ old('published_at', optional($news->published_at)->format('Y-m-d\TH:i')) }}"
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200">
        </div>

        {{-- Cover Image --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-image text-primary-500 mr-2"></i>
                Cover Image
            </label>
            
            @if($news->cover_image_path)
                <div class="mb-4 flex items-start gap-4">
                    <img src="{{ asset('storage/'.$news->cover_image_path) }}" alt="{{ $news->title }}" 
                         class="h-32 w-48 rounded-xl object-cover shadow-sm">
                    <div class="flex-1">
                        <p class="text-sm text-secondary-600">Current cover image</p>
                        <p class="text-xs text-secondary-500">Upload new image to replace</p>
                    </div>
                </div>
            @endif
            
            <div class="file-input rounded-xl p-6 text-center cursor-pointer transition-all duration-300 border-2 border-dashed border-secondary-200 hover:border-primary-300"
                 id="coverImageUpload">
                <i class="fas fa-cloud-upload-alt text-3xl text-primary-400 mb-3"></i>
                <p class="text-secondary-600 font-medium">
                    {{ $news->cover_image_path ? 'Replace Cover Image' : 'Upload Cover Image' }}
                </p>
                <p class="text-xs text-secondary-500 mt-1">Click to browse files</p>
                <input type="file" name="cover_image" accept="image/*" class="hidden">
            </div>
        </div>

        {{-- Excerpt --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-quote-left text-primary-500 mr-2"></i>
                Excerpt
            </label>
            <textarea name="excerpt" rows="3" 
                      class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200">{{ old('excerpt',$news->excerpt) }}</textarea>
        </div>

        {{-- Body --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-align-left text-primary-500 mr-2"></i>
                Content <span class="text-red-500">*</span>
            </label>
            <textarea name="body" rows="12" required
                      class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200 resize-vertical">{{ old('body',$news->body) }}</textarea>
        </div>
    </div>

    {{-- Form Actions --}}
    <div class="mt-8 flex items-center justify-between pt-6 border-t border-secondary-100">
        <a href="{{ route('admin.news.index') }}" 
           class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-5 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
            <i class="fas fa-times"></i>
            Cancel
        </a>
        <button type="submit" 
                class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-3 text-sm font-medium text-white hover:shadow-glow transition-all transform hover:scale-[1.02]">
            <i class="fas fa-save"></i>
            Save Changes
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('input[name="cover_image"]');
        const uploadArea = document.getElementById('coverImageUpload');
        
        uploadArea.addEventListener('click', () => fileInput.click());
        
        fileInput.addEventListener('change', function() {
            if (this.files.length) {
                const fileName = this.files[0].name;
                uploadArea.innerHTML = `
                    <i class="fas fa-file-image text-2xl text-primary-500 mb-2"></i>
                    <p class="text-secondary-700 font-medium">${fileName}</p>
                    <p class="text-xs text-secondary-500 mt-1">Click to change image</p>
                `;
            }
        });
    });
</script>
@endsection