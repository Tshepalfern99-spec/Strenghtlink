<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Resource;
use App\Models\Report;
use Illuminate\Support\Carbon;
// AdminController
use App\Models\News;
// ...


class AdminController extends Controller
{
    public function dashboard()
    {
        // Totals
        $counts = [
            'feedback'   => Feedback::count(),
            $avgFeedback        = round(Feedback::whereNotNull('rating')->avg('rating') ?? 0, 2),
$recentFeedback     = Feedback::latest()->take(5)->with(['user','report'])->get(),
            'users'      => User::count(),
            'reports'    => Report::count(),
            'resources'  => Resource::count(),

            // You said resources has only `name`, so use LIKE matching:
            'shelters'    => Resource::where('name', 'like', '%shelter%')->count(),
            'counselling' => Resource::where('name', 'like', '%counsel%')  // covers counselling/counseling
                                   ->orWhere('name', 'like', '%counselling%')
                                   ->count(),
            'legal'       => Resource::where('name', 'like', '%legal%')->count(),
            'posts' => News::count(),
        ];

        // Report stats (adjust statuses to your schema; fallback if none)
        $openStatuses = ['pending', 'in_review'];
        $reportStats = [
            'open'    => Report::whereIn('status', $openStatuses)->count(),
            'new_24h' => Report::where('created_at', '>=', Carbon::now()->subDay())->count(),
            'new_7d'  => Report::where('created_at', '>=', Carbon::now()->subDays(7))->count(),
        ];

        // Lists
        $newReports    = Report::where('created_at', '>=', Carbon::now()->subDay())
                               ->latest()->take(6)->get();
        $recentReports = Report::latest()->take(10)->get();

        // ⛔️ Removed any notifications queries
        return view('admin.dashboard', compact(
            'counts',
            'reportStats',
            'newReports',
            'recentReports'
        ));
    }
}
