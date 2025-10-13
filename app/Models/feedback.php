<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'user_id', 'report_id', 'rating', 'message'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function report()
    {
        return $this->belongsTo(\App\Models\Report::class);
    }

    /* Simple scopes for filtering */
    public function scopeSearch($q, ?string $term)
    {
        if (!$term) return $q;
        return $q->where(function ($qq) use ($term) {
            $qq->where('message', 'like', "%{$term}%")
               ->orWhereHas('user', fn($u)=>$u->where('name','like',"%{$term}%")->orWhere('email','like',"%{$term}%"))
               ->orWhereHas('report', fn($r)=>$r->where('id', $term)->orWhere('reference','like',"%{$term}%"));
        });
    }

    public function scopeRating($q, ?int $rating)
    {
        if (!$rating) return $q;
        return $q->where('rating', $rating);
    }

    public function scopeDateRange($q, ?string $from, ?string $to)
    {
        if ($from) $q->where('created_at', '>=', $from.' 00:00:00');
        if ($to)   $q->where('created_at', '<=', $to.' 23:59:59');
        return $q;
    }
}
