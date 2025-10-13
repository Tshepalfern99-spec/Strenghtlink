<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
class User extends Authenticatable implements MustVerifyEmailContract
{
    
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    protected static function booted(): void
    {
        static::created(function ($user) {
            $user->profile()->create(); // auto-make empty profile on sign-up
        });
    }
}
