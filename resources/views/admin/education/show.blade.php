@php
    use Illuminate\Support\Facades\Storage;
    $coverUrl = $item->cover_path && Storage::disk('public')->exists($item->cover_path)
        ? Storage::disk('public')->url($item->cover_path)
        : null;
    $downloadUrl = $item->download_path && Storage::disk('public')->exists($item->download_path)
        ? Storage::disk('public')->url($item->download_path)
        : null;
@endphp

@extends('layouts.admin')

@section('title','Education • '.$item->title)
@section('header','Education Item Details')
@section('subtitle',$item->title)

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-4">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-secondary-800">{{ $item->title }}</h1>
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
                            @if($item->is_published)
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
                
                <div class="text-sm text-secondary-600 flex items-center gap-4">
                    @if($item->published_at)
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-calendar"></i>
                        Published {{ $item->published_at->diffForHumans() }}
                    </span>
                    @endif
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-clock"></i>
                        Updated {{ $item->updated_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.education.edit', $item) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                    <i class="fa-solid fa-pen"></i>
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.education.destroy', $item) }}" 
                      onsubmit="return confirm('Are you sure you want to delete this educational item? This action cannot be undone.')">
                    @csrf @method('DELETE')
                    <button class="inline-flex items-center gap-2 px-4 py-2.5 bg-danger hover:bg-danger/90 text-white font-medium rounded-xl shadow-soft transition-all duration-200">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Cover Image -->
            @if($coverUrl)
            <div class="glass-effect rounded-2xl shadow-card overflow-hidden">
                <img src="{{ $coverUrl }}" class="w-full h-80 object-cover" alt="Cover image">
                <div class="p-4 bg-secondary-50 border-t border-secondary-200">
                    <p class="text-sm text-secondary-600 flex items-center gap-2">
                        <i class="fa-solid fa-image text-secondary-400"></i>
                        Cover image
                    </p>
                </div>
            </div>
            @endif

            <!-- Video Embed -->
            @if($item->video_url)
            <div class="glass-effect rounded-2xl shadow-card overflow-hidden">
                <div class="aspect-video bg-black">
                    <iframe src="{{ $item->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen
                            title="Educational video: {{ $item->title }}"></iframe>
                </div>
                <div class="p-4 bg-secondary-50 border-t border-secondary-200">
                    <p class="text-sm text-secondary-600 flex items-center gap-2">
                        <i class="fa-solid fa-video text-secondary-400"></i>
                        Embedded video content
                    </p>
                </div>
            </div>
            @endif

            <!-- Body Content -->
            @if($item->body)
            <div class="glass-effect rounded-2xl shadow-card p-6">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-file-lines text-primary-500"></i>
                    Content
                </h3>
                <div class="prose max-w-none text-secondary-700 leading-relaxed bg-white rounded-xl p-6 border border-secondary-200">
                    {!! nl2br(e($item->body)) !!}
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Download Section -->
            @if($downloadUrl)
            <div class="glass-effect rounded-2xl shadow-card p-6">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-download text-primary-500"></i>
                    Downloadable File
                </h3>
                <div class="bg-white rounded-xl p-4 border border-secondary-200">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="h-10 w-10 rounded-lg bg-danger/20 text-danger grid place-items-center">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                        <div>
                            <p class="font-medium text-secondary-800">PDF Document</p>
                            <p class="text-sm text-secondary-500">Available for download</p>
                        </div>
                    </div>
                    <a href="{{ route('education.download', $item) }}" 
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                        <i class="fa-solid fa-download"></i>
                        Download File
                    </a>
                </div>
                <p class="text-xs text-secondary-500 mt-3 flex items-center gap-1">
                    <i class="fa-solid fa-info-circle"></i>
                    Public disk download link
                </p>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="glass-effect rounded-2xl shadow-card p-6">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.education.edit', $item) }}" 
                       class="w-full flex items-center gap-2 px-4 py-3 border border-secondary-300 text-secondary-700 hover:bg-secondary-50 font-medium rounded-xl transition-all duration-200">
                        <i class="fa-solid fa-pen"></i>
                        Edit Content
                    </a>
                    @if(!$item->is_published)
                    <form method="POST" action="{{ route('admin.education.publish', $item) }}" class="w-full">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center gap-2 px-4 py-3 bg-gradient-to-r from-success to-success/80 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                            <i class="fa-solid fa-rocket"></i>
                            Publish Now
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('admin.education.index') }}" 
                       class="w-full flex items-center gap-2 px-4 py-3 border border-secondary-300 text-secondary-700 hover:bg-secondary-50 font-medium rounded-xl transition-all duration-200">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to List
                    </a>
                </div>
            </div>

            <!-- Statistics -->
            <div class="glass-effect rounded-2xl shadow-card p-6">
                <h3 class="text-lg font-semibold text-secondary-800 mb-4">Content Info</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-secondary-600">Status</span>
                        <span class="font-medium text-secondary-800">
                            {{ $item->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">`
                        <span class="text-secondary-600">Created</span>
                        <span class="font-medium text-secondary-800">{{ $item->created_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-secondary-600">Last Updated</span>
                        <span class="font-medium text-secondary-800">{{ $item->updated_at->diffForHumans() }}</span>
                    </div>
                    @if($item->published_at)
                    <div class="flex items-center justify-between">
                        <span class="text-secondary-600">Published</span>
                        <span class="font-medium text-secondary-800">{{ $item->published_at->format('M j, Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection