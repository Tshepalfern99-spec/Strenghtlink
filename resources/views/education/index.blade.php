@extends('layouts.public')
@section('title','Education')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Educational Initiatives</h1>

    <form method="GET" class="flex gap-2">
      <input type="text" name="q" value="{{ $q }}" placeholder="Search…" class="rounded border px-3 py-2">
      <select name="category" class="rounded border px-3 py-2">
        <option value="">All Categories</option>
        @foreach(['awareness'=>'Awareness','rights'=>'Rights','services'=>'Services','other'=>'Other'] as $val=>$label)
          <option value="{{ $val }}" @selected($category===$val)>{{ $label }}</option>
        @endforeach
      </select>
      <select name="type" class="rounded border px-3 py-2">
        <option value="">All Types</option>
        @foreach(['article'=>'Article','video'=>'Video','infographic'=>'Infographic','quiz'=>'Quiz','download'=>'Download'] as $val=>$label)
          <option value="{{ $val }}" @selected($type===$val)>{{ $label }}</option>
        @endforeach
      </select>
      <button class="rounded bg-rose-600 text-white px-3 py-2">Filter</button>
    </form>
  </div>

  @if($items->isEmpty())
    <div class="rounded border bg-white p-6 text-gray-600">No education items found.</div>
  @else
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @foreach($items as $it)
        <a href="{{ route('education.show',$it->slug) }}"
           class="block rounded-lg overflow-hidden border bg-white hover:shadow transition">
          @if($it->cover_url)
            <img src="{{ $it->cover_url }}" alt="{{ $it->title }} cover" class="h-40 w-full object-cover">
          @endif
          <div class="p-4">
            <div class="text-xs text-gray-500 uppercase">{{ ucfirst($it->category) }} • {{ ucfirst($it->type) }}</div>
            <div class="mt-1 font-semibold line-clamp-2">{{ $it->title }}</div>
            @if($it->published_at)
              <div class="text-xs text-gray-500 mt-1">{{ $it->published_at->format('M d, Y') }}</div>
            @endif
          </div>
        </a>
      @endforeach
    </div>

    <div class="mt-6">
      {{ $items->onEachSide(1)->links() }}
    </div>
  @endif
@endsection
