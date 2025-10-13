<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteFeedback;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SiteFeedbackController extends Controller
{
    public function index(Request $request)
    {
        $q = SiteFeedback::with('user')->latest();

        if ($request->filled('category')) {
            $q->where('category', $request->string('category'));
        }
        if ($request->filled('rating')) {
            $q->where('rating', $request->integer('rating'));
        }

        $feedback = $q->paginate(20)->withQueryString();

        return view('admin.feedback.site.index', compact('feedback'));
    }

    public function show(SiteFeedback $feedback)
    {
        $feedback->load('user');
        return view('admin.feedback.site.show', compact('feedback'));
    }

    public function destroy(SiteFeedback $feedback)
    {
        $feedback->delete();
        return back()->with('status', 'Feedback removed.');
    }

    public function exportCsv(): StreamedResponse
    {
        $filename = 'site_feedback_'.now()->format('Ymd_His').'.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['id','user_id','rating','category','page_url','device','contact_email','consent_contact','message','created_at']);
            SiteFeedback::orderBy('id')->chunk(500, function($chunk) use ($out) {
                foreach ($chunk as $row) {
                    fputcsv($out, [
                        $row->id, $row->user_id, $row->rating, $row->category,
                        $row->page_url, $row->device, $row->contact_email,
                        $row->consent_contact ? 'yes' : 'no',
                        $row->message, $row->created_at,
                    ]);
                }
            });
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
