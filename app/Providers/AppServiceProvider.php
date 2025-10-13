<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //MailMessage::defaultView('notifications::email'); // keeps default
    config(['queue.default' => env('QUEUE_CONNECTION', 'sync')]);
    }
}
