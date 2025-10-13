<?php 
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SiteFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteFeedbackController extends Controller
{
    public function create(Request $request)
    {
        return view('feedback.create', [
            'prefill' => [
                'page_url' => $request->headers->get('referer') ?? url()->previous() ?? url('/'),
                'device'   => substr($request->userAgent() ?? '', 0, 250),
                'contact_email' => Auth::check() ? Auth::user()->email : '',
            ],
            'categories' => [
                'ui' => 'Design / Usability',
                'performance' => 'Speed / Performance',
                'content' => 'Content / Accuracy',
                'bug' => 'Bug / Error',
                'other' => 'Other',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rating'         => ['nullable','integer','min:1','max:5'],
            'category'       => ['nullable','in:ui,performance,content,bug,other'],
            'message'        => ['nullable','string','max:2000'],
            'page_url'       => ['nullable','string','max:2048'],
            'device'         => ['nullable','string','max:255'],
            'consent_contact'=> ['sometimes','boolean'],
            'contact_email'  => ['nullable','email','max:255'],
        ]);

        $data['user_id'] = Auth::id();
        $data['consent_contact'] = (bool)($data['consent_contact'] ?? false);

        SiteFeedback::create($data);

        return redirect()->route('site.feedback.thanks');
    }

    public function thanks()
    {
        return view('feedback.thanks');
    }
}
