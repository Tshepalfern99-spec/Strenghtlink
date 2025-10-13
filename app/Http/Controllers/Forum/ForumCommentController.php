<?php

// app/Http/Controllers/Forum/ForumCommentController.php
// app/Http/Controllers/Forum/ForumCommentController.php
namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\ForumPost;
use App\Models\ForumComment;
use Illuminate\Http\Request;

class ForumCommentController extends Controller
{
    // Create top-level comment
    public function store(Request $request, ForumPost $post)
    {
        $data = $request->validate([
            'body' => ['required','string','max:3000'],
        ]);

        ForumComment::create([
            'post_id' => $post->id,
            'user_id' => auth('web')->id() ?? auth('admin')->id(),
            'body'    => $data['body'],
            'parent_id' => null,
        ]);

        return back()->with('status', 'Comment published.');
    }

    // Reply to an existing comment
    public function reply(Request $request, ForumPost $post, ForumComment $comment)
    {
        abort_unless($comment->post_id === $post->id, 404);

        $data = $request->validate([
            'body' => ['required','string','max:3000'],
        ]);

        ForumComment::create([
            'post_id'  => $post->id,
            'user_id'  => auth('web')->id() ?? auth('admin')->id(),
            'body'     => $data['body'],
            'parent_id'=> $comment->id, // ✅ reply
        ]);

        return back()->with('status', 'Reply posted.');
    }

    // Update own comment (or admin)
    public function update(Request $request, ForumComment $comment)
    {
        $this->authorizeComment($comment);

        $data = $request->validate([
            'body' => ['required','string','max:3000'],
        ]);

        $comment->update(['body' => $data['body']]);

        return back()->with('status', 'Comment updated.');
    }

    // Delete own comment (or admin)
    public function destroy(ForumComment $comment)
    {
        $this->authorizeComment($comment);

        $comment->delete();

        return back()->with('status','Comment deleted.');
    }

    private function authorizeComment(ForumComment $comment): void
    {
        // Admin can do anything
        if (auth('admin')->check()) return;

        // Otherwise must be the comment owner (web guard)
        if (auth('web')->id() !== $comment->user_id) {
            abort(403, 'Not allowed.');
        }
    }
}
