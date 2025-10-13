@extends('layouts.admin')
@section('title', 'View Resource • Admin')
@section('header', 'Resource Details')
@section('subtitle', $resource->name)

@section('content')
<div class="grid gap-6 lg:grid-cols-12">
    {{-- Main Content --}}
    <div class="lg:col-span-8 smooth-card bg-white rounded-2xl shadow-card p-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-secondary-800">{{ $resource->name }}</h1>
                <div class="flex items-center gap-3 mt-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-secondary-100 text-secondary-700">
                        <i class="fas fa-tag"></i>
                        {{ optional($resource->category)->name }}
                    </span>
                    @if($resource->is_active)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 border border-green-200">
                            <i class="fas fa-check"></i>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 border border-red-200">
                            <i class="fas fa-eye-slash"></i>
                            Hidden
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.resources.edit', $resource) }}" 
                   class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-600 transition-all">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
                <a href="{{ route('admin.resources.index') }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    <i class="fas fa-arrow-left"></i>
                    Back to List
                </a>
            </div>
        </div>

        {{-- Contact Information --}}
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-secondary-50 rounded-xl p-4">
                <h3 class="font-semibold text-secondary-800 mb-3 flex items-center gap-2">
                    <i class="fas fa-phone text-primary-500"></i>
                    Contact Information
                </h3>
                <div class="space-y-2">
                    @if($resource->phone)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-phone text-secondary-500 w-5"></i>
                            <span class="text-secondary-700">{{ $resource->phone }}</span>
                        </div>
                    @endif
                    @if($resource->email)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-envelope text-secondary-500 w-5"></i>
                            <span class="text-secondary-700">{{ $resource->email }}</span>
                        </div>
                    @endif
                    @if($resource->website)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-globe text-secondary-500 w-5"></i>
                            <a href="{{ $resource->website }}" target="_blank" rel="noopener" 
                               class="text-primary-600 hover:text-primary-700 transition-colors">
                                {{ $resource->website }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-secondary-50 rounded-xl p-4">
                <h3 class="font-semibold text-secondary-800 mb-3 flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-primary-500"></i>
                    Location Information
                </h3>
                <div class="space-y-2">
                    @if($resource->address)
                        <div class="flex items-start gap-2">
                            <i class="fas fa-map-pin text-secondary-500 w-5 mt-0.5"></i>
                            <span class="text-secondary-700">{{ $resource->address }}</span>
                        </div>
                    @endif
                    @if($resource->city || $resource->province)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-city text-secondary-500 w-5"></i>
                            <span class="text-secondary-700">
                                @if($resource->city && $resource->province)
                                    {{ $resource->city }}, {{ $resource->province }}
                                @else
                                    {{ $resource->city }}{{ $resource->province }}
                                @endif
                            </span>
                        </div>
                    @endif
                    @if($resource->postal_code)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-mail-bulk text-secondary-500 w-5"></i>
                            <span class="text-secondary-700">{{ $resource->postal_code }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="flex items-center gap-3 pt-6 border-t border-secondary-100">
            <a href="tel:{{ $resource->phone }}" 
               class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-600 transition-all">
                <i class="fas fa-phone"></i>
                Call Now
            </a>
            @if($resource->email)
                <a href="mailto:{{ $resource->email }}" 
                   class="inline-flex items-center gap-2 rounded-xl bg-blue-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-600 transition-all">
                    <i class="fas fa-envelope"></i>
                    Send Email
                </a>
            @endif
            @if($resource->website)
                <a href="{{ $resource->website }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 rounded-xl bg-purple-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-purple-600 transition-all">
                    <i class="fas fa-external-link-alt"></i>
                    Visit Website
                </a>
            @endif
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="lg:col-span-4 space-y-6">
        {{-- Resource Status --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-info-circle text-primary-500"></i>
                Resource Status
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">Visibility</span>
                    @if($resource->is_active)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            <i class="fas fa-eye"></i>
                            Visible to Users
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                            <i class="fas fa-eye-slash"></i>
                            Hidden
                        </span>
                    @endif
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">Category</span>
                    <span class="font-medium text-secondary-800">{{ optional($resource->category)->name }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">Last Updated</span>
                    <span class="text-sm text-secondary-500">{{ $resource->updated_at?->format('M j, Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Management Actions --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-cog text-primary-500"></i>
                Management
            </h3>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.resources.edit', $resource) }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    <i class="fas fa-edit"></i>
                    Edit Resource
                </a>
                <form action="{{ route('admin.resources.destroy', $resource) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this resource? This action cannot be undone.')">
                    @csrf @method('DELETE')
                    <button class="w-full inline-flex items-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 transition-all">
                        <i class="fas fa-trash"></i>
                        Delete Resource
                    </button>
                </form>
            </div>
        </div>

        {{-- Help Information --}}
        <div class="smooth-card bg-gradient-to-r from-primary-50 to-secondary-50 rounded-2xl border border-primary-100 p-6">
            <h3 class="font-semibold text-secondary-800 mb-2 flex items-center gap-2">
                <i class="fas fa-question-circle text-primary-500"></i>
                Need Help?
            </h3>
            <p class="text-sm text-secondary-600">
                Ensure contact information is accurate and up-to-date. Resources marked as hidden will not be visible to users seeking help.
            </p>
        </div>
    </div>
</div>
@endsection