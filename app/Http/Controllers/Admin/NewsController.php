<?php
// app/Http/Controllers/Admin/NewsController.php
// app/Http/Controllers/Admin/NewsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest('created_at')->paginate(12);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => ['required','string','max:255'],
            'slug'          => ['nullable','string','max:255','unique:news,slug'],
            'excerpt'       => ['nullable','string','max:5000'],
            'body'          => ['required','string'],
            'status'        => ['nullable','in:draft,published'], // we’ll always store as draft here unless explicitly changing
            'published_at'  => ['nullable','date'],
            'cover_image'   => ['nullable','image','max:4096'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']).'-'.Str::random(6);
        $data['status'] = 'draft';
        $data['author_id'] = auth('admin')->id();

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $request->file('cover_image')->store('news','public');
        }

        $news = News::create($data);

        // Redirect to edit with a publish prompt banner
        return redirect()
            ->route('admin.news.edit', $news)
            ->with('showPublishPrompt', true)
            ->with('status','Saved as draft. Publish when ready.');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'         => ['required','string','max:255'],
            'slug'          => ['required','string','max:255','unique:news,slug,'.$news->id],
            'excerpt'       => ['nullable','string','max:5000'],
            'body'          => ['required','string'],
            'status'        => ['nullable','in:draft,published'],
            'published_at'  => ['nullable','date'],
            'cover_image'   => ['nullable','image','max:4096'],
        ]);

        if ($request->hasFile('cover_image')) {
            if ($news->cover_image_path) Storage::disk('public')->delete($news->cover_image_path);
            $data['cover_image_path'] = $request->file('cover_image')->store('news','public');
        }

        // Keep status as-is unless admin explicitly changed it on the edit form
        $news->update($data);

        return back()->with('status', 'News updated.');
    }

    // NEW: Publish action
    public function publish(News $news)
    {
        $news->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return back()->with('status', 'News published. It is now visible on the Home page and Dashboard.');
    }

    public function destroy(News $news)
    {
        if ($news->cover_image_path) {
            Storage::disk('public')->delete($news->cover_image_path);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('status', 'News deleted.');
    }
}
