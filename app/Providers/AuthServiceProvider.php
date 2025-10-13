<?php 
// app/Providers/AuthServiceProvider.php
namespace App\Providers;

use App\Models\ForumPost;
use App\Models\ForumComment;
use App\Policies\ForumPostPolicy;
use App\Policies\ForumCommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ForumPost::class    => ForumPostPolicy::class,
        ForumComment::class => ForumCommentPolicy::class,
    ];
    public function boot(): void {}
}
