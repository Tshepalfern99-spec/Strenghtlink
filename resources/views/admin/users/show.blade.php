@extends('layouts.admin')
@section('title', 'User #'.$user->id.' • Admin')
@section('header', 'User Profile')
@section('subtitle', $user->name)

@section('content')
<div class="grid gap-6 lg:grid-cols-12">
    {{-- Main Profile --}}
    <div class="lg:col-span-8 smooth-card bg-white rounded-2xl shadow-card p-6">
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center gap-4">
                <div class="h-16 w-16 rounded-2xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center text-xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="text-sm text-secondary-500">User ID: {{ $user->id }}</div>
                    <div class="mt-1 text-xl font-bold text-secondary-800">{{ $user->name }}</div>
                    <div class="text-secondary-600">{{ $user->email }}</div>
                    <div class="mt-2">
                        @if($user->email_verified_at)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 border border-green-200">
                                <i class="fas fa-check text-[10px]"></i>
                                Email verified on {{ $user->email_verified_at->format('M j, Y \\a\\t H:i') }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-50 px-2.5 py-1 text-xs font-medium text-warn border border-yellow-200">
                                <i class="fas fa-clock text-[10px]"></i>
                                Email not verified
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-right">
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')">
                    @csrf @method('DELETE')
                    <button class="inline-flex items-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 transition-all">
                        <i class="fas fa-trash"></i>
                        Delete User
                    </button>
                </form>
            </div>
        </div>

        {{-- User Details Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-secondary-50 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-calendar-plus text-secondary-500"></i>
                    <dt class="text-sm font-medium text-secondary-500">Joined</dt>
                </div>
                <dd class="text-sm font-medium text-secondary-800">{{ $user->created_at?->format('F j, Y \\a\\t H:i') }}</dd>
            </div>
            
            <div class="bg-secondary-50 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-calendar-edit text-secondary-500"></i>
                    <dt class="text-sm font-medium text-secondary-500">Last Updated</dt>
                </div>
                <dd class="text-sm font-medium text-secondary-800">{{ $user->updated_at?->format('F j, Y \\a\\t H:i') }}</dd>
            </div>
            
            {{-- Additional fields can be added here as your schema grows --}}
            <div class="bg-secondary-50 rounded-xl p-4 md:col-span-2">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-id-card text-secondary-500"></i>
                    <dt class="text-sm font-medium text-secondary-500">Account Status</dt>
                </div>
                <dd class="text-sm font-medium text-secondary-800">
                    @if($user->email_verified_at)
                        <span class="text-green-600">Active and Verified</span>
                    @else
                        <span class="text-yellow-600">Pending Verification</span>
                    @endif
                </dd>
            </div>
        </div>

        {{-- Recent Activity Placeholder --}}
        <div class="mt-6 pt-6 border-t border-secondary-100">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-history text-primary-500"></i>
                Recent Activity
            </h3>
            <div class="text-center py-8 text-secondary-400">
                <i class="fas fa-chart-bar text-3xl mb-2"></i>
                <p class="text-sm">Activity tracking coming soon</p>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="lg:col-span-4 space-y-6">
        {{-- Quick Actions --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-bolt text-primary-500"></i>
                Quick Actions
            </h3>
            <div class="flex flex-col gap-3">
                <a href="{{ route('admin.users.index') }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    <i class="fas fa-arrow-left"></i>
                    Back to Users List
                </a>
                
                <button class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-400 cursor-not-allowed" disabled>
                    <i class="fas fa-envelope"></i>
                    Send Password Reset
                </button>
                
                <button class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-400 cursor-not-allowed" disabled>
                    <i class="fas fa-ban"></i>
                    Suspend Account
                </button>
            </div>
        </div>

        {{-- User Statistics --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-pie text-primary-500"></i>
                User Statistics
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-secondary-500">Member Since</span>
                    <span class="font-medium text-secondary-800">{{ $user->created_at?->diffForHumans() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary-500">Account Age</span>
                    <span class="font-medium text-secondary-800">{{ $user->created_at?->diffInDays(now()) }} days</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary-500">Verification Status</span>
                    <span class="font-medium {{ $user->email_verified_at ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Admin Notes --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-shield-alt text-primary-500"></i>
                Admin Guidelines
            </h3>
            <div class="text-sm text-secondary-600 space-y-2">
                <p class="flex items-start gap-2">
                    <i class="fas fa-info-circle text-primary-500 mt-0.5"></i>
                    User management should be privacy-focused and minimal.
                </p>
                <p class="flex items-start gap-2">
                    <i class="fas fa-exclamation-triangle text-warn mt-0.5"></i>
                    Delete users only when absolutely necessary.
                </p>
                <p class="flex items-start gap-2">
                    <i class="fas fa-user-lock text-secondary-500 mt-0.5"></i>
                    Respect user privacy and data protection regulations.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection