@extends('layouts.admin')

@section('title','Forum • Admin')
@section('header','Forum Moderation')
@section('subtitle','Review & remove harmful content')

@section('content')
<div class="grid gap-6 lg:grid-cols-4">
    <!-- Main Content -->
    <div class="lg:col-span-3">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-secondary-500 text-sm font-medium">Total Posts</p>
                        <p class="text-2xl font-bold text-secondary-800 mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center">
                        <i class="fa-solid fa-message"></i>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs text-success">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>{{ $stats['last7'] }} new this week</span>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-secondary-500 text-sm font-medium">This Week</p>
                        <p class="text-2xl font-bold text-secondary-800 mt-1">{{ $stats['last7'] }}</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-info to-info/80 text-white grid place-items-center">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs text-secondary-500">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Last 7 days</span>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-secondary-500 text-sm font-medium">Total Comments</p>
                        <p class="text-2xl font-bold text-secondary-800 mt-1">{{ $stats['comments'] }}</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-warn to-warn/80 text-white grid place-items-center">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs text-secondary-500">
                    <i class="fa-solid fa-comment"></i>
                    <span>Across all posts</span>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="glass-effect rounded-2xl p-6 shadow-card mb-6">
            <form method="GET" class="grid md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-secondary-700 mb-2">Search Content</label>
                    <div class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" 
                               class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50"
                               placeholder="Search titles, content, keywords…">
                        <i class="fa-solid fa-magnifying-glass absolute right-3 top-3.5 text-secondary-400"></i>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-secondary-700 mb-2">Author</label>
                    <div class="relative">
                        <input type="text" name="author" value="{{ request('author') }}" 
                               class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50"
                               placeholder="Search by name or email">
                        <i class="fa-solid fa-user absolute right-3 top-3.5 text-secondary-400"></i>
                    </div>
                </div>
                <div class="md:col-span-4 flex items-end gap-3">
                    <button class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                        <i class="fa-solid fa-filter"></i>
                        Filter Posts
                    </button>
                    <a href="{{ route('admin.forum.posts.index') }}" 
                       class="flex items-center gap-2 px-6 py-3 border border-secondary-300 text-secondary-700 hover:bg-secondary-50 font-medium rounded-xl transition-colors">
                        <i class="fa-solid fa-refresh"></i>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Posts List -->
        <div class="space-y-4">
            @forelse($posts as $p)
            <div class="glass-effect rounded-2xl p-6 shadow-card hover:shadow-glow transition-all duration-200 animate-fade-in smooth-card">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start gap-4">
                            @if($p->media_image_path)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/'.$p->media_image_path) }}" alt="Post image" 
                                     class="h-20 w-32 object-cover rounded-xl border border-secondary-200">
                            </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('admin.forum.posts.show', $p) }}" 
                                   class="text-lg font-semibold text-secondary-800 hover:text-primary-600 transition-colors line-clamp-2">
                                    {{ $p->title }}
                                </a>
                                <div class="flex items-center gap-3 mt-2 text-sm text-secondary-500">
                                    <span class="flex items-center gap-1">
                                        <i class="fa-solid fa-user"></i>
                                        {{ $p->user->name ?? 'User' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fa-solid fa-clock"></i>
                                        {{ $p->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-secondary-600 mt-3 leading-relaxed line-clamp-3">
                                    {{ Str::limit($p->body, 220) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 ml-4">
                        <form action="{{ route('admin.forum.posts.destroy',$p) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this post and all its comments? This action cannot be undone.')">
                            @csrf @method('DELETE')
                            <button class="flex items-center gap-2 px-4 py-2.5 bg-danger hover:bg-danger/90 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                                <i class="fa-solid fa-trash"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="glass-effect rounded-2xl p-12 text-center shadow-card animate-fade-in">
                <div class="h-20 w-20 rounded-2xl bg-secondary-100 text-secondary-400 grid place-items-center mx-auto mb-4">
                    <i class="fa-solid fa-message-slash text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-secondary-700 mb-2">No posts found</h3>
                <p class="text-secondary-500 max-w-md mx-auto">
                    No forum posts match your current filters. Try adjusting your search criteria or check back later for new content.
                </p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="mt-6 glass-effect rounded-2xl shadow-card p-4">
            <div class="flex items-center justify-between">
                <p class="text-sm text-secondary-500">
                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} posts
                </p>
                <div class="flex items-center gap-2">
                    {{ $posts->onEachSide(1)->links('vendor.pagination.simple-tailwind') }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Stats -->
        <div class="glass-effect rounded-2xl p-6 shadow-card">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-chart-simple text-primary-500"></i>
                Forum Overview
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-secondary-600">Total posts</span>
                    <span class="font-semibold text-secondary-800">{{ $stats['total'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-secondary-600">Last 7 days</span>
                    <span class="font-semibold text-secondary-800">{{ $stats['last7'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-secondary-600">Total comments</span>
                    <span class="font-semibold text-secondary-800">{{ $stats['comments'] }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="glass-effect rounded-2xl p-6 shadow-card">
            <h3 class="font-semibold text-secondary-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('forum.index') }}" target="_blank"
                   class="flex items-center gap-3 p-3 rounded-xl bg-secondary-50 hover:bg-primary-50 text-secondary-700 hover:text-primary-600 transition-all duration-200">
                    <div class="h-10 w-10 rounded-lg bg-primary-100 text-primary-600 grid place-items-center">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <span class="font-medium">View Live Forum</span>
                </a>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-secondary-50 text-secondary-500">
                    <div class="h-10 w-10 rounded-lg bg-secondary-200 text-secondary-400 grid place-items-center">
                        <i class="fa-solid fa-ban"></i>
                    </div>
                    <span class="font-medium">Reported Content</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="glass-effect rounded-2xl p-6 shadow-card">
            <h3 class="font-semibold text-secondary-800 mb-4">Recent Activity</h3>
            <div class="space-y-3">
                @php
                    $recentPosts = $posts->take(2);
                @endphp
                @forelse($recentPosts as $post)
                <div class="flex items-start gap-3 p-3 rounded-xl bg-secondary-50/50">
                    <div class="h-8 w-8 rounded-lg bg-primary-100 text-primary-600 grid place-items-center flex-shrink-0 mt-0.5">
                        <i class="fa-solid fa-message text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-secondary-800 truncate">
                            {{ Str::limit($post->title, 40) }}
                        </p>
                        <p class="text-xs text-secondary-500 mt-1">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-secondary-500 text-center py-4">No recent activity</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection