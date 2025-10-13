<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyReportsController extends Controller
{
    public function index(Request $request)
    {
        $q = Report::query()
            ->where('user_id', Auth::id())
            ->latest();

        if ($request->filled('status')) {
            $q->where('status', $request->string('status'));
        }

        $reports = $q->paginate(10)->withQueryString();

        // status->badge color map
        $statusColors = [
            'new'       => 'bg-gray-100 text-gray-700',
            'pending'   => 'bg-yellow-100 text-yellow-700',
            'in_review' => 'bg-blue-100 text-blue-700',
            'resolved'  => 'bg-green-100 text-green-700',
            'closed'    => 'bg-slate-100 text-slate-700',
        ];

        return view('report.my.index', compact('reports','statusColors'));
    }

    public function show(Report $report)
    {
        abort_unless($report->user_id === Auth::id(), 404);

        $statusSteps = [
            'new'       => 'Submitted',
            'pending'   => 'Queued',
            'in_review' => 'Under Review',
            'resolved'  => 'Resolved',
            'closed'    => 'Closed',
        ];

        return view('report.my.show', [
            'report' => $report,
            'statusSteps' => $statusSteps,
        ]);
    }
}
