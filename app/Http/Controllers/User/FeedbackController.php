<?php // App\Http\Controllers\User\FeedbackController.php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index() {
        $feedbacks = Feedback::where('user_id', auth()->id())->latest()->paginate(10);
        return view('feedback.index', compact('feedbacks'));
    }

    public function create() {
        return view('feedback.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'rating'  => ['nullable','integer','min:1','max:5'],
            'context' => ['nullable','string','max:120'],
            'message' => ['required','string','max:2000'],
            'report_id' => ['nullable','exists:reports,id'],
        ]);
        $data['user_id'] = auth()->id();
        \App\Models\Feedback::create($data);

        return redirect()->route('my.feedback.index')->with('status','Thanks for your feedback!');
    }

    public function show(Feedback $feedback) {
        abort_unless($feedback->user_id === auth()->id(), 403);
        return view('feedback.show', compact('feedback'));
    }

    public function destroy(Feedback $feedback) {
        abort_unless($feedback->user_id === auth()->id(), 403);
        $feedback->delete();
        return redirect()->route('my.feedback.index')->with('status','Feedback deleted.');
    }
}
