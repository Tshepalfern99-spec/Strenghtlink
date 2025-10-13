@extends('layouts.admin')
@section('title','News Management')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-secondary-800">News Management</h1>
            <p class="text-secondary-600 mt-1">Manage and publish community news articles</p>
        </div>
        <a href="{{ route('admin.news.create') }}" 
           class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-5 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all transform hover:scale-[1.02]">
            <i class="fas fa-plus"></i>
            New Article
        </a>
    </div>
</div>

{{-- Stats Overview --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="smooth-card bg-white rounded-2xl p-4 shadow-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-secondary-500">Total Articles</p>
                <p class="mt-1 text-2xl font-bold text-secondary-800">{{ $news->total() }}</p>
            </div>
            <div class="h-10 w-10 rounded-xl bg-primary-100 text-primary-600 grid place-items-center">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
    </div>
    
    <div class="smooth-card bg-white rounded-2xl p-4 shadow-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-secondary-500">Published</p>
                <p class="mt-1 text-2xl font-bold text-secondary-800">
                    {{ $news->where('status', 'published')->count() }}
                </p>
            </div>
            <div class="h-10 w-10 rounded-xl bg-green-100 text-success grid place-items-center">
                <i class="fas fa-bullhorn"></i>
            </div>
        </div>
    </div>
    
    <div class="smooth-card bg-white rounded-2xl p-4 shadow-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-secondary-500">Drafts</p>
                <p class="mt-1 text-2xl font-bold text-secondary-800">
                    {{ $news->where('status', 'draft')->count() }}
                </p>
            </div>
            <div class="h-10 w-10 rounded-xl bg-yellow-100 text-warn grid place-items-center">
                <i class="fas fa-edit"></i>
            </div>
        </div>
    </div>
    
    <div class="smooth-card bg-white rounded-2xl p-4 shadow-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-secondary-500">Scheduled</p>
                <p class="mt-1 text-2xl font-bold text-secondary-800">
                    {{ $news->where('published_at', '>', now())->count() }}
                </p>
            </div>
            <div class="h-10 w-10 rounded-xl bg-blue-100 text-info grid place-items-center">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
</div>

{{-- News Table --}}
<div class="smooth-card bg-white rounded-2xl shadow-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-secondary-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider rounded-tl-2xl">
                    Article
                </th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                    Status
                </th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                    Published
                </th>
                <th class="px-6 py-4 text-right text-xs font-semibold text-secondary-600 uppercase tracking-wider rounded-tr-2xl">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-secondary-100">
            @forelse($news as $post)
                <tr class="hover:bg-secondary-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($post->cover_image_path)
                                <img src="{{ asset('storage/'.$post->cover_image_path) }}" 
                                     alt="{{ $post->title }}"
                                     class="h-10 w-10 rounded-lg object-cover flex-shrink-0">
                            @else
                                <div class="h-10 w-10 rounded-lg bg-secondary-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-newspaper text-secondary-400"></i>
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <div class="font-medium text-secondary-800 truncate">{{ $post->title }}</div>
                                <div class="text-xs text-secondary-500 truncate">{{ $post->slug }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $badge = $post->status === 'published' 
                                ? 'bg-green-100 text-green-800 border border-green-200' 
                                : ($post->status === 'draft' 
                                    ? 'bg-yellow-100 text-yellow-800 border border-yellow-200'
                                    : 'bg-secondary-100 text-secondary-800 border border-secondary-200');
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                            <i class="fas fa-circle text-[8px] mr-1.5"></i>
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-secondary-600">
                        @if($post->published_at)
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-calendar text-xs text-secondary-400"></i>
                                {{ $post->published_at->format('M d, Y') }}
                                <span class="text-secondary-400">•</span>
                                <span class="text-secondary-500 text-xs">{{ $post->published_at->format('H:i') }}</span>
                            </div>
                        @else
                            <span class="text-secondary-400">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.news.show', $post) }}" 
                               class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-info hover:bg-blue-100 transition-colors">
                                <i class="fas fa-eye text-[10px]"></i>
                                View
                            </a>
                            <a href="{{ route('admin.news.edit', $post) }}" 
                               class="inline-flex items-center gap-1.5 rounded-lg bg-yellow-50 px-3 py-1.5 text-xs font-medium text-warn hover:bg-yellow-100 transition-colors">
                                <i class="fas fa-edit text-[10px]"></i>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.news.destroy', $post) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this news article?')">
                                @csrf @method('DELETE')
                                <button class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-medium text-danger hover:bg-red-100 transition-colors">
                                    <i class="fas fa-trash text-[10px]"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-secondary-400">
                            <i class="fas fa-newspaper text-4xl mb-3"></i>
                            <p class="text-lg font-medium text-secondary-500">No news articles yet</p>
                            <p class="text-sm text-secondary-400 mt-1">Get started by creating your first news article</p>
                            <a href="{{ route('admin.news.create') }}" 
                               class="mt-4 inline-flex items-center gap-2 rounded-xl bg-primary-500 px-4 py-2 text-sm font-medium text-white hover:bg-primary-600 transition-colors">
                                <i class="fas fa-plus"></i>
                                Create First Article
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
@if($news->hasPages())
    <div class="mt-6 flex justify-center">
        <div class="smooth-card bg-white rounded-xl shadow-soft px-4 py-3 flex items-center space-x-1">
            {{ $news->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endif
@endsection