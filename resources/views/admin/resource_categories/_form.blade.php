@extends('layouts.admin')
@php $cat = $category ?? null; @endphp

@section('title', $title . ' • Admin')
@section('header', 'Resource Categories')
@section('subtitle', $cat ? 'Edit Category' : 'Create Category')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-secondary-800">{{ $title }}</h1>
        <p class="text-secondary-500 mt-2">{{ $cat ? 'Update existing category' : 'Create new resource category' }}</p>
    </div>

    <!-- Form Card -->
    <div class="glass-effect rounded-2xl shadow-card p-6 animate-fade-in">
        <form method="POST" action="{{ $action }}">
            @csrf
            @if(in_array($method,['PUT','PATCH'])) @method($method) @endif

            <!-- Name Field -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-secondary-700 mb-2">
                    Name
                </label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', optional($cat)->name) }}" 
                    required
                    class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                    placeholder="Enter category name"
                >
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="mb-6 p-4 bg-danger/10 border border-danger/20 rounded-xl animate-fade-in">
                <ul class="text-danger text-sm space-y-1">
                    @foreach ($errors->all() as $err)
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                            {{ $err }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200"
            >
                <i class="fa-solid fa-floppy-disk"></i>
                Save
            </button>
        </form>
    </div>

    <!-- Back Link -->
    <div class="mt-6 text-center">
        <a 
            href="{{ route('admin.resource-categories.index') }}" 
            class="inline-flex items-center gap-2 px-4 py-2 text-secondary-600 hover:text-primary-600 font-medium transition-colors rounded-xl hover:bg-primary-50"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>
    </div>
</div>
@endsection