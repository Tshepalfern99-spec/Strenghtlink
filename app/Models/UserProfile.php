<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'display_name', 'is_private', 'city', 'province', 'phone',
    ];

    protected $casts = [
        'is_private' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
