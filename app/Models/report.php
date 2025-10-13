<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id','is_anonymous','category','description','location_text','status','contact_email',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    public function user() { return $this->belongsTo(User::class); }
}
