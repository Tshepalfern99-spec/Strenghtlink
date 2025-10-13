<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\ReportAcknowledgementMail;
use App\Models\Feedback;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

// ⬇️ add this
use App\Services\ReportMailer;

class ReportController extends Controller
{
    /** Categories map: value => [label, emoji, color] */
    public const CATEGORIES = [
        'physical'  => ['Physical abuse','🛡️','#ef4444'],
        'emotional' => ['Emotional abuse','💔','#f59e0b'],
        'economic'  => ['Economic abuse','💸','#10b981'],
        'cyber'     => ['Cyber abuse','🖥️','#3b82f6'],
        'sexual'    => ['Sexual violence','⚠️','#a855f7'],
        'stalking'  => ['Stalking / Harassment','👣','#f97316'],
        'other'     => ['Other','🧩','#6b7280'],
    ];

    /** GET /report */
    public function create(Request $request)
    {
        $categories = self::CATEGORIES;
        $user = Auth::user();

        return view('report.create', compact('categories', 'user'));
    }

    /** POST /report (public + logged-in; throttled in routes) */
    public function store(Request $request)
    {
        $user = Auth::user();

        // ✅ validate — allow either "location" (preferred) or legacy "location_text"
        $validated = $request->validate([
            'is_anonymous'   => ['nullable', 'boolean'],
            'category'       => ['required', 'in:' . implode(',', array_keys(self::CATEGORIES))],
            'description'    => ['required', 'string', 'min:20', 'max:2000'],
            'location'       => ['nullable', 'string', 'max:255'],
            'location_text'  => ['nullable', 'string', 'max:255'],
            'contact_email'  => ['nullable', 'email', 'max:255'],
        ]);

        $isAnon = (bool)($validated['is_anonymous'] ?? false);

        // Normalize location to the column your admin views use: "location"
        $location = $validated['location'] ?? $validated['location_text'] ?? null;

        $data = [
            'user_id'       => (!$isAnon && $user) ? $user->id : null,
            'category'      => $validated['category'],
            'description'   => $validated['description'],
            'location'      => $location, // 👈 normalized key
            'contact_email' => $validated['contact_email'] ?? ($user?->email),
            // 👇 Use "pending" so it matches your admin filters/badges (pending/in_review/resolved)
            'status'        => 'pending',
        ];

        $report = Report::create($data);

        // Acknowledge reporter (if they left an email)
        $this->deliverAck($report);

        // ⬇️ NEW: email admins via PHPMailer with deep link to the admin report page
        ReportMailer::notifyAdmin($report);

        // Keep your success flow; you’re using a query param ?ref=ID
        return redirect()->route('report.success', ['ref' => $report->id]);
    }

    /** GET /report/success?ref=ID */
    public function success(Request $request)
    {
        $ref = (int) $request->query('ref');
        $report = Report::findOrFail($ref);

        $categories = self::CATEGORIES;
        $queued = config('queue.default') !== 'sync';

        return view('report.success', compact('report', 'categories', 'queued'));
    }

    /** POST /report/feedback (throttled) */
    public function storeFeedback(Request $request)
    {
        $data = $request->validate([
            'report_id' => ['required', 'exists:reports,id'],
            'rating'    => ['nullable', 'integer', 'min:1', 'max:5'],
            'message'   => ['nullable', 'string', 'max:500'],
        ]);

        Feedback::create([
            'user_id'   => Auth::id(),
            'report_id' => $data['report_id'],
            'rating'    => $data['rating'] ?? null,
            'message'   => $data['message'] ?? '',
        ]);

        return back()->with('status', 'Thanks for your feedback.');
    }

    /** Send/queue reporter acknowledgement; never block UX */
    private function deliverAck(Report $report): void
    {
        if (empty($report->contact_email)) {
            return;
        }

        try {
            if (config('queue.default') === 'sync') {
                Mail::to($report->contact_email)->send(new ReportAcknowledgementMail($report));
            } else {
                Mail::to($report->contact_email)->queue(new ReportAcknowledgementMail($report));
            }
        } catch (\Throwable $e) {
            \Log::error('Report ack mail failed', [
                'report_id' => $report->id,
                'error'     => $e->getMessage(),
            ]);
        }
    }
}
