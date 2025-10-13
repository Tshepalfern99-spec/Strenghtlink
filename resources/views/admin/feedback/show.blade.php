@extends('layouts.admin')

@section('title','Feedback #'.$feedback->id.' • Admin')
@section('header','Feedback Details')
@section('subtitle','Feedback #'.$feedback->id)

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Feedback Card -->
        <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-secondary-800">Feedback Details</h2>
                    <p class="text-secondary-500 text-sm mt-1">Submitted {{ $feedback->created_at->diffForHumans() }}</p>
                </div>
                <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center">
                    <i class="fa-solid fa-comment-dots"></i>
                </div>
            </div>

            <!-- Rating -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-secondary-700 mb-3">Rating</label>
                @if($feedback->rating)
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star text-xl {{ $i <= $feedback->rating ? 'text-warn' : 'text-secondary-300' }}"></i>
                            @endfor
                        </div>
                        <span class="text-lg font-bold text-secondary-800">{{ $feedback->rating }} out of 5</span>
                    </div>
                @else
                    <div class="text-secondary-400 text-lg">No rating provided</div>
                @endif
            </div>

            <!-- Message -->
            <div>
                <label class="block text-sm font-medium text-secondary-700 mb-3">Message</label>
                @if($feedback->message)
                    <div class="glass-effect rounded-xl p-5 border border-secondary-200">
                        <p class="text-secondary-700 leading-relaxed">{{ $feedback->message }}</p>
                    </div>
                @else
                    <div class="glass-effect rounded-xl p-5 border border-secondary-200 text-center">
                        <div class="h-12 w-12 rounded-xl bg-secondary-100 text-secondary-400 grid place-items-center mx-auto mb-3">
                            <i class="fa-solid fa-comment-slash"></i>
                        </div>
                        <p class="text-secondary-500">No message provided with this feedback</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- User Information -->
        <div class="glass-effect rounded-2xl p-6 shadow-card">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user text-primary-500"></i>
                User Information
            </h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-secondary-500 mb-1">Name</p>
                    <p class="font-medium text-secondary-800">{{ $feedback->user->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-sm text-secondary-500 mb-1">Email</p>
                    <p class="font-medium text-secondary-800">{{ $feedback->user->email ?? '—' }}</p>
                </div>
                @if($feedback->user)
                <div class="pt-3 border-t border-secondary-100">
                    <a href="#" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 text-sm font-medium">
                        <i class="fa-solid fa-eye"></i>
                        View User Profile
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Report Information -->
        <div class="glass-effect rounded-2xl p-6 shadow-card">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-flag text-primary-500"></i>
                Related Report
            </h3>
            <div class="space-y-3">
                @if($feedback->report)
                    <div>
                        <p class="text-sm text-secondary-500 mb-1">Report Reference</p>
                        <a href="{{ route('admin.reports.show', $feedback->report_id) }}" 
                           class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium transition-colors">
                            <i class="fa-solid fa-link text-xs"></i>
                            {{ $feedback->report->reference ?? ('#'.$feedback->report_id) }}
                        </a>
                    </div>
                    <div class="pt-3 border-t border-secondary-100">
                        <a href="{{ route('admin.reports.show', $feedback->report_id) }}" 
                           class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 text-sm font-medium">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            View Report Details
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="h-12 w-12 rounded-xl bg-secondary-100 text-secondary-400 grid place-items-center mx-auto mb-3">
                            <i class="fa-solid fa-unlink"></i>
                        </div>
                        <p class="text-secondary-500 text-sm">No report associated with this feedback</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="glass-effect rounded-2xl p-6 shadow-card">
            <h3 class="font-semibold text-secondary-800 mb-4">Actions</h3>
            <form action="{{ route('admin.feedback.destroy',$feedback) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this feedback? This action cannot be undone.')">
                @csrf @method('DELETE')
                <button class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-danger hover:bg-danger/90 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                    <i class="fa-solid fa-trash"></i>
                    Delete Feedback
                </button>
            </form>
            <div class="mt-3 text-center">
                <a href="{{ route('admin.feedback.index') }}" 
                   class="inline-flex items-center gap-2 text-secondary-600 hover:text-secondary-800 text-sm font-medium transition-colors">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to All Feedback
                </a>
            </div>
        </div>
    </div>
</div>
@endsection