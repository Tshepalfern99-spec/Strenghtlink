<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EducationController extends Controller
{
    /** List items (admin sees all, optional q= search) */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $items = EducationItem::query()
            ->when($q !== '', function ($qq) use ($q) {
                $qq->where(function ($w) use ($q) {
                    $w->where('title', 'like', "%{$q}%")
                      ->orWhere('body', 'like', "%{$q}%")
                      ->orWhere('category', 'like', "%{$q}%");
                });
            })
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.education.index', compact('items', 'q'));
    }

    /** Create form */
    public function create()
    {
        return view('admin.education.create');
    }

    /** Store new item */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255', 'unique:education_items,slug'],
            'category'    => ['nullable', 'string', 'max:100'], // Awareness/Rights/Services
            'type'        => ['nullable', Rule::in(['article','video','infographic','download'])],
            'body'        => ['nullable', 'string'],
            'video_url'   => ['nullable', 'url', 'max:500'],
            'cover'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:4096'],
            'download'    => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip', 'max:20480'],
            'publish_now' => ['nullable', 'boolean'],
        ]);

        // Files → public disk
        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('education/covers', 'public')
            : null;

        $downloadPath = $request->hasFile('download')
            ? $request->file('download')->store('education/downloads', 'public')
            : null;

        // Slug
        $slug = $data['slug'] ?? $this->makeUniqueSlug($data['title']);
        $videoUrl = trim((string)($data['video_url'] ?? ''));
        $item = EducationItem::create([
            'title'           => $data['title'],
            'slug'            => $slug,
            'category'        => $data['category'] ?? null,
            'type'            => $data['type'] ?? 'article',
            'body'            => $data['body'] ?? null,
            'video_url'       => $videoUrl !== '' && $videoUrl !== '?' ? $videoUrl : null,
            'cover_path'      => $coverPath,
            'download_path'   => $downloadPath,
            'author_admin_id' => auth('admin')->id(),
            'published_at'    => $request->boolean('publish_now') ? now() : null,
        ]);

        return redirect()
            ->route('admin.education.show', $item)
            ->with('status', 'Education item created.' . ($request->boolean('publish_now') ? ' Published.' : ''));
    }

    /** Show one item */
    public function show(EducationItem $education)
    {
        return view('admin.education.show', ['item' => $education]);
    }

    /** Edit form */
    public function edit(EducationItem $education)
    {
        return view('admin.education.edit', ['item' => $education]);
    }

    /** Update item */
    public function update(Request $request, EducationItem $education)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255', Rule::unique('education_items','slug')->ignore($education->id)],
            'category'    => ['nullable', 'string', 'max:100'],
            'type'        => ['nullable', Rule::in(['article','video','infographic','download'])],
            'body'        => ['nullable', 'string'],
            'video_url'   => ['nullable', 'url', 'max:500'],
            'cover'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:4096'],
            'download'    => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip', 'max:20480'],
            'publish_now' => ['nullable', 'boolean'],
            'unpublish'   => ['nullable', 'boolean'],
        ]);

        // Replace cover?
        if ($request->hasFile('cover')) {
            if ($education->cover_path && Storage::disk('public')->exists($education->cover_path)) {
                Storage::disk('public')->delete($education->cover_path);
            }
            $education->cover_path = $request->file('cover')->store('education/covers', 'public');
        }

        // Replace download?
        if ($request->hasFile('download')) {
            if ($education->download_path && Storage::disk('public')->exists($education->download_path)) {
                Storage::disk('public')->delete($education->download_path);
            }
            $education->download_path = $request->file('download')->store('education/downloads', 'public');
        }

        // Slug (keep supplied; otherwise rebuild from new title if slug was empty)
        $slug = $data['slug'] ?? $this->makeUniqueSlug($data['title'], $education->id);
        $videoUrl = trim((string)($data['video_url'] ?? ''));
        $education->fill([
            'title'        => $data['title'],
            'slug'         => $slug,
            'category'     => $data['category'] ?? null,
            'type'         => $data['type'] ?? $education->type,
            'body'         => $data['body'] ?? null,
            'video_url' => $videoUrl !== '' && $videoUrl !== '?' ? $videoUrl : null,
        ]);

        if ($request->boolean('publish_now')) {
            $education->published_at = now();
        }
        if ($request->boolean('unpublish')) {
            $education->published_at = null;
        }

        $education->save();

        return redirect()
            ->route('admin.education.show', $education)
            ->with('status', 'Education item updated.');
    }

    /** Delete item (and its files) */
    public function destroy(EducationItem $education)
    {
        if ($education->cover_path && Storage::disk('public')->exists($education->cover_path)) {
            Storage::disk('public')->delete($education->cover_path);
        }
        if ($education->download_path && Storage::disk('public')->exists($education->download_path)) {
            Storage::disk('public')->delete($education->download_path);
        }

        $education->delete();

        return redirect()
            ->route('admin.education.index')
            ->with('status', 'Education item deleted.');
    }

    /** Quick actions */
    public function publish(EducationItem $education)
    {
        $education->published_at = now();
        $education->save();

        return back()->with('status', 'Published.');
    }

    public function unpublish(EducationItem $education)
    {
        $education->published_at = null;
        $education->save();

        return back()->with('status', 'Unpublished.');
    }

    /** Public-disk download with friendly filename */
    public function download(EducationItem $education)
    {
        if ($education->download_path && Storage::disk('public')->exists($education->download_path)) {
            $ext = pathinfo($education->download_path, PATHINFO_EXTENSION);
            $filename = Str::slug($education->title ?: 'education-item') . ($ext ? ".{$ext}" : '');
            return Storage::disk('public')->download($education->download_path, $filename);
        }
        abort(404);
    }

    /**
     * Make a unique slug based on title.
     * If $ignoreId provided, it will be ignored for uniqueness (for updates).
     */
    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'item';
        $slug = $base;

        $exists = function ($candidate) use ($ignoreId) {
            $query = EducationItem::where('slug', $candidate);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            return $query->exists();
        };

        $i = 2;
        while ($exists($slug)) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }
}
