@extends('layouts.admin')

@section('title','Strengthlink • Admin Dashboard')
@section('header','Dashboard')
@section('subtitle','Overview')

@php
    $counts = $counts ?? ['users'=>0,'reports'=>0,'resources'=>0,'shelters'=>0,'counselling'=>0,'legal'=>0];
    $reportStats   = $reportStats   ?? ['open'=>0,'new_24h'=>0,'new_7d'=>0];
    $newReports    = $newReports    ?? collect();
    $recentReports = $recentReports ?? collect();
@endphp

@section('content')
    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('admin.news.create') }}" 
           class="smooth-card bg-white rounded-2xl p-5 shadow-card flex flex-col items-center justify-center text-center hover:shadow-glow group">
            <div class="w-12 h-12 rounded-xl bg-primary-100 text-primary-600 grid place-items-center mb-3 group-hover:scale-110 transition-transform">
                <i class="fas fa-pen-nib text-lg"></i>
            </div>
            <p class="text-sm font-medium text-secondary-800">Publish News</p>
        </a>
        
        <a href="{{ route('admin.news.index') }}" 
           class="smooth-card bg-white rounded-2xl p-5 shadow-card flex flex-col items-center justify-center text-center hover:shadow-glow group">
            <div class="w-12 h-12 rounded-xl bg-secondary-100 text-secondary-600 grid place-items-center mb-3 group-hover:scale-110 transition-transform">
                <i class="fas fa-newspaper text-lg"></i>
            </div>
            <p class="text-sm font-medium text-secondary-800">Manage News</p>
        </a>

        <a href="{{ route('admin.users.index') }}" 
           class="smooth-card bg-white rounded-2xl p-5 shadow-card flex flex-col items-center justify-center text-center hover:shadow-glow group">
            <div class="w-12 h-12 rounded-xl bg-green-100 text-success grid place-items-center mb-3 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-users text-lg"></i>
            </div>
            <p class="text-sm font-medium text-secondary-800">User Management</p>
        </a>

        <a href="{{ route('admin.reports.index') }}" 
           class="smooth-card bg-white rounded-2xl p-5 shadow-card flex flex-col items-center justify-center text-center hover:shadow-glow group">
            <div class="w-12 h-12 rounded-xl bg-red-100 text-danger grid place-items-center mb-3 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-flag text-lg"></i>
            </div>
            <p class="text-sm font-medium text-secondary-800">View Reports</p>
        </a>
    </div>

    {{-- KPI Cards --}}
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="smooth-card rounded-2xl bg-white p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-800">Total Users</p>
                    <p class="mt-2 text-3xl font-bold text-secondary-800">{{ $counts['users'] }}</p>
                    <p class="text-sm font-medium text-secondary-800">Registered members</p>
                </div>
                <div class="h-12 w-12 rounded-xl bg-primary-100 text-primary-600 grid place-items-center">
                    <i class="fa-solid fa-users text-lg"></i>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.education.create') }}" class="smooth-card bg-white rounded-2xl p-5 shadow-card flex flex-col items-center justify-center text-center hover:shadow-glow group">
            <div class="w-12 h-12 rounded-xl bg-secondary-100 text-secondary-600 grid place-items-center mb-3 group-hover:scale-110 transition-transform">
              <i class="fa-solid fa-plus"></i>
            </div>
            <p class="text-sm font-medium text-secondary-800">Add Education Item</p>
          </a>
          
        <div class="smooth-card rounded-2xl bg-white p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-800">Total Reports</p>
                    <p class="mt-2 text-3xl font-bold text-secondary-800">{{ $counts['reports'] }}</p>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-sm font-medium text-secondary-800">
                            Open: <span class="font-semibold text-warn">{{ $reportStats['open'] }}</span>
                        </span>
                    </div>
                </div>
                <div class="h-12 w-12 rounded-xl bg-red-100 text-danger grid place-items-center">
                    <i class="fa-solid fa-flag text-lg"></i>
                </div>
            </div>
        </div>

        <div class="smooth-card rounded-2xl bg-white p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-800">Resources Available</p>
                    <p class="mt-2 text-3xl font-bold text-secondary-800">{{ $counts['resources'] }}</p>
                    <p class="text-sm font-medium text-secondary-800">Support services</p>
                </div>
                <div class="h-12 w-12 rounded-xl bg-green-100 text-success grid place-items-center">
                    <i class="fa-solid fa-database text-lg"></i>
                </div>
            </div>
        </div>

        <div class="smooth-card rounded-2xl bg-white p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-800">New Reports</p>
                    <p class="mt-2 text-3xl font-bold text-secondary-800">{{ $reportStats['new_24h'] }}</p>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-sm font-medium text-secondary-800">
                            7 days: <span class="font-semibold text-info">{{ $reportStats['new_7d'] }}</span>
                        </span>
                    </div>
                </div>
                <div class="h-12 w-12 rounded-xl bg-blue-100 text-info grid place-items-center">
                    <i class="fa-solid fa-bolt text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        {{-- New Reports (last 24h) --}}
        <div class="smooth-card rounded-2xl bg-white p-6 shadow-card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-semibold text-lg text-secondary-800 flex items-center gap-2">
                    <i class="fa-solid fa-clock text-info"></i>
                    New Reports (24h)
                </h2>
                <a href="{{ route('admin.reports.index', ['status'=>'pending']) }}"
                   class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                    View All
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            @if($newReports->isEmpty())
                <div class="py-8 text-center text-secondary-500">
                    <i class="fa-regular fa-flag text-3xl mb-3 opacity-50"></i>
                    <p>No new reports in the last 24 hours</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($newReports as $r)
                        <a href="{{ route('admin.reports.show', $r) }}"
                           class="block smooth-card rounded-xl border border-secondary-100 p-4 hover:border-primary-200 hover:bg-primary-50 transition-all group">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex-1">
                                    <div class="text-xs text-secondary-500">{{ $r->created_at->diffForHumans() }}</div>
                                    <div class="font-semibold text-secondary-800 group-hover:text-primary-700 transition-colors">
                                        {{ $r->reference ?? ('REP-'.$r->id) }}
                                    </div>
                                </div>
                                @php
                                    $badge = [
                                        'pending'   => 'bg-yellow-100 text-yellow-800',
                                        'in_review' => 'bg-blue-100 text-blue-800',
                                        'resolved'  => 'bg-green-100 text-green-800',
                                    ][$r->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full {{ $badge }} font-medium">
                                    {{ ucfirst(str_replace('_',' ',$r->status)) }}
                                </span>
                            </div>
                            <div class="text-sm text-secondary-600 line-clamp-2 mb-2">
                                {{ $r->description }}
                            </div>
                            <div class="flex items-center text-xs text-secondary-500">
                                <i class="fa-solid fa-location-dot mr-1"></i> 
                                {{ $r->location ?? 'Location not specified' }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Resource Summary --}}
        <div class="smooth-card rounded-2xl bg-white p-6 shadow-card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-semibold text-lg text-secondary-800 flex items-center gap-2">
                    <i class="fa-solid fa-hand-holding-heart text-success"></i>
                    Resource Summary
                </h2>
                <a href="{{ route('admin.resources.index') }}"
                   class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                    Manage
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="text-center p-4 rounded-xl bg-blue-50 border border-blue-100">
                    <div class="text-2xl font-bold text-info mb-1">{{ $counts['shelters'] }}</div>
                    <div class="text-xs text-secondary-600 font-medium">Shelters</div>
                </div>
                <div class="text-center p-4 rounded-xl bg-green-50 border border-green-100">
                    <div class="text-2xl font-bold text-success mb-1">{{ $counts['counselling'] }}</div>
                    <div class="text-xs text-secondary-600 font-medium">Counselling</div>
                </div>
                <div class="text-center p-4 rounded-xl bg-purple-50 border border-purple-100">
                    <div class="text-2xl font-bold text-secondary-700 mb-1">{{ $counts['legal'] }}</div>
                    <div class="text-xs text-secondary-600 font-medium">Legal Aid</div>
                </div>
            </div>
{{-- Inside dashboard where you want it --}}
<div class="bg-white/70 rounded-2xl p-5 shadow">
    <div class="flex items-center justify-between mb-3">
      <h3 class="font-semibold">Latest Feedback</h3>
      <a href="{{ route('admin.feedback.index') }}" class="text-brand-700 text-sm">View all</a>
    </div>
    <div class="space-y-3">
      @forelse(($recentFeedback ?? []) as $f)
        <a class="block rounded-lg border p-3 hover:bg-white" href="{{ route('admin.feedback.show', $f) }}">
          <div class="text-sm">
            <span class="font-medium">{{ $f->user->name ?? '—' }}</span>
            <span class="text-slate-500">rated</span>
            <span class="font-medium">{{ $f->rating ?? '—' }}/5</span>
            <span class="text-slate-400">· {{ $f->created_at->diffForHumans() }}</span>
          </div>
          @if($f->message)
            <div class="text-slate-600 text-sm line-clamp-2">{{ $f->message }}</div>
          @endif
        </a>
      @empty
        <div class="text-slate-500 text-sm">No recent feedback.</div>
      @endforelse
    </div>
  </div>
  
            {{-- Emergency Protocol --}}
            <div class="mt-6 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 border border-rose-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-danger text-white grid place-items-center flex-shrink-0">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold text-secondary-800 text-sm">Emergency Protocol</div>
                        <div class="text-xs text-secondary-600 mt-1">Call local authorities for urgent incidents</div>
                    </div>
                </div>
                <a href="tel:112" class="mt-3 w-full flex items-center justify-center gap-2 rounded-lg bg-danger px-4 py-2 text-white text-sm font-medium hover:bg-red-600 transition-colors">
                    <i class="fa-solid fa-phone"></i> 
                    Call Emergency Services
                </a>
            </div>
        </div>
    </div>

    {{-- Recent Reports Table --}}
    <div class="smooth-card rounded-2xl bg-white p-6 shadow-card mt-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-semibold text-lg text-secondary-800 flex items-center gap-2">
                <i class="fa-solid fa-list text-primary-600"></i>
                Recent Reports
            </h2>
            <a href="{{ route('admin.reports.index') }}"
               class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                View All Reports
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-secondary-50 text-secondary-600">
                <tr>
                    <th class="text-left px-4 py-3 font-medium rounded-l-xl">Reference</th>
                    <th class="px-4 py-3 font-medium">Category</th>
                    <th class="px-4 py-3 font-medium">Location</th>
                    <th class="px-4 py-3 font-medium">Submitted</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-right rounded-r-xl">Action</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-secondary-100">
                @forelse($recentReports as $r)
                    <tr class="hover:bg-secondary-50 transition-colors">
                        <td class="px-4 py-3 font-medium text-secondary-800">
                            {{ $r->reference ?? ('REP-'.$r->id) }}
                        </td>
                        <td class="px-4 py-3 capitalize text-secondary-700">{{ str_replace('_',' ', $r->category) }}</td>
                        <td class="px-4 py-3 text-secondary-600">{{ $r->location ?? '—' }}</td>
                        <td class="px-4 py-3 text-secondary-500">{{ $r->created_at->diffForHumans() }}</td>
                        <td class="px-4 py-3">
                            @php
                                $badge = [
                                    'pending'   => 'bg-yellow-100 text-yellow-800',
                                    'in_review' => 'bg-blue-100 text-blue-800',
                                    'resolved'  => 'bg-green-100 text-green-800',
                                ][$r->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs rounded-full {{ $badge }} font-medium">
                                {{ ucfirst(str_replace('_',' ',$r->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.reports.show', $r) }}"
                               class="inline-flex items-center gap-2 rounded-lg border border-secondary-200 px-3 py-1.5 text-xs font-medium text-secondary-700 hover:bg-white hover:border-primary-300 hover:text-primary-700 transition-all">
                                <i class="fa-regular fa-eye"></i> 
                                Open
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-secondary-500">
                            <i class="fa-regular fa-file-lines text-2xl mb-2 opacity-50"></i>
                            <p>No recent activity to display</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection