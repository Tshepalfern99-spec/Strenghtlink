<?php 
// app/Models/ForumComment.php
// app/Models/ForumComment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    protected $fillable = ['post_id','user_id','body','parent_id'];

    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class); // user table
    }

    public function parent()
    {
        return $this->belongsTo(ForumComment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ForumComment::class, 'parent_id')->latest();
    }
}
