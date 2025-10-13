<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'status', 'published_at', 'author_id',
        'cover_image_path'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Only show items that are published (status = 'published' and date in past)
    public function scopePublished(Builder $q): Builder
    {
        return $q->where('status', 'published')
                 ->where('published_at', '<=', now());
    }
    public function coverUrl(): string
    {
        return $this->cover_image_path
            ? asset('storage/'.$this->cover_image_path)
            : asset('images/news-placeholder.jpg');
    }
}

