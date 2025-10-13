<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with('user')->latest()->paginate(12);
        return view('forum.index', compact('posts'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => ['required','string','max:200'],
            'body'      => ['required','string'],
            'image'     => ['nullable','image','max:4096'],
            'media_video_url' => ['nullable','url','max:500'], // <-- field name matches DB
        ]);
    
        $mediaPath = null;
        if ($request->hasFile('image')) {
            $mediaPath = $request->file('image')->store('forum', 'public'); // requires storage:link
        }
    
        $post = \App\Models\ForumPost::create([
            'user_id'           => auth('web')->id() ?? auth('admin')->id(),
            'title'             => $data['title'],
            'body'              => $data['body'],
            'media_image_path'  => $mediaPath,
            'media_video_url'   => $data['media_video_url'] ?? null, // <-- correct column
        ]);
    
        return redirect()->route('forum.show', $post)->with('status','Post published.');
    }

  // ForumPostController@show
public function show(\App\Models\ForumPost $post)
{
    $comments = $post->comments() // top-level only
        ->with([
            'user',
            'children.user',
            'children.children.user', // nest deeper if you like
        ])
        ->latest()
        ->paginate(10);

    return view('forum.show', compact('post','comments'));
}

    

    public function edit(ForumPost $post)
    {
        $this->authorize('update', $post); // optional if you have policies
        return view('forum.edit', compact('post'));
    }

    public function update(Request $request, \App\Models\ForumPost $post)
{
    $this->authorize('update', $post);

    $data = $request->validate([
        'title'     => ['required','string','max:200'],
        'body'      => ['required','string'],
        'image'     => ['nullable','image','max:4096'],
        'media_video_url' => ['nullable','url','max:500'],
    ]);

    if ($request->hasFile('image')) {
        $post->media_image_path = $request->file('image')->store('forum','public');
    }

    $post->title           = $data['title'];
    $post->body            = $data['body'];
    $post->media_video_url = $data['media_video_url'] ?? null; // <-- correct column
    $post->save();

    return redirect()->route('forum.show', $post)->with('status','Post updated.');
}

    public function destroy(ForumPost $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('forum.index')->with('status','Post deleted.');
    }
}
