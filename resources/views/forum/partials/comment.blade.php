{{-- resources/views/forum/partials/comment.blade.php --}}
@php
  $isOwner     = (auth('web')->id() === ($comment->user_id ?? null));
  $isAdmin     = auth('admin')->check();
  $canModerate = $isAdmin || $isOwner;
@endphp

<div class="comment-item bg-white rounded-2xl shadow-soft p-5 border-l-4 border-primary-400">
  <div class="flex items-start justify-between mb-2">
    <div class="flex items-center">
      <div class="w-8 h-8 rounded-full bg-gradient-to-r from-secondary-400 to-secondary-600 grid place-items-center text-white font-bold text-xs mr-3">
        {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
      </div>
      <div>
        <p class="font-medium text-secondary-800 text-sm">{{ $comment->user->name ?? 'User' }}</p>
        <div class="flex items-center text-xs text-secondary-500">
          <i class="fas fa-clock mr-1"></i>
          <time datetime="{{ $comment->created_at->toIso8601String() }}">{{ $comment->created_at->diffForHumans() }}</time>
          @if($comment->updated_at->gt($comment->created_at))
            <span class="ml-2 text-secondary-400"><i class="fas fa-edit mr-1"></i>edited</span>
          @endif
        </div>
      </div>
    </div>

    <div class="flex items-center gap-3">
      <button type="button" class="action-link" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>

      @if($canModerate)
        <button type="button" class="action-link" onclick="toggleEditForm({{ $comment->id }})">Edit</button>
        <form action="{{ route('forum.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Delete this comment?')" class="inline">
          @csrf @method('DELETE')
          <button class="action-link text-red-600" type="submit">Delete</button>
        </form>
      @endif
    </div>
  </div>

  {{-- Body --}}
  <div id="comment-body-{{ $comment->id }}" class="text-secondary-700 leading-relaxed">
    {!! nl2br(e($comment->body)) !!}
  </div>

  {{-- Edit form --}}
  @if($canModerate)
  <form id="comment-edit-{{ $comment->id }}" class="hidden mt-3"
        action="{{ route('forum.comments.update', $comment) }}" method="POST">
    @csrf @method('PUT')
    <textarea name="body" rows="3" class="w-full rounded-md border-gray-300 focus:border-primary-400 focus:ring-2 focus:ring-primary-200">{{ old('body', $comment->body) }}</textarea>
    <div class="mt-2 flex items-center gap-2">
      <button class="inline-flex items-center rounded-md bg-primary-600 px-3 py-1.5 text-xs text-white hover:bg-primary-700">Save</button>
      <button type="button" class="text-xs text-secondary-600" onclick="toggleEditForm({{ $comment->id }}, false)">Cancel</button>
    </div>
  </form>
  @endif

  {{-- Reply form --}}
  @if(auth()->check() || auth('admin')->check())
  <form id="comment-reply-{{ $comment->id }}" class="hidden mt-3"
        action="{{ route('forum.comments.reply', ['post'=>$post->id, 'comment'=>$comment->id]) }}" method="POST">
    @csrf
    <textarea name="body" rows="3" class="w-full rounded-md border-gray-300 focus:border-primary-400 focus:ring-2 focus:ring-primary-200" placeholder="Write a reply…">{{ old('body') }}</textarea>
    <div class="mt-2 flex items-center gap-2">
      <button class="inline-flex items-center rounded-md bg-primary-600 px-3 py-1.5 text-xs text-white hover:bg-primary-700">Reply</button>
      <button type="button" class="text-xs text-secondary-600" onclick="toggleReplyForm({{ $comment->id }}, false)">Cancel</button>
    </div>
  </form>
  @endif

  {{-- Children --}}
  @if($comment->children && $comment->children->count())
    <div class="comment-children mt-4 space-y-3">
      @foreach($comment->children as $child)
        @include('forum.partials.comment', ['comment' => $child, 'post' => $post])
      @endforeach
    </div>
  @endif
</div>
