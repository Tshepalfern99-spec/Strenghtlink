<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumPost;
use App\Models\ForumComment;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * List posts with filters.
     */
    public function index(Request $request)
    {
        $q      = $request->string('q')->toString();
        $author = $request->string('author')->toString();

        $posts = ForumPost::with(['user'])
            ->when($q, fn($qq) => $qq->where(function($w) use ($q) {
                $w->where('title','like',"%{$q}%")
                  ->orWhere('body','like',"%{$q}%");
            }))
            ->when($author, fn($qq) => $qq->whereHas('user', fn($u)=>$u->where('name','like',"%{$author}%")->orWhere('email','like',"%{$author}%")))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total'    => ForumPost::count(),
            'last7'    => ForumPost::where('created_at','>=',now()->subDays(7))->count(),
            'comments' => ForumComment::count(),
        ];

        return view('admin.forum.posts.index', compact('posts','stats'));
    }

    /**
     * Show a post with its comments.
     */
    public function show(ForumPost $post)
    {
        $post->load(['user']);
        $comments = ForumComment::with('user')
            ->where('post_id',$post->id)
            ->latest()
            ->paginate(15);

        return view('admin.forum.posts.show', compact('post','comments'));
    }

    /**
     * Delete a post (and cascade/delete comments via FK or manual).
     */
    public function destroy(ForumPost $post)
    {
        // If your FK isn't ON DELETE CASCADE, delete comments first.
        ForumComment::where('post_id',$post->id)->delete();
        $post->delete();

        return redirect()
            ->route('admin.forum.posts.index')
            ->with('status','Post removed.');
    }

    /**
     * Delete a single comment.
     */
    public function destroyComment(ForumComment $comment)
    {
        $postId = $comment->post_id;
        $comment->delete();

        return back()->with('status','Comment removed.');
    }
}
