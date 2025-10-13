@extends('layouts.admin')
@section('title', 'Resources • Admin')
@section('header', 'Resource Management')
@section('subtitle', 'Manage support services and organizations')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-secondary-800">Resources</h1>
            <p class="text-secondary-600 mt-1">Manage support services and organizations</p>
        </div>
        <a href="{{ route('admin.resources.create') }}" 
           class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-5 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all transform hover:scale-[1.02]">
            <i class="fas fa-plus"></i>
            Add Resource
        </a>
    </div>
</div>

@if(session('status'))
    <div class="smooth-card mb-6 rounded-2xl bg-green-50 p-4 text-green-700 border border-green-200 flex items-center">
        <i class="fas fa-check-circle mr-3 text-green-500 text-lg"></i>
        {{ session('status') }}
    </div>
@endif

{{-- Filters --}}
<div class="smooth-card bg-white rounded-2xl shadow-card p-6 mb-6">
    <form method="GET" class="grid gap-4 md:grid-cols-5">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-2">
                <i class="fas fa-search text-primary-500 mr-2"></i>
                Search Resources
            </label>
            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" 
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white"
                   placeholder="Name, city, phone, email...">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-secondary-700 mb-2">Category</label>
            <select name="category_id" class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white">
                <option value="">All categories</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(($filters['category_id'] ?? '') == $c->id)>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-secondary-700 mb-2">City</label>
            <input type="text" name="city" value="{{ $filters['city'] ?? '' }}" 
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white"
                   placeholder="City">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-secondary-700 mb-2">Province</label>
            <input type="text" name="province" value="{{ $filters['province'] ?? '' }}" 
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white"
                   placeholder="Province">
        </div>
        
        <div class="md:col-span-5 flex items-center gap-3">
            <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-5 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all">
                <i class="fas fa-filter"></i>
                Search
            </button>
            <a href="{{ route('admin.resources.index') }}" 
               class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- Resources Table --}}
<div class="smooth-card bg-white rounded-2xl shadow-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-secondary-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider rounded-tl-2xl">
                        Organization
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                        Category
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                        Location
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                        Contact
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-secondary-600 uppercase tracking-wider rounded-tr-2xl">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-secondary-100">
            @forelse($resources as $r)
                <tr class="hover:bg-secondary-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="font-medium text-secondary-800 group-hover:text-primary-700 transition-colors">
                            {{ $r->name }}
                        </div>
                        @if($r->website)
                            <div class="mt-1">
                                <a href="{{ $r->website }}" target="_blank" rel="noopener" 
                                   class="inline-flex items-center gap-1.5 text-xs text-primary-600 hover:text-primary-700 transition-colors">
                                    <i class="fas fa-external-link-alt text-[10px]"></i>
                                    Visit Website
                                </a>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-secondary-100 text-secondary-700">
                            <i class="fas fa-tag text-[10px]"></i>
                            {{ optional($r->category)->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-secondary-800 font-medium">
                            @if($r->city && $r->province)
                                {{ $r->city }}, {{ $r->province }}
                            @else
                                <span class="text-secondary-400">—</span>
                            @endif
                        </div>
                        @if($r->address)
                            <div class="text-xs text-secondary-500 mt-1">{{ $r->address }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($r->phone)
                            <div class="flex items-center gap-1.5 text-sm text-secondary-700">
                                <i class="fas fa-phone text-xs text-secondary-500"></i>
                                {{ $r->phone }}
                            </div>
                        @endif
                        @if($r->email)
                            <div class="flex items-center gap-1.5 text-sm text-secondary-700 mt-1">
                                <i class="fas fa-envelope text-xs text-secondary-500"></i>
                                {{ $r->email }}
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($r->is_active)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 border border-green-200">
                                <i class="fas fa-check text-[10px]"></i>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 border border-red-200">
                                <i class="fas fa-eye-slash text-[10px]"></i>
                                Hidden
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.resources.show', $r) }}" 
                               class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-info hover:bg-blue-100 transition-colors">
                                <i class="fas fa-eye text-[10px]"></i>
                                View
                            </a>
                            <a href="{{ route('admin.resources.edit', $r) }}" 
                               class="inline-flex items-center gap-1.5 rounded-lg bg-yellow-50 px-3 py-1.5 text-xs font-medium text-warn hover:bg-yellow-100 transition-colors">
                                <i class="fas fa-edit text-[10px]"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.resources.destroy', $r) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this resource? This action cannot be undone.')">
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
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-secondary-400">
                            <i class="fas fa-hands-helping text-4xl mb-3"></i>
                            <p class="text-lg font-medium text-secondary-500">No resources found</p>
                            <p class="text-sm text-secondary-400 mt-1">
                                @if($filters['q'] ?? false || $filters['category_id'] ?? false || $filters['city'] ?? false || $filters['province'] ?? false)
                                    Try adjusting your search criteria
                                @else
                                    Get started by adding your first resource
                                @endif
                            </p>
                            <a href="{{ route('admin.resources.create') }}" 
                               class="mt-4 inline-flex items-center gap-2 rounded-xl bg-primary-500 px-4 py-2 text-sm font-medium text-white hover:bg-primary-600 transition-colors">
                                <i class="fas fa-plus"></i>
                                Add First Resource
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
@if($resources->hasPages())
    <div class="mt-6 flex justify-center">
        <div class="smooth-card bg-white rounded-xl shadow-soft px-4 py-3 flex items-center space-x-1">
            {{ $resources->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endif

{{-- Categories Link --}}
<div class="mt-6 text-center">
    <a href="{{ route('admin.resource-categories.index') }}" 
       class="inline-flex items-center gap-2 text-sm text-secondary-600 hover:text-primary-600 transition-colors">
        <i class="fas fa-folder"></i>
        Manage Resource Categories
    </a>
</div>
@endsection