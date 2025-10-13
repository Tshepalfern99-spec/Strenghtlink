@extends('layouts.admin')
@section('title', $title . ' • Admin')

@php
  $r = $resource ?? null;
@endphp

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-secondary-800">{{ $title }}</h1>
            <p class="text-secondary-600 mt-1">Add or update resource information</p>
        </div>
        <a href="{{ route('admin.resources.index') }}" 
           class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
            <i class="fas fa-arrow-left"></i>
            Back to Resources
        </a>
    </div>
</div>

<form method="POST" action="{{ $action }}" class="smooth-card bg-white rounded-2xl shadow-card p-8">
    @csrf
    @if(in_array($method,['PUT','PATCH'])) @method($method) @endif

    <div class="grid gap-6 md:grid-cols-2">
        {{-- Category --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-folder text-primary-500 mr-2"></i>
                Category <span class="text-red-500">*</span>
            </label>
            <select name="resource_category_id" required
                    class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200">
                <option value="">Select a category</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(old('resource_category_id', optional($r)->resource_category_id) == $c->id)>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Name --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-building text-primary-500 mr-2"></i>
                Organization Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', optional($r)->name) }}" required
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200"
                   placeholder="Enter organization or service name">
        </div>

        {{-- Contact Information --}}
        <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-3">
                    <i class="fas fa-phone text-primary-500 mr-2"></i>
                    Phone
                </label>
                <input type="text" name="phone" value="{{ old('phone', optional($r)->phone) }}"
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200"
                       placeholder="Phone number">
            </div>
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-3">
                    <i class="fas fa-envelope text-primary-500 mr-2"></i>
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email', optional($r)->email) }}"
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200"
                       placeholder="Email address">
            </div>
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-3">
                    <i class="fas fa-globe text-primary-500 mr-2"></i>
                    Website
                </label>
                <input type="text" name="website" value="{{ old('website', optional($r)->website) }}"
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200"
                       placeholder="Website URL">
            </div>
        </div>

        {{-- Address --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-secondary-700 mb-3">
                <i class="fas fa-map-marker-alt text-primary-500 mr-2"></i>
                Address
            </label>
            <input type="text" name="address" value="{{ old('address', optional($r)->address) }}"
                   class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200"
                   placeholder="Street address">
        </div>

        {{-- Location Details --}}
        <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-3">City</label>
                <input type="text" name="city" value="{{ old('city', optional($r)->city) }}"
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200"
                       placeholder="City">
            </div>
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-3">Province</label>
                <input type="text" name="province" value="{{ old('province', optional($r)->province) }}"
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200"
                       placeholder="Province/State">
            </div>
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-3">Postal Code</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', optional($r)->postal_code) }}"
                       class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-3 px-4 bg-white transition-all duration-200"
                       placeholder="Postal code">
            </div>
        </div>

        {{-- Active Status --}}
        <div class="md:col-span-2">
            <label class="flex items-center gap-3 cursor-pointer group">
                <div class="relative">
                    <input type="checkbox" name="is_active" value="1" 
                           @checked(old('is_active', optional($r)->is_active ?? true))
                           class="checkbox sr-only">
                    <div class="w-5 h-5 border-2 border-secondary-300 rounded-md flex items-center justify-center transition-all duration-200 group-hover:border-primary-400">
                        <i class="fas fa-check text-white text-xs opacity-0 transition-opacity duration-200"></i>
                    </div>
                </div>
                <div>
                    <span class="text-sm font-medium text-secondary-700">Active and visible to users</span>
                    <p class="text-xs text-secondary-500 mt-1">When unchecked, this resource will be hidden from public view</p>
                </div>
            </label>
        </div>
    </div>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="mt-6 rounded-xl bg-red-50 p-4 border border-red-200">
            <div class="flex items-center gap-2 text-red-800 font-medium mb-2">
                <i class="fas fa-exclamation-triangle"></i>
                Please fix the following errors:
            </div>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Actions --}}
    <div class="mt-8 flex items-center justify-between pt-6 border-t border-secondary-100">
        <a href="{{ route('admin.resources.index') }}" 
           class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-5 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
            <i class="fas fa-times"></i>
            Cancel
        </a>
        <button type="submit" 
                class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-3 text-sm font-medium text-white hover:shadow-glow transition-all transform hover:scale-[1.02]">
            <i class="fas fa-save"></i>
            Save Resource
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced checkbox functionality
        const checkboxes = document.querySelectorAll('.checkbox');
        checkboxes.forEach(checkbox => {
            const container = checkbox.parentElement;
            
            // Set initial state
            if (checkbox.checked) {
                container.classList.add('bg-primary-500', 'border-primary-500');
                container.querySelector('i').classList.remove('opacity-0');
            }
            
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    container.classList.add('bg-primary-500', 'border-primary-500');
                    container.querySelector('i').classList.remove('opacity-0');
                } else {
                    container.classList.remove('bg-primary-500', 'border-primary-500');
                    container.querySelector('i').classList.add('opacity-0');
                }
            });
        });
    });
</script>
@endsection