<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\EducationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EducationBrowseController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $category = $request->string('category')->toString();
        $type = $request->string('type')->toString();

        $items = EducationItem::published()
            ->when($q, fn($qq) => $qq->where(function($w) use ($q) {
                $w->where('title','like',"%$q%")
                  ->orWhere('body','like',"%$q%");
            }))
            ->when($category, fn($qq) => $qq->where('category',$category))
            ->when($type, fn($qq) => $qq->where('type',$type))
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('education.index', [
            'items' => $items,
            'q' => $q,
            'category' => $category,
            'type' => $type,
        ]);
    }

    public function show(string $slug)
    {
        $item = EducationItem::published()->where('slug',$slug)->firstOrFail();
        return view('education.show', compact('item'));
    }

    public function download(EducationItem $item): StreamedResponse
    {
        abort_unless($item->download_path && Storage::disk('public')->exists($item->download_path), 404);

        $disk = Storage::disk('public');
        $path = $item->download_path;
        $filename = basename($path);
        $mime = $disk->mimeType($path) ?? 'application/octet-stream';

        return response()->streamDownload(function() use ($disk, $path) {
            echo $disk->get($path);
        }, $filename, [
            'Content-Type' => $mime,
            'Cache-Control' => 'private, max-age=0, must-revalidate',
        ]);
    }
}
