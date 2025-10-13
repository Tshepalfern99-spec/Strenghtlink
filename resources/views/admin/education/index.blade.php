@extends('layouts.admin')

@section('title', 'Education • Admin')
@section('header', 'Education')
@section('subtitle', 'All items')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-secondary-800">Education Items</h1>
                    <p class="text-secondary-600">Manage all educational content</p>
                </div>
            </div>
            <a href="{{ route('admin.education.create') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                <i class="fa-solid fa-plus"></i>
                New Item
            </a>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="glass-effect rounded-2xl shadow-card p-6">
        <form method="GET" action="{{ route('admin.education.index' )}}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-secondary-400"></i>
                    <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search education items…"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-secondary-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200">
                </div>
            </div>
            <button type="submit" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                <i class="fa-solid fa-search"></i>
                Search
            </button>
        </form>
    </div>

    <!-- Content Table -->
    <div class="glass-effect rounded-2xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-secondary-50 border-b border-secondary-200">
                        <th class="py-4 px-6 text-left text-sm font-semibold text-secondary-800">Title</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-secondary-800">Category</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-secondary-800">Status</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-secondary-800">Last Updated</th>
                        <th class="py-4 px-6 text-right text-sm font-semibold text-secondary-800">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary-200">
                    @forelse($items as $it)
                    <tr class="hover:bg-secondary-50 transition-colors duration-150">
                        <td class="py-4 px-6">
                            <a href="{{ route('admin.education.show', $it) }}" 
                               class="group block">
                                <div class="font-medium text-secondary-800 group-hover:text-primary-600 transition-colors duration-200">
                                    {{ $it->title }}
                                </div>
                                <div class="text-sm text-secondary-500 mt-1">
                                    {{ Str::limit($it->body, 60) }}
                                </div>
                            </a>
                        </td>
                        <td class="py-4 px-6">
                            @if($it->category)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium 
                                @if($it->category === 'awareness') bg-blue-100 text-blue-700
                                @elseif($it->category === 'rights') bg-green-100 text-green-700
                                @else bg-purple-100 text-purple-700 @endif">
                                <i class="fa-solid 
                                    @if($it->category === 'awareness') fa-lightbulb
                                    @elseif($it->category === 'rights') fa-scale-balanced
                                    @else fa-handshake-angle @endif text-xs"></i>
                                {{ ucfirst($it->category) }}
                            </span>
                            @else
                            <span class="text-secondary-400">—</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            @if($it->published_at)
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
                        </td>
                        <td class="py-4 px-6 text-secondary-600">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-clock text-secondary-400"></i>
                                {{ $it->updated_at->diffForHumans() }}
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2 justify-end">
                                <a href="{{ route('admin.education.edit', $it) }}" 
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-100 hover:bg-secondary-200 text-secondary-700 font-medium rounded-xl transition-all duration-200">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                    Edit
                                </a>

                                @if($it->published_at)
                                <form method="POST" action="{{ route('admin.education.unpublish', $it) }}">
                                    @csrf
                                    <button class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 hover:bg-amber-200 text-amber-700 font-medium rounded-xl transition-all duration-200">
                                        <i class="fa-solid fa-eye-slash text-xs"></i>
                                        Unpublish
                                    </button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('admin.education.publish', $it) }}">
                                    @csrf
                                    <button class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-success to-success/80 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                                        <i class="fa-solid fa-rocket text-xs"></i>
                                        Publish
                                    </button>
                                </form>
                                @endif

                                <form method="POST" action="{{ route('admin.education.destroy', $it) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this educational item? This action cannot be undone.')">
                                    @csrf @method('DELETE')
                                    <button class="inline-flex items-center gap-2 px-4 py-2 bg-danger hover:bg-danger/90 text-white font-medium rounded-xl shadow-soft transition-all duration-200">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center">
                            <div class="text-secondary-400 mb-3">
                                <i class="fa-solid fa-inbox text-4xl"></i>
                            </div>
                            <p class="text-secondary-600 font-medium">No education items found</p>
                            <p class="text-secondary-500 text-sm mt-1">Get started by creating your first educational content</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($items->hasPages())
        <div class="border-t border-secondary-200 px-6 py-4 bg-secondary-50">
            {{ $items->links() }}
        </div>
        @endif
    </div>
</div>
@endsection