<?php

// app/Models/EducationItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EducationItem extends Model
{
    protected $fillable = [
        'title','slug','category','type','body',
        'cover_path','video_url','download_path',
        'published_at','author_admin_id',
    ];

    protected $casts = ['published_at' => 'datetime'];

    protected $appends = ['cover_url','download_url','is_pdf'];

    /* ----------------------- Accessors ----------------------- */
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_path && Storage::disk('public')->exists($this->cover_path)
            ? Storage::disk('public')->url($this->cover_path)
            : null;
    }

    public function getDownloadUrlAttribute(): ?string
    {
        return $this->download_path && Storage::disk('public')->exists($this->download_path)
            ? route('education.download', $this)
            : null;
    }

    public function getIsPdfAttribute(): bool
    {
        if (!$this->download_path) return false;
        $mime = @Storage::disk('public')->mimeType($this->download_path) ?: '';
        return str_contains($mime, 'pdf') || str_ends_with(strtolower($this->download_path), '.pdf');
    }

    /* ----------------------- Scopes -------------------------- */
    // Use this wherever you want only items visible to the public
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Handy helper if you sort by newest published
    public function scopeLatestPublished($query)
    {
        return $query->published()->orderByDesc('published_at');
    }
}
