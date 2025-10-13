@extends('layouts.admin')
@section('title','Report '.$report->reference.' — Admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-secondary-800">Report {{ $report->reference }}</h1>
            <p class="text-secondary-600 mt-1 flex items-center gap-2">
                <i class="fas fa-clock text-secondary-400"></i>
                Submitted {{ $report->created_at->format('F j, Y \\a\\t H:i') }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="tel:112" 
               class="inline-flex items-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 transition-all transform hover:scale-[1.02]">
                <i class="fas fa-phone"></i>
                Call Emergency
            </a>
            <form method="POST" action="{{ route('admin.reports.destroy', $report) }}"
                  onsubmit="return confirm('Are you sure you want to delete this report? This action cannot be undone.');">
                @csrf @method('DELETE')
                <button class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="smooth-card mb-6 rounded-2xl bg-green-50 p-4 text-green-700 border border-green-200 flex items-center">
        <i class="fas fa-check-circle mr-3 text-green-500 text-lg"></i>
        {{ session('success') }}
    </div>
@endif

<div class="grid gap-6 lg:grid-cols-3">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Report Details --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h2 class="font-semibold text-lg text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-file-alt text-primary-500"></i>
                Report Details
            </h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-secondary-50 rounded-xl p-4">
                    <dt class="text-sm font-medium text-secondary-500 mb-1">Category</dt>
                    <dd class="capitalize text-secondary-800 font-medium">{{ str_replace('_',' ',$report->category) }}</dd>
                </div>
                <div class="bg-secondary-50 rounded-xl p-4">
                    <dt class="text-sm font-medium text-secondary-500 mb-1">Status</dt>
                    <dd>
                        @php 
                            $badge = [
                                'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                'in_review' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                'resolved' => 'bg-green-100 text-green-800 border border-green-200'
                            ][$report->status] ?? 'bg-gray-100 text-gray-800 border border-gray-200';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $badge }}">
                            <i class="fas fa-circle text-[8px] mr-1.5"></i>
                            {{ ucfirst(str_replace('_',' ',$report->status)) }}
                        </span>
                    </dd>
                </div>
                <div class="bg-secondary-50 rounded-xl p-4">
                    <dt class="text-sm font-medium text-secondary-500 mb-1">Location</dt>
                    <dd class="text-secondary-800">
                        @if($report->location)
                            <span class="inline-flex items-center gap-1.5">
                                <i class="fas fa-map-marker-alt text-xs text-secondary-500"></i>
                                {{ $report->location }}
                            </span>
                        @else
                            <span class="text-secondary-400">Not specified</span>
                        @endif
                    </dd>
                </div>
                <div class="bg-secondary-50 rounded-xl p-4">
                    <dt class="text-sm font-medium text-secondary-500 mb-1">Submitted</dt>
                    <dd class="text-secondary-800">{{ $report->created_at->toDayDateTimeString() }}</dd>
                </div>
                <div class="md:col-span-2 bg-secondary-50 rounded-xl p-4">
                    <dt class="text-sm font-medium text-secondary-500 mb-2">Description</dt>
                    <dd class="text-secondary-700 whitespace-pre-wrap leading-relaxed">{{ $report->description }}</dd>
                </div>
            </dl>
        </div>

        {{-- Update Actions --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h2 class="font-semibold text-lg text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-edit text-primary-500"></i>
                Update Report
            </h2>
            <form method="POST" action="{{ route('admin.reports.update', $report) }}" class="space-y-4">
                @csrf @method('PUT')
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Status</label>
                        <select name="status" class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white">
                            <option value="pending" @selected($report->status==='pending')>Pending</option>
                            <option value="in_review" @selected($report->status==='in_review')>In Review</option>
                            <option value="resolved" @selected($report->status==='resolved')>Resolved</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Internal Note</label>
                        <input name="internal_note" 
                               class="form-input w-full rounded-xl border-secondary-200 focus:border-primary-400 py-2.5 px-4 bg-white"
                               placeholder="e.g., Contacted authorities, awaiting response">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-5 py-2.5 text-sm font-medium text-white hover:shadow-glow transition-all">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                    <a href="{{ route('admin.reports.index') }}" 
                       class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                        Back to Reports
                    </a>
                </div>
            </form>
        </div>

        {{-- Internal Notes --}}
        @if($report->internal_notes)
            <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
                <h2 class="font-semibold text-lg text-secondary-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-sticky-note text-primary-500"></i>
                    Internal Notes
                </h2>
                <div class="bg-secondary-50 rounded-xl p-4">
                    <pre class="text-sm text-secondary-700 whitespace-pre-wrap leading-relaxed">{{ $report->internal_notes }}</pre>
                </div>
            </div>
        @endif
    </div>

    {{-- Sidebar --}}
    <aside class="space-y-6">
        {{-- Contact Information --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-user-circle text-primary-500"></i>
                Contact Information
            </h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm font-medium text-secondary-500">Email</p>
                    <p class="text-secondary-800">{{ $report->contact_email ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-secondary-500">Phone</p>
                    <p class="text-secondary-800">{{ $report->contact_phone ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-secondary-500">Consent to Contact</p>
                    <p class="text-secondary-800">
                        @if($report->consent_to_contact)
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700">
                                <i class="fas fa-check"></i> Yes
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700">
                                <i class="fas fa-times"></i> No
                            </span>
                        @endif
                    </p>
                </div>
                
                <div class="flex flex-col gap-2 pt-2">
                    @if($report->contact_email)
                        <a href="mailto:{{ $report->contact_email }}" 
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                            <i class="fas fa-envelope"></i>
                            Email Reporter
                        </a>
                    @endif
                    @if($report->contact_phone)
                        <a href="tel:{{ preg_replace('/\s+/', '', $report->contact_phone) }}" 
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                            <i class="fas fa-phone"></i>
                            Call Reporter
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="smooth-card bg-white rounded-2xl shadow-card p-6">
            <h3 class="font-semibold text-secondary-800 mb-4 flex items-center gap-2">
                <i class="fas fa-bolt text-primary-500"></i>
                Quick Actions
            </h3>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.reports.index', ['status'=>'pending']) }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    <i class="fas fa-clock text-yellow-500"></i>
                    Pending Queue
                </a>
                <a href="{{ route('admin.reports.index', ['status'=>'in_review']) }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    <i class="fas fa-eye text-blue-500"></i>
                    In Review
                </a>
                <a href="{{ route('admin.reports.index', ['status'=>'resolved']) }}" 
                   class="inline-flex items-center gap-2 rounded-xl border border-secondary-200 bg-white px-4 py-2.5 text-sm font-medium text-secondary-700 hover:bg-secondary-50 transition-all">
                    <i class="fas fa-check text-green-500"></i>
                    Resolved
                </a>
            </div>
        </div>

        {{-- Emergency Protocol --}}
        <div class="smooth-card rounded-2xl bg-gradient-to-r from-red-50 to-rose-50 border border-rose-200 p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-10 w-10 rounded-xl bg-red-500 text-white grid place-items-center">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <div>
                    <div class="font-semibold text-secondary-800">Emergency Protocol</div>
                    <div class="text-xs text-secondary-600">For urgent situations</div>
                </div>
            </div>
            <a href="tel:112" 
               class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 transition-all">
                <i class="fas fa-phone"></i>
                Call Emergency Services
            </a>
        </div>
    </aside>
</div>
@endsection