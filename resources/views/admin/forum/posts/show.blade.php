@extends('layouts.admin')

@section('title', $post->title.' • Forum • Admin')
@section('header','Moderate Post')
@section('subtitle',$post->title)

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
  {{-- Post --}}
  <article class="lg:col-span-2 glass rounded-2xl p-6 shadow">
    <div class="flex items-start justify-between">
      <div>
        <div class="text-sm text-slate-500 mb-1">
          by {{ $post->user->name ?? 'User' }} • {{ $post->created_at->diffForHumans() }}
          @if($post->updated_at->gt($post->created_at)) <span class="text-slate-400"> (edited)</span> @endif
        </div>
        <h1 class="text-xl font-bold">{{ $post->title }}</h1>
      </div>
      <form action="{{ route('admin.forum.posts.destroy',$post) }}" method="POST"
            onsubmit="return confirm('Delete this post and all its comments?')">
        @csrf @method('DELETE')
        <button class="rounded-lg bg-danger text-white px-3 py-2 text-sm">Delete Post</button>
      </form>
    </div>

    @if($post->media_image_path)
      <div class="mt-4">
        <img src="{{ asset('storage/'.$post->media_image_path) }}" alt="Post image" class="max-h-[420px] w-full rounded-xl object-cover">
      </div>
    @endif

    @if($post->media_video_url)
      <div class="mt-4 aspect-video">
        <iframe src="{{ $post->media_video_url }}" class="w-full h-full rounded-xl" frameborder="0" allowfullscreen></iframe>
      </div>
    @endif

    <div class="mt-4 text-slate-800 leading-relaxed whitespace-pre-line">{{ $post->body }}</div>
  </article>

  {{-- Meta --}}
  <div class="space-y-6">
    <div class="glass rounded-2xl p-6 shadow">
      <h3 class="font-semibold mb-2">Author</h3>
      <div class="text-sm">
        <div class="font-medium">{{ $post->user->name ?? 'User' }}</div>
        <div class="text-slate-500">{{ $post->user->email ?? '' }}</div>
      </div>
    </div>
    <a href="{{ route('admin.forum.posts.index') }}" class="inline-block rounded-lg border px-4 py-2">← Back to posts</a>
  </div>
</div>

{{-- Comments --}}
<section class="mt-8 glass rounded-2xl p-6 shadow">
  <h3 class="font-semibold mb-4">Comments ({{ $comments->total() }})</h3>

  @forelse($comments as $c)
    <div class="rounded-xl border bg-white p-4 mb-3">
      <div class="flex items-start justify-between">
        <div>
          <div class="text-sm text-slate-500">
            <span class="font-medium">{{ $c->user->name ?? 'User' }}</span>
            <span>•</span>
            <time datetime="{{ $c->created_at->toIso8601String() }}">{{ $c->created_at->diffForHumans() }}</time>
            @if($c->updated_at->gt($c->created_at)) <span class="text-slate-400"> (edited)</span> @endif
          </div>
          <div class="mt-1 text-slate-800 whitespace-pre-line">{{ $c->body }}</div>
        </div>
        <form action="{{ route('admin.forum.comments.destroy',$c) }}" method="POST"
              onsubmit="return confirm('Delete this comment?')">
          @csrf @method('DELETE')
          <button class="rounded-lg bg-danger text-white px-3 py-1.5 text-xs">Delete</button>
        </form>
      </div>
    </div>
  @empty
    <div class="text-slate-500">No comments yet.</div>
  @endforelse

  <div class="mt-4">
    {{ $comments->onEachSide(1)->links() }}
  </div>
</section>
@endsection
