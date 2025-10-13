<?php 
// app/Models/ForumPost.php
namespace App\Models;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumPost extends Model
{
    protected $fillable = ['user_id','title','body','media_image_path','media_video_url','visibility'];
    
    public function getMediaUrlAttribute(): ?string
    {
        if (!$this->media_image_path) {
            return null;
        }

        // Normalize backslashes (Windows) -> forward slashes
        $path = str_replace('\\', '/', ltrim($this->media_image_path, '/'));

        // If using the "public" disk locally (default)
        if (config('filesystems.disks.public')) {
            // Works when `php artisan storage:link` has been run
            return asset('storage/' . $path);
        }

        // Fallback: let the current default disk generate a URL (S3, etc.)
        if (Storage::exists($path)) {
            return Storage::url($path);
        }

        return null;
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }

    public function comments(): HasMany { return $this->hasMany(ForumComment::class, 'post_id')-> whereNull('parent_id')
        ->latest();
     }

    public function imageUrl(): ?string
    {
        return $this->media_image_path ? asset('storage/'.$this->media_image_path) : null;
    }

    public function isYouTube(): bool
    {
        return $this->media_video_url && str_contains(parse_url($this->media_video_url, PHP_URL_HOST) ?? '', 'youtube');
    }

    public function isVimeo(): bool
    {
        return $this->media_video_url && str_contains(parse_url($this->media_video_url, PHP_URL_HOST) ?? '', 'vimeo');
    }
}
