@extends('layouts.admin')
@section('title','Incident Reports — Admin')
@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-secondary-800">Incident Reports</h1>
            <p class="text-secondary-600 mt-1">Manage and review community incident reports</p>
        </div>
        <div class="flex items-center gap-2 text-sm text-secondary-500">
            <div class="flex items-center gap-1.5">
                <i class="fas fa-circle text-xs text-primary-500"></i>
                Total: <span class="font-semibold">{{ $stats['total'] }}</span>
            </div>
            <div class="flex items-center gap-1.5">
                <i class="fas fa-circle text-xs text-warn"></i>
                Open: <span class="font-semibold">{{ $stats['open'] }}</span>
            </div>
            <div class="flex items-center gap-1.5">
                <i class="fas fa-circle text-xs text-info"></i>
                New (24h): <span class="font-semibold">{{ $stats['recent'] }}</span>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="smooth-card mb-6 rounded-2xl bg-green-50 p-4 text-green-700 border border-green-200 flex items-center">
        <i class="fas fa-check-circle mr-3 text-green-500 text-lg"></i>
        {{ session('success') }}
    </div>
@endif

{{-- Filters --}}
<div class="smooth-card bg-white rounded-2xl shadow-card p-6 mb-6">
    <form method="GET" class="grid gap-4 md:grid-cols-5">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-2">
                <i class="fas fa-search text-primary-500 mr-2"></i>
                Search Reports
            </label>
            <input name="q" value="{{ $q }}" 
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white"
                   placeholder="Reference, description, location...">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-secondary-700 mb-2">Status</label>
            <select name="status" class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white">
                <option value="">All Statuses</option>
                <option value="pending" @selected($status==='pending')>Pending</option>
                <option value="in_review" @selected($status==='in_review')>In Review</option>
                <option value="resolved" @selected($status==='resolved')>Resolved</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-secondary-700 mb-2">Category</label>
            <select name="category" class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white">
                <option value="">All Categories</option>
                <option value="assault" @selected($category==='assault')>Assault</option>
                <option value="harassment" @selected($category==='harassment')>Harassment</option>
                <option value="discrimination" @selected($category==='discrimination')>Discrimination</option>
                <option value="threat" @selected($category==='threat')>Threat</option>
            </select>
        </div>
        
        <div class="flex items-end gap-2">
            <button class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 py-2.5 px-4 text-sm font-medium text-white hover:shadow-glow transition-all">
                <i class="fas fa-filter"></i>
                Filter
            </button>
            <a href="{{ route('admin.reports.index') }}" 
               class="inline-flex items-center justify-center rounded-xl border border-secondary-200 bg-white py-2.5 px-4 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- Reports Table --}}
<div class="smooth-card bg-white rounded-2xl shadow-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-secondary-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider rounded-tl-2xl">
                        Reference
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                        Category
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                        Location
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                        Submitted
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
                @forelse($reports as $r)
                    <tr class="hover:bg-secondary-50 transition-colors group">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.reports.show',$r) }}" 
                               class="font-medium text-secondary-800 hover:text-primary-700 transition-colors group-hover:underline">
                                {{ $r->reference }}
                            </a>
                        </td>
                        <td class="px-6 py-4 capitalize text-secondary-700">
                            <span class="inline-flex items-center gap-1.5">
                                <i class="fas fa-tag text-xs text-secondary-400"></i>
                                {{ str_replace('_',' ', $r->category) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-secondary-600">
                            @if($r->location)
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="fas fa-map-marker-alt text-xs text-secondary-400"></i>
                                    {{ $r->location }}
                                </span>
                            @else
                                <span class="text-secondary-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-secondary-500">
                            <span class="inline-flex items-center gap-1.5">
                                <i class="fas fa-clock text-xs"></i>
                                {{ $r->created_at->diffForHumans() }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @php 
                                $badge = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                    'in_review' => 'bg-blue-100 text-blue-800 border border-blue-200', 
                                    'resolved' => 'bg-green-100 text-green-800 border border-green-200'
                                ][$r->status] ?? 'bg-gray-100 text-gray-800 border border-gray-200';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $badge }}">
                                <i class="fas fa-circle text-[8px] mr-1.5"></i>
                                {{ ucfirst(str_replace('_',' ',$r->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.reports.show',$r) }}" 
                                   class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-info hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-eye text-[10px]"></i>
                                    Open
                                </a>
                                <form method="POST" action="{{ route('admin.reports.destroy',$r) }}" 
                                      onsubmit="return confirm('Are you sure you want to delete this report? This action cannot be undone.')">
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
                                <i class="fas fa-flag text-4xl mb-3"></i>
                                <p class="text-lg font-medium text-secondary-500">No reports found</p>
                                <p class="text-sm text-secondary-400 mt-1">
                                    @if($q || $status || $category)
                                        Try adjusting your filters to see more results
                                    @else
                                        No incident reports have been submitted yet
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
@if($reports->hasPages())
    <div class="mt-6 flex justify-center">
        <div class="smooth-card bg-white rounded-xl shadow-soft px-4 py-3 flex items-center space-x-1">
            {{ $reports->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endif
@endsection