@extends('layouts.admin')

@section('title', 'Resource Categories • Admin')
@section('header', 'Resource Categories')
@section('subtitle', 'Manage Resource Categories')

@section('content')
<div class="space-y-6">
    <!-- Header with Stats -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-secondary-800">Resource Categories</h1>
            <p class="text-secondary-500 mt-2">Organize and manage your resource categories</p>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- Stats -->
            <div class="hidden sm:flex items-center gap-4 text-sm">
                <div class="bg-primary-50 text-primary-700 px-3 py-1.5 rounded-xl border border-primary-200">
                    <span class="font-semibold">{{ $categories->total() }}</span> total categories
                </div>
                <div class="bg-success/10 text-success px-3 py-1.5 rounded-xl border border-success/20">
                    <span class="font-semibold">{{ $categories->where('resources_count', '>', 0)->count() }}</span> active
                </div>
            </div>
            
            <a 
                href="{{ route('admin.resource-categories.create') }}" 
                class="flex items-center gap-2 px-4 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200"
            >
                <i class="fa-solid fa-plus"></i>
                Add Category
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('status'))
    <div class="glass-effect border border-success/20 rounded-2xl p-4 animate-fade-in">
        <div class="flex items-center gap-3">
            <div class="h-8 w-8 rounded-full bg-success/20 text-success grid place-items-center flex-shrink-0">
                <i class="fa-solid fa-check text-sm"></i>
            </div>
            <div>
                <p class="text-success font-medium">{{ session('status') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Categories Table Card -->
    <div class="glass-effect rounded-2xl shadow-card overflow-hidden animate-fade-in">
        @if($categories->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-secondary-100 bg-secondary-50/50">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Resources</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary-100">
                    @foreach($categories as $cat)
                    <tr class="hover:bg-primary-50/30 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-xl bg-gradient-to-r from-primary-400 to-primary-600 text-white grid place-items-center flex-shrink-0">
                                    <i class="fa-solid fa-folder text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-secondary-800">{{ $cat->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <code class="text-xs bg-secondary-100 text-secondary-700 px-2 py-1 rounded-lg font-mono">
                                {{ $cat->slug }}
                            </code>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-secondary-800">{{ $cat->resources_count }}</span>
                                <span class="text-secondary-500 text-sm">resources</span>
                                @if($cat->resources_count > 0)
                                <span class="h-2 w-2 rounded-full bg-success"></span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a 
                                    href="{{ route('admin.resource-categories.edit', $cat) }}" 
                                    class="flex items-center gap-2 px-3 py-2 text-secondary-600 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors"
                                    title="Edit Category"
                                >
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    <span class="text-sm font-medium">Edit</span>
                                </a>
                                
                                <form 
                                    action="{{ route('admin.resource-categories.destroy', $cat) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Are you sure you want to delete this category? All resources under it will be moved to uncategorized.')"
                                >
                                    @csrf @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="flex items-center gap-2 px-3 py-2 text-secondary-600 hover:text-danger hover:bg-danger/10 rounded-lg transition-colors"
                                        title="Delete Category"
                                    >
                                        <i class="fa-solid fa-trash text-sm"></i>
                                        <span class="text-sm font-medium">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="h-16 w-16 rounded-2xl bg-secondary-100 text-secondary-400 grid place-items-center mx-auto mb-4">
                <i class="fa-solid fa-folder-open text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-secondary-700 mb-2">No categories yet</h3>
            <p class="text-secondary-500 mb-6 max-w-md mx-auto">
                Get started by creating your first resource category to organize your content.
            </p>
            <a 
                href="{{ route('admin.resource-categories.create') }}" 
                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200"
            >
                <i class="fa-solid fa-plus"></i>
                Create Your First Category
            </a>
        </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
    <div class="glass-effect rounded-2xl shadow-card p-4">
        <div class="flex items-center justify-between">
            <p class="text-sm text-secondary-500">
                Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
            </p>
            <div class="flex items-center gap-2">
                {{ $categories->links('vendor.pagination.simple-tailwind') }}
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
    /* Custom pagination styles if needed */
    .pagination {
        display: flex;
        gap: 0.5rem;
    }
    .page-item.active .page-link {
        background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        color: white;
        border-color: #ec4899;
    }
    .page-link {
        padding: 0.5rem 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        color: #64748b;
        transition: all 0.2s;
    }
    .page-link:hover {
        background-color: #f8fafc;
        color: #475569;
    }
</style>
@endpush
@endsection