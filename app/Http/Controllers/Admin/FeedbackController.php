<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $term   = $request->string('q')->toString();
        $rating = $request->integer('rating') ?: null;
        $from   = $request->date('from', null);
        $to     = $request->date('to', null);

        $feedback = Feedback::with(['user','report'])
            ->search($term)
            ->rating($rating)
            ->dateRange($from?->format('Y-m-d'), $to?->format('Y-m-d'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'count'   => Feedback::count(),
            'avg'     => round(Feedback::whereNotNull('rating')->avg('rating') ?? 0, 2),
            'last7'   => Feedback::where('created_at','>=',now()->subDays(7))->count(),
        ];

        return view('admin.feedback.index', compact('feedback','stats'));
    }

    public function show(Feedback $feedback)
    {
        $feedback->load(['user','report']);
        return view('admin.feedback.show', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('status','Feedback deleted.');
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $filename = 'feedback_export_'.now()->format('Ymd_His').'.csv';

        $query = Feedback::with(['user','report'])->latest();

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID','User','Email','ReportRef','Rating','Message','Created']);
            $query->chunk(500, function($rows) use ($out) {
                foreach ($rows as $f) {
                    fputcsv($out, [
                        $f->id,
                        optional($f->user)->name,
                        optional($f->user)->email,
                        optional($f->report)->reference ?? $f->report_id,
                        $f->rating,
                        $f->message,
                        $f->created_at,
                    ]);
                }
            });
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
