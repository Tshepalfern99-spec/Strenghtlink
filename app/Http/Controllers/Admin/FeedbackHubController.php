<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;         // Site UX feedback (existing model)
use App\Models\ReportFeedback;   // Report-related feedback (table for post-report feedback)

class FeedbackHubController extends Controller
{
    public function index(Request $request)
    {
        // Common filters for both lists
        $q      = trim((string) $request->input('q'));
        $rating = $request->input('rating'); // used for site feedback
        $from   = $request->input('from');
        $to     = $request->input('to');

        // --- Site Feedback (UX) ---
        $site = Feedback::query()
            ->with(['user:id,name,email'])
            ->when($q, fn($q2) => $q2->where(function($s) use ($q) {
                $s->where('message','like',"%{$q}%")
                  ->orWhere('context','like',"%{$q}%");
            }))
            ->when($rating, fn($q2) => $q2->where('rating', (int)$rating))
            ->when($from, fn($q2) => $q2->whereDate('created_at','>=',$from))
            ->when($to, fn($q2) => $q2->whereDate('created_at','<=',$to))
            ->latest()
            ->paginate(8, ['*'], 'site_page')
            ->withQueryString();

        // --- Report Feedback (after report) ---
        // Adjust column names if your table uses different ones.
        $report = ReportFeedback::query()
            ->with([
                'user:id,name,email',
                'report:id,reference,status',
            ])
            ->when($q, fn($q2) => $q2->where(function($s) use ($q) {
                $s->where('message','like',"%{$q}%")
                  ->orWhere('notes','like',"%{$q}%")
                  ->orWhereHas('report', fn($r) => $r->where('reference','like',"%{$q}%"));
            }))
            ->when($from, fn($q2) => $q2->whereDate('created_at','>=',$from))
            ->when($to, fn($q2) => $q2->whereDate('created_at','<=',$to))
            ->latest()
            ->paginate(8, ['*'], 'report_page')
            ->withQueryString();

        return view('admin.feedback-hub.index', [
            'q'        => $q,
            'rating'   => $rating,
            'from'     => $from,
            'to'       => $to,
            'site'     => $site,
            'report'   => $report,
        ]);
    }
}
