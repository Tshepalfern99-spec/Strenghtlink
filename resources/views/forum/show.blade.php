<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $post->title }} - Community Forum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary:   { 50:'#fdf2f8',100:'#fce7f3',200:'#fbcfe8',300:'#f9a8d4',400:'#f472b6',500:'#ec4899',600:'#db2777',700:'#be185d',800:'#9d174d',900:'#831843'},
              secondary: { 50:'#f8fafc',100:'#f1f5f9',200:'#e2e8f0',300:'#cbd5e1',400:'#94a3b8',500:'#64748b',600:'#475569',700:'#334155',800:'#1e293b',900:'#0f172a'}
            },
            boxShadow: {
              soft:'0 2px 15px -3px rgba(0,0,0,.07), 0 10px 20px -2px rgba(0,0,0,.04)',
              glow:'0 0 20px rgba(236,72,153,.15)',
              card:'0 4px 25px -5px rgba(0,0,0,.1), 0 10px 10px -5px rgba(0,0,0,.04)'
            },
            keyframes: {
              fadeIn:{'0%':{opacity:'0',transform:'translateY(10px)'},'100%':{opacity:'1',transform:'translateY(0)'}},
              slideIn:{'0%':{transform:'translateX(-100%)'},'100%':{transform:'translateX(0)'}}
            },
            animation:{'fade-in':'fadeIn .5s ease-in-out','slide-in':'slideIn .3s ease-out'}
          }
        }
      }
    </script>
    <style>
      body{font-family:'Inter',sans-serif;background:linear-gradient(135deg,#fdf2f8 0%,#f8fafc 50%,#f0f9ff 100%);min-height:100vh;}
      .glass{background:rgba(255,255,255,.85);backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.3);}
      .comment-item{transition:all .25s ease;}
      .comment-item:hover{transform:translateX(4px);}
      .comment-children{margin-left:1rem;border-left:2px solid #eee;padding-left:1rem;}
      .action-link{font-size:.75rem;color:#4f46e5}
      .action-link:hover{text-decoration:underline}
    </style>
</head>
<body class="antialiased">

  <div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="hidden md:block w-72 p-6">
      <div class="sticky top-6 space-y-3">
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition mb-1">
          <div class="w-8 h-8 rounded-lg bg-primary-50 grid place-items-center mr-3">
            <i class="fas fa-home text-primary-600"></i>
          </div>
          <span class="font-medium">Dashboard</span>
        </a>
        <a href="{{ route('resources.index') }}" class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition mb-1">
          <div class="w-8 h-8 rounded-lg bg-blue-50 grid place-items-center mr-3">
            <i class="fas fa-database text-blue-600"></i>
          </div>
          <span class="font-medium">Find Resources</span>
        </a>
        <a href="{{ route('report.create') }}" class="flex items-center px-4 py-3 bg-primary-50 text-primary-600 rounded-xl transition mb-1">
          <div class="w-8 h-8 rounded-lg bg-primary-100 grid place-items-center mr-3">
            <i class="fas fa-flag text-primary-600"></i>
          </div>
          <span class="font-medium">Report Incident</span>
        </a>
        <a href="{{ route('news.index') }}" class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition mb-1">
          <div class="w-8 h-8 rounded-lg bg-purple-50 grid place-items-center mr-3">
            <i class="fas fa-newspaper text-purple-600"></i>
          </div>
          <span class="font-medium">News & Updates</span>
        </a>
        <a href="{{ route('forum.index') }}" class="flex items-center px-4 py-3 text-secondary-600 hover:bg-primary-50 rounded-xl transition mb-1">
          <div class="w-8 h-8 rounded-lg bg-green-50 grid place-items-center mr-3">
            <i class="fas fa-comments text-green-600"></i>
          </div>
          <span class="font-medium">Community Forum</span>
        </a>

        <div class="px-4 pt-3">
          <div class="glass rounded-xl p-4">
            <div class="flex items-center">
              <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-400 to-primary-600 grid place-items-center text-white font-bold">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-secondary-800">{{ auth()->user()->name ?? 'User' }}</p>
                <p class="text-xs text-secondary-500">Member</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Header -->
      <header class="glass border-b border-gray-100 py-4 px-6">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-xl font-semibold text-secondary-800">Community Forum</h1>
            <p class="text-sm text-secondary-500 mt-1">Discussion & Community Support</p>
          </div>
          <div class="flex items-center space-x-4">
            <button class="p-2 rounded-full bg-white shadow-soft text-secondary-500 hover:text-primary-600 transition-colors">
              <i class="fas fa-bell"></i>
            </button>
            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-primary-400 to-primary-600 grid place-items-center text-white font-bold text-sm">
              {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
          </div>
        </div>
      </header>

      <!-- Content -->
      <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-4xl mx-auto">

          <!-- Back -->
          <div class="mb-6">
            <a href="{{ route('forum.index') }}" class="inline-flex items-center text-sm text-secondary-600 hover:text-primary-600 transition-colors">
              <i class="fas fa-arrow-left mr-2"></i> Back to Forum
            </a>
          </div>

          <!-- Post -->
          <article class="bg-white rounded-2xl shadow-card overflow-hidden animate-fade-in mb-8">
            <div class="border-b border-gray-100 p-6">
              <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-400 to-primary-600 grid place-items-center text-white font-bold text-sm mr-3">
                    {{ substr($post->user->name ?? 'A', 0, 1) }}
                  </div>
                  <div>
                    <p class="font-medium text-secondary-800">{{ $post->user->name ?? 'Anonymous' }}</p>
                    <div class="flex items-center text-xs text-secondary-500">
                      <i class="fas fa-clock mr-1"></i>
                      <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->diffForHumans() }}</time>
                      @if($post->updated_at->gt($post->created_at))
                        <span class="ml-2 text-secondary-400"><i class="fas fa-edit mr-1"></i>edited</span>
                      @endif
                    </div>
                  </div>
                </div>

                @php
                  $isOwner = auth('web')->id() === $post->user_id;
                  $isAdmin = auth('admin')->check();
                @endphp
                @if($isOwner || $isAdmin)
                  <div class="flex items-center gap-2">
                    <a href="{{ route('forum.edit', $post) }}"
                       class="inline-flex items-center rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-4 py-2 text-sm font-medium text-white hover:shadow-glow transition-all duration-200">
                      <i class="fas fa-edit mr-2"></i> Edit Post
                    </a>
                    <form action="{{ route('forum.destroy', $post) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this post?')">
                      @csrf @method('DELETE')
                      <button class="inline-flex items-center rounded-xl bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 transition-all duration-200">
                        <i class="fas fa-trash mr-2"></i> Delete
                      </button>
                    </form>
                  </div>
                @endif
              </div>

              <h1 class="text-2xl font-bold text-secondary-800 leading-tight">{{ $post->title }}</h1>
            </div>

            <div class="p-6">
              @if($post->media_image_path)
                <img
                  src="{{ asset('storage/'.$post->media_image_path) }}"
                  alt="{{ $post->title }} image"
                  class="mb-4 max-h-[420px] w-full rounded-lg object-cover">
              @endif

              @if($post->media_video_url)
                <div class="mb-4 aspect-video">
                  <iframe src="{{ $post->media_video_url }}"
                          class="h-full w-full rounded-lg"
                          frameborder="0" allowfullscreen></iframe>
                </div>
              @endif

              <div class="prose max-w-none text-secondary-700">{!! nl2br(e($post->body)) !!}</div>
            </div>
          </article>

      {{-- Comments list --}}
<div class="space-y-4">
    @forelse($comments as $comment)
      @include('forum.partials.comment', ['comment' => $comment, 'post' => $post])
    @empty
      <div class="bg-white rounded-2xl shadow-soft p-8 text-center">
        <div class="w-16 h-16 rounded-full bg-primary-50 grid place-items-center mx-auto mb-4">
          <i class="fas fa-comment-dots text-primary-500 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-secondary-800 mb-2">No comments yet</h3>
        <p class="text-secondary-600 max-w-md mx-auto">Be the first to share your thoughts.</p>
      </div>
    @endforelse
  </div>
  

  <script>
    function toggleReplyForm(id, show) {
      const el = document.getElementById('comment-reply-' + id);
      if (!el) return;
      if (typeof show === 'boolean') { el.classList.toggle('hidden', !show); return; }
      el.classList.toggle('hidden');
    }
    function toggleEditForm(id, show) {
      const form = document.getElementById('comment-edit-' + id);
      const body = document.getElementById('comment-body-' + id);
      if (!form || !body) return;
      if (typeof show === 'boolean') {
        form.classList.toggle('hidden', !show);
        body.classList.toggle('hidden', show);
        return;
      }
      const willShow = form.classList.contains('hidden');
      form.classList.toggle('hidden', !willShow ? true : false);
      body.classList.toggle('hidden', !willShow ? false : true);
    }
    // Simple stagger on load
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.comment-item').forEach((el,i) => {
        el.style.opacity = 0; el.style.transform='translateX(-12px)';
        setTimeout(()=>{el.style.transition='all .45s ease'; el.style.opacity=1; el.style.transform='translateX(0)';}, i*60);
      });
    });
  </script>
</body>
</html>
