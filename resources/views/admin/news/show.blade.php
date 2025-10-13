@extends('layouts.admin')
@section('title', $news->title)

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.news.index') }}" 
           class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
            <i class="fas fa-arrow-left"></i>
            All News
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.news.edit', $news) }}" 
               class="inline-flex items-center gap-2 rounded-xl bg-yellow-50 px-4 py-2.5 text-sm font-medium text-warn hover:bg-yellow-100 transition-all">
                <i class="fas fa-edit"></i>
                Edit
            </a>
            <form method="POST" action="{{ route('admin.news.destroy', $news) }}" 
                  onsubmit="return confirm('Are you sure you want to delete this news article?')">
                @csrf @method('DELETE')
                <button class="inline-flex items-center gap-2 rounded-xl bg-red-50 px-4 py-2.5 text-sm font-medium text-danger hover:bg-red-100 transition-all">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<div class="smooth-card bg-white rounded-2xl shadow-card overflow-hidden">
    {{-- Cover Image --}}
    @if($news->cover_image_path)
        <div class="h-64 w-full overflow-hidden">
            <img src="{{ asset('storage/'.$news->cover_image_path) }}" alt="{{ $news->title }}" 
                 class="w-full h-full object-cover">
        </div>
    @endif

    {{-- Content --}}
    <div class="p-8">
        {{-- Status Badge --}}
        <div class="mb-4">
            @php
                $badge = $news->status === 'published' 
                    ? 'bg-green-100 text-green-800 border border-green-200' 
                    : 'bg-yellow-100 text-yellow-800 border border-yellow-200';
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badge }}">
                <i class="fas fa-circle text-[8px] mr-2"></i>
                {{ ucfirst($news->status) }}
            </span>
        </div>

        {{-- Title --}}
        <h1 class="text-3xl font-bold text-secondary-800 leading-tight">{{ $news->title }}</h1>

        {{-- Meta Information --}}
        <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-secondary-500">
            <div class="flex items-center gap-1.5">
                <i class="fas fa-calendar"></i>
                @if($news->published_at)
                    Published {{ $news->published_at->format('F d, Y \\a\\t H:i') }}
                @else
                    Not published yet
                @endif
            </div>
            <div class="flex items-center gap-1.5">
                <i class="fas fa-clock"></i>
                Created {{ $news->created_at->diffForHumans() }}
            </div>
            @if($news->updated_at->gt($news->created_at))
                <div class="flex items-center gap-1.5">
                    <i class="fas fa-edit"></i>
                    Updated {{ $news->updated_at->diffForHumans() }}
                </div>
            @endif
        </div>

        {{-- Excerpt --}}
        @if($news->excerpt)
            <div class="mt-6 p-4 bg-primary-50 rounded-xl border border-primary-100">
                <p class="text-primary-800 font-medium flex items-start gap-2">
                    <i class="fas fa-quote-left text-primary-500 mt-0.5"></i>
                    {{ $news->excerpt }}
                </p>
            </div>
        @endif

        {{-- Body Content --}}
        <div class="prose prose-lg max-w-none mt-8 text-secondary-700 leading-relaxed">
            {!! nl2br(e($news->body)) !!}
        </div>

        {{-- Quick Actions --}}
        <div class="mt-8 flex items-center gap-3 pt-6 border-t border-secondary-100">
            <a href="{{ route('admin.news.edit', $news) }}" 
               class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-600 transition-all">
                <i class="fas fa-edit"></i>
                Edit Article
            </a>
            @if($news->status === 'draft')
                <form method="POST" action="{{ route('admin.news.publish', $news) }}">
                    @csrf
                    <button class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-600 transition-all">
                        <i class="fas fa-bolt"></i>
                        Publish Now
                    </button>
                </form>
            @endif
            <a href="{{ route('admin.news.index') }}" 
               class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                <i class="fas fa-list"></i>
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection