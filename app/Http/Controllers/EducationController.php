<?php

namespace App\Http\Controllers;

use App\Models\EducationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $items = EducationItem::query()
            ->when($q, fn($qq) => $qq->where('title','like',"%{$q}%")
                                     ->orWhere('body','like',"%{$q}%"))
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('education.index', compact('items', 'q'));
    }

    public function show(EducationItem $item)
    {
        // Public view — no auth required
        return view('education.show', compact('item'));
    }

    public function view(EducationItem $item)
    {
        abort_unless($item->download_path && Storage::disk('public')->exists($item->download_path), 404);

        $path = Storage::disk('public')->path($item->download_path);
        $mime = Storage::disk('public')->mimeType($item->download_path) ?? 'application/pdf';

        // Show in browser
        return response()->file($path, [
            'Content-Type'        => $mime,
            'Content-Disposition' => 'inline; filename="'.basename($path).'"',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function download(EducationItem $item)
    {
        abort_unless($item->download_path && Storage::disk('public')->exists($item->download_path), 404);

        // Force download
        return Storage::disk('public')->download($item->download_path, basename($item->download_path));
    }
}
