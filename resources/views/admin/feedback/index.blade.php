@extends('layouts.admin')

@section('title','Feedback • Admin')
@section('header','User Feedback')
@section('subtitle','Ratings & comments from users')

@section('content')
<div class="grid gap-6 lg:grid-cols-4">
    <!-- Main Content -->
    <div class="lg:col-span-3">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-secondary-500 text-sm font-medium">Total Feedback</p>
                        <p class="text-2xl font-bold text-secondary-800 mt-1">{{ $stats['count'] }}</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 text-white grid place-items-center">
                        <i class="fa-solid fa-comment-dots"></i>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs text-success">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>{{ $stats['last7'] }} new this week</span>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-secondary-500 text-sm font-medium">Average Rating</p>
                        <p class="text-2xl font-bold text-secondary-800 mt-1">{{ $stats['avg'] }}/5</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-warn to-warn/80 text-white grid place-items-center">
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star text-xs {{ $i <= round($stats['avg']) ? 'text-warn' : 'text-secondary-300' }}"></i>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 shadow-card animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-secondary-500 text-sm font-medium">This Week</p>
                        <p class="text-2xl font-bold text-secondary-800 mt-1">{{ $stats['last7'] }}</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-info to-info/80 text-white grid place-items-center">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs text-secondary-500">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Last 7 days</span>
                </div>
            </div>
        </div>

     
        <!-- Filter Card -->
        <div class="glass-effect rounded-2xl p-6 shadow-card mb-6">
            <form method="GET" class="grid md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-secondary-700 mb-2">Search</label>
                    <div class="relative">
                        <input name="q" value="{{ request('q') }}" 
                               class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50"
                               placeholder="Message, user name/email, report ref…">
                        <i class="fa-solid fa-search absolute right-3 top-3.5 text-secondary-400"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary-700 mb-2">Rating</label>
                    <select name="rating" class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50">
                        <option value="">Any Rating</option>
                        @for($i=5;$i>=1;$i--)
                            <option value="{{ $i }}" @selected(request('rating')==$i)>{{ $i }} ⭐</option>
                        @endfor
                    </select>
                </div>
                <div class="hidden md:block"></div>
                <div>
                    <label class="block text-sm font-medium text-secondary-700 mb-2">From Date</label>
                    <input type="date" name="from" value="{{ request('from') }}" 
                           class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-secondary-700 mb-2">To Date</label>
                    <input type="date" name="to" value="{{ request('to') }}" 
                           class="w-full px-4 py-3 rounded-xl border border-secondary-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all duration-200 bg-white/50">
                </div>
                <div class="md:col-span-2 flex items-end gap-3">
                    <button class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl shadow-soft hover:shadow-glow transition-all duration-200">
                        <i class="fa-solid fa-filter"></i>
                        Filter
                    </button>
                    <a href="{{ route('admin.feedback.index') }}" 
                       class="flex items-center gap-2 px-6 py-3 border border-secondary-300 text-secondary-700 hover:bg-secondary-50 font-medium rounded-xl transition-colors">
                        <i class="fa-solid fa-refresh"></i>
                        Reset
                    </a>
                    <a href="{{ route('admin.feedback.export') }}" 
                       class="ml-auto flex items-center gap-2 px-6 py-3 border border-secondary-300 text-secondary-700 hover:bg-secondary-50 font-medium rounded-xl transition-colors">
                        <i class="fa-solid fa-download"></i>
                        Export CSV
                    </a>
                </div>
            </form>
        </div>

        <!-- Feedback Table -->
        <div class="glass-effect rounded-2xl shadow-card overflow-hidden animate-fade-in">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-secondary-100 bg-secondary-50/50">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Report</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-secondary-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-100">
                        @forelse($feedback as $f)
                        <tr class="hover:bg-primary-50/30 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-secondary-800">#{{ $f->id }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-secondary-800">{{ $f->user->name ?? '—' }}</div>
                                <div class="text-sm text-secondary-500">{{ $f->user->email ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($f->report)
                                    <a href="{{ route('admin.reports.show', $f->report_id) }}" 
                                       class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 font-medium transition-colors">
                                        <i class="fa-solid fa-link text-xs"></i>
                                        {{ $f->report->reference ?? ('#'.$f->report_id) }}
                                    </a>
                                @else
                                    <span class="text-secondary-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!is_null($f->rating))
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa-solid fa-star text-xs {{ $i <= $f->rating ? 'text-warn' : 'text-secondary-300' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="text-sm font-medium text-secondary-700">{{ $f->rating }}/5</span>
                                    </div>
                                @else
                                    <span class="text-secondary-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="line-clamp-2 max-w-xs text-sm text-secondary-700">
                                    {{ $f->message ?: 'No message' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-secondary-800">{{ $f->created_at->format('M j, Y') }}</div>
                                <div class="text-xs text-secondary-500">{{ $f->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.feedback.show',$f) }}" 
                                       class="flex items-center gap-1 px-3 py-1.5 text-primary-600 hover:text-primary-700 hover:bg-primary-50 rounded-lg transition-colors text-sm font-medium">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                        View
                                    </a>
                                    <form action="{{ route('admin.feedback.destroy',$f) }}" method="POST" 
                                          onsubmit="return confirm('Delete this feedback?')">
                                        @csrf @method('DELETE')
                                        <button class="flex items-center gap-1 px-3 py-1.5 text-danger hover:text-danger/80 hover:bg-danger/10 rounded-lg transition-colors text-sm font-medium">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="h-16 w-16 rounded-2xl bg-secondary-100 text-secondary-400 grid place-items-center mx-auto mb-4">
                                    <i class="fa-solid fa-comment-slash text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-secondary-700 mb-2">No feedback yet</h3>
                                <p class="text-secondary-500 max-w-md mx-auto">
                                    User feedback will appear here once they start submitting ratings and comments.
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($feedback->hasPages())
        <div class="mt-6 glass-effect rounded-2xl shadow-card p-4">
            <div class="flex items-center justify-between">
                <p class="text-sm text-secondary-500">
                    Showing {{ $feedback->firstItem() }} to {{ $feedback->lastItem() }} of {{ $feedback->total() }} results
                </p>
                <div class="flex items-center gap-2">
                    {{ $feedback->onEachSide(1)->links('vendor.pagination.simple-tailwind') }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Stats -->
        <div class="glass-effect rounded-2xl p-6 shadow-card">
            <h3 class="font-semibold text-secondary-800 mb-4">Feedback Overview</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-secondary-600">Total feedback</span>
                    <span class="font-semibold text-secondary-800">{{ $stats['count'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-secondary-600">Average rating</span>
                    <span class="font-semibold text-secondary-800">{{ $stats['avg'] }} / 5</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-secondary-600">Last 7 days</span>
                    <span class="font-semibold text-secondary-800">{{ $stats['last7'] }}</span>
                </div>
            </div>
            <a href="{{ route('admin.feedback.export') }}" 
               class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-3 border border-secondary-300 text-secondary-700 hover:bg-secondary-50 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-download"></i>
                Export CSV
            </a>
        </div>

        <!-- Recent Activity -->
        <div class="glass-effect rounded-2xl p-6 shadow-card">
            <h3 class="font-semibold text-secondary-800 mb-4">Recent Activity</h3>
            <div class="space-y-3">
                @php
                    $recentFeedback = $feedback->take(3);
                @endphp
                @forelse($recentFeedback as $f)
                <div class="flex items-start gap-3 p-3 rounded-xl bg-secondary-50/50">
                    <div class="h-8 w-8 rounded-lg bg-primary-100 text-primary-600 grid place-items-center flex-shrink-0 mt-0.5">
                        <i class="fa-solid fa-star text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-secondary-800 truncate">
                            {{ $f->user->name ?? 'User' }} rated {{ $f->rating }}/5
                        </p>
                        <p class="text-xs text-secondary-500 mt-1">{{ $f->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-secondary-500 text-center py-4">No recent activity</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection