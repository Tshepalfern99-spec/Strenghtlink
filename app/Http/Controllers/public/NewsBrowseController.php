<?php 
// app/Http/Controllers/Public/NewsBrowseController.php
// app/Http/Controllers/Public/NewsBrowseController.php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsBrowseController extends Controller
{
    public function index()
    {
        $news = News::where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(9);

        return view('public.news.index', compact('news'));
    }

    public function show(string $slug)
    {
        $news = News::where('slug', $slug)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        // For “More like this”
        $more = News::where('status', 'published')
            ->where('published_at', '<=', now())
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('public.news.show', compact('news', 'more'));
    }
}

