<?php

// app/Http/Controllers/LandingController.php
namespace App\Http\Controllers;

use App\Models\News;

class LandingController extends Controller
{
    public function welcome()
    {
        $latestNews = News::published()
            ->latest('published_at')
            ->take(8)
            ->get();

        return view('welcome', compact('latestNews'));
    }
}
