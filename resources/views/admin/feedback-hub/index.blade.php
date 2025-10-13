@extends('layouts.admin')

@section('title','Admin • Feedback Hub')
@section('header','Feedback Hub')
@section('subtitle','All feedback in one place')

@section('content')
@if(session('status'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
        {{ session('status') }}
    </div>
@endif

{{-- Filters --}}
<form method="GET" class="mb-6 grid gap-3 md:grid-cols-5">
    <div class="md:col-span-2">
        <input type="search" name="q" value="{{ $q }}"
               placeholder="Search message / context / report ref…"
               class="w-full rounded-md border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-2 focus:ring-brand-200">
    </div>
    <div>
        <select name="rating" class="w-full rounded-md border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-2 focus:ring-brand-200">
            <option value="">Site rating: Any</option>
            @for($i=5;$i>=1;$i--)
                <option value="{{ $i }}" {{ (string)$rating===(string)$i?'selected':'' }}>
                    {{ $i }} star{{ $i>1?'s':'' }}
                </option>
            @endfor
        </select>
    </div>
    <div>
        <input type="date" name="from" value="{{ $from }}"
               class="w-full rounded-md border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-2 focus:ring-brand-200">
    </div>
    <div class="flex gap-2">
        <input type="date" name="to" value="{{ $to }}"
               class="w-full rounded-md border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-2 focus:ring-brand-200">
        <button class="rounded-md bg-brand-600 px-4 py-2 text-white hover:bg-brand-700">Filter</button>
        <div class="hidden md:flex gap-2">
            <a href="{{ route('admin.site-feedback.export') }}" class="rounded-md border px-3 py-2 text-sm hover:bg-gray-50">Export Site CSV</a>
            @if(Route::has('admin.feedback.export'))
                <a href="{{ route('admin.feedback.export') }}" class="rounded-md border px-3 py-2 text-sm hover:bg-gray-50">Export Report CSV</a>
            @endif
        </div>
    </div>
</form>

{{-- Tabs --}}
<div class="mb-4 flex items-center gap-2">
    <a href="#site" class="rounded-lg border px-3 py-1.5 text-sm hover:bg-white">Site Feedback</a>
    <a href="#report" class="rounded-lg border px-3 py-1.5 text-sm hover:bg-white">Report Feedback</a>
</div>

{{-- ========== SITE FEEDBACK ========== --}}
<div id="site" class="mb-10 rounded-xl bg-white shadow">
    <div class="flex items-center justify-between border-b px-4 py-3">
        <h3 class="font-semibold">Site Feedback (UX & Ratings)</h3>
        <a href="{{ route('admin.site-feedback.index') }}" class="text-sm text-brand-700 hover:underline">Full view</a>
    </div>

    <div class="divide-y">
        @forelse($site as $f)
            @php $stars = (int)($f->rating ?? 0); @endphp
            <div class="grid gap-3 px-4 py-4 md:grid-cols-12 items-start hover:bg-gray-50">
                <div class="md:col-span-3">
                    <div class="text-sm text-gray-600">{{ optional($f->created_at)->diffForHumans() }}</div>
                    <div class="text-xs text-gray-500">{{ $f->user->name ?? '—' }} • {{ $f->user->email ?? '' }}</div>
                </div>
                <div class="md:col-span-7">
                    <div class="text-sm text-gray-900">{{ \Illuminate\Support\Str::limit((string)$f->message, 160) ?: '—' }}</div>
                    <div class="mt-1 text-xs text-gray-500">
                        <span class="mr-2">Context: {{ $f->context ?? 'General' }}</span>
                        @if($stars>0)
                            <span class="text-amber-500">@for($i=0;$i<$stars;$i++)★@endfor</span>
                            <span class="text-gray-300">@for($i=$stars;$i<5;$i++)☆@endfor</span>
                        @endif
                    </div>
                </div>
                <div class="md:col-span-2 text-right">
                    <a href="{{ route('admin.site-feedback.show',$f) }}"
                       class="inline-flex items-center rounded-md border px-3 py-1.5 text-sm hover:bg-gray-50">Open</a>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">No site feedback yet.</div>
        @endforelse
    </div>

    <div class="px-4 py-3">
        {{ $site->onEachSide(1)->links() }}
    </div>
</div>

{{-- ========== REPORT FEEDBACK ========== --}}
<div id="report" class="rounded-xl bg-white shadow">
    <div class="flex items-center justify-between border-b px-4 py-3">
        <h3 class="font-semibold">Report Feedback (after incident submission)</h3>
        {{-- If you have a dedicated list page --}}
        @if(Route::has('admin.feedback.index'))
            <a href="{{ route('admin.feedback.index') }}" class="text-sm text-brand-700 hover:underline">Full view</a>
        @endif
    </div>

    <div class="divide-y">
        @forelse($report as $rf)
            <div class="grid gap-3 px-4 py-4 md:grid-cols-12 items-start hover:bg-gray-50">
                <div class="md:col-span-3">
                    <div class="text-sm text-gray-600">{{ optional($rf->created_at)->diffForHumans() }}</div>
                    <div class="text-xs text-gray-500">{{ $rf->user->name ?? '—' }} • {{ $rf->user->email ?? '' }}</div>
                </div>
                <div class="md:col-span-7">
                    <div class="text-sm text-gray-900">{{ \Illuminate\Support\Str::limit((string)($rf->message ?? $rf->notes ?? ''), 160) ?: '—' }}</div>
                    <div class="mt-1 text-xs text-gray-500">
                        Report Ref: {{ $rf->report->reference ?? '—' }}
                        @if(isset($rf->report->status))
                            • Status: <span class="capitalize">{{ str_replace('_',' ',$rf->report->status) }}</span>
                        @endif
                    </div>
                </div>
                <div class="md:col-span-2 text-right">
                    @if(Route::has('admin.feedback.show'))
                        <a href="{{ route('admin.feedback.show',$rf->id) }}"
                           class="inline-flex items-center rounded-md border px-3 py-1.5 text-sm hover:bg-gray-50">Open</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">No report feedback yet.</div>
        @endforelse
    </div>

    <div class="px-4 py-3">
        {{ $report->onEachSide(1)->links() }}
    </div>
</div>
@endsection
