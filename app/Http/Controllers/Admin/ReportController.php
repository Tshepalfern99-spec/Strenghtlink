<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $status   = $request->get('status');   // pending|in_review|resolved|null
        $category = $request->get('category'); // optional filter
        $q        = $request->get('q');

        $reports = Report::query()
            ->when($status,   fn($qr)=>$qr->where('status', $status))
            ->when($category, fn($qr)=>$qr->where('category', $category))
            ->when($q, function ($qr) use ($q) {
                $qr->where(function ($w) use ($q) {
                    $w->where('reference','like',"%{$q}%")
                      ->orWhere('description','like',"%{$q}%")
                      ->orWhere('location','like',"%{$q}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // quick stats for header
        $stats = [
            'total'  => Report::count(),
            'open'   => Report::whereIn('status',['pending','in_review'])->count(),
            'recent' => Report::where('created_at','>=',now()->subDay())->count(),
        ];

        return view('admin.reports.index', compact('reports','stats','status','category','q'));
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'status'        => 'required|in:pending,in_review,resolved',
            'internal_note' => 'nullable|string|max:2000',
        ]);

        $report->status        = $data['status'];
        if (!empty($data['internal_note'])) {
            // Append timestamped note; create a text field `internal_notes` in reports migration if you want
            $existing = trim((string) $report->internal_notes);
            $newLine  = '['.now()->format('Y-m-d H:i').'] '.auth()->user()->name.': '.$data['internal_note'];
            $report->internal_notes = $existing ? ($existing."\n".$newLine) : $newLine;
        }
        $report->save();

        return back()->with('success','Report updated.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success','Report deleted.');
    }
}
