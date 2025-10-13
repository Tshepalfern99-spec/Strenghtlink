@extends('layouts.admin')
@section('title', 'Users • Admin')
@section('header', 'User Management')
@section('subtitle', 'Manage community members')

@section('content')
<div class="grid gap-6 lg:grid-cols-12">
    {{-- Analytics Cards --}}
    <div class="lg:col-span-12 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="smooth-card bg-white rounded-2xl p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-secondary-500 font-medium">Total Users</p>
                    <p class="mt-2 text-2xl font-bold text-secondary-800">{{ number_format($analytics['total']) }}</p>
                </div>
                <div class="h-12 w-12 rounded-xl bg-primary-100 text-primary-600 grid place-items-center">
                    <i class="fas fa-users text-lg"></i>
                </div>
            </div>
        </div>
        
        <div class="smooth-card bg-white rounded-2xl p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-secondary-500 font-medium">Verified</p>
                    <p class="mt-2 text-2xl font-bold text-success">{{ number_format($analytics['verified']) }}</p>
                </div>
                <div class="h-12 w-12 rounded-xl bg-green-100 text-success grid place-items-center">
                    <i class="fas fa-check-circle text-lg"></i>
                </div>
            </div>
        </div>
        
        <div class="smooth-card bg-white rounded-2xl p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-secondary-500 font-medium">Unverified</p>
                    <p class="mt-2 text-2xl font-bold text-warn">{{ number_format($analytics['unverified']) }}</p>
                </div>
                <div class="h-12 w-12 rounded-xl bg-yellow-100 text-warn grid place-items-center">
                    <i class="fas fa-clock text-lg"></i>
                </div>
            </div>
        </div>
        
        <div class="smooth-card bg-white rounded-2xl p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-secondary-500 font-medium">Joined (7d)</p>
                    <p class="mt-2 text-2xl font-bold text-info">{{ number_format($analytics['last7']) }}</p>
                </div>
                <div class="h-12 w-12 rounded-xl bg-blue-100 text-info grid place-items-center">
                    <i class="fas fa-chart-line text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="lg:col-span-12 smooth-card bg-white rounded-2xl shadow-card p-6">
        <form method="GET" class="grid md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-secondary-700 mb-2">
                    <i class="fas fa-search text-primary-500 mr-2"></i>
                    Search Users
                </label>
                <input type="search" name="q" value="{{ $q }}" placeholder="Name, email, ID"
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-2">Verification</label>
                <select name="verified" class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white">
                    <option value="">Any Status</option>
                    <option value="yes" @selected($verified==='yes')>Verified</option>
                    <option value="no" @selected($verified==='no')>Unverified</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-2">From Date</label>
                <input type="date" name="from" value="{{ $from }}" 
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-2">To Date</label>
                <input type="date" name="to" value="{{ $to }}" 
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white">
            </div>
            
            <div class="md:col-span-5 flex items-center gap-3">
                <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-5 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all">
                    <i class="fas fa-filter"></i>
                    Apply Filters
                </button>
                
                <a href="{{ route('admin.users.index') }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    Reset
                </a>

                <a href="{{ route('admin.users.export', request()->query()) }}"
                   class="ml-auto inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    <i class="fas fa-file-export"></i>
                    Export CSV
                </a>
            </div>
        </form>
    </div>

    {{-- Users Table --}}
    <div class="lg:col-span-12 smooth-card bg-white rounded-2xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-secondary-50">
                    <tr class="text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">
                        <th class="px-6 py-4 rounded-tl-2xl">User ID</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Verification</th>
                        <th class="px-6 py-4">Joined</th>
                        <th class="px-6 py-4 text-right rounded-tr-2xl">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary-100">
                @forelse($users as $u)
                    <tr class="hover:bg-secondary-50 transition-colors group">
                        <td class="px-6 py-4 text-secondary-500 font-mono text-sm">{{ $u->id }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-secondary-800 group-hover:text-primary-700 transition-colors">
                                {{ $u->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-secondary-600">{{ $u->email }}</td>
                        <td class="px-6 py-4">
                            @if($u->email_verified_at)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 border border-green-200">
                                    <i class="fas fa-check text-[10px]"></i>
                                    Verified
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-50 px-2.5 py-1 text-xs font-medium text-warn border border-yellow-200">
                                    <i class="fas fa-clock text-[10px]"></i>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-secondary-500 text-sm">
                            {{ $u->created_at?->format('M j, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.show', $u) }}"
                                   class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-info hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-eye text-[10px]"></i>
                                    View
                                </a>
                                <form action="{{ route('admin.users.destroy', $u) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
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
                                <i class="fas fa-users text-4xl mb-3"></i>
                                <p class="text-lg font-medium text-secondary-500">No users found</p>
                                <p class="text-sm text-secondary-400 mt-1">
                                    @if($q || $verified || $from || $to)
                                        Try adjusting your search criteria
                                    @else
                                        No users are currently registered
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-secondary-100">
                {{ $users->onEachSide(1)->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection