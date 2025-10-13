<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Filters
        $q         = trim($request->input('q', ''));
        $verified  = $request->input('verified'); // 'yes' | 'no' | null
        $from      = $request->input('from');     // Y-m-d
        $to        = $request->input('to');       // Y-m-d

        $users = User::query()
            ->when($q, function ($query, $q) {
                $like = '%' . str_replace('%', '\%', $q) . '%';
                $query->where(function ($sub) use ($like) {
                    $sub->where('name', 'like', $like)
                        ->orWhere('email', 'like', $like)
                        ->orWhere('id', $like);
                });
            })
            ->when($verified === 'yes', fn ($q) => $q->whereNotNull('email_verified_at'))
            ->when($verified === 'no',  fn ($q) => $q->whereNull('email_verified_at'))
            ->when($from, fn ($q) => $q->whereDate('created_at', '>=', $from))
            ->when($to,   fn ($q) => $q->whereDate('created_at', '<=', $to))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Analytics (fast counts)
        $today      = Carbon::today();
        $weekAgo    = Carbon::now()->subDays(7);

        $analytics = [
            'total'        => User::count(),
            'verified'     => User::whereNotNull('email_verified_at')->count(),
            'unverified'   => User::whereNull('email_verified_at')->count(),
            'last7'        => User::where('created_at', '>=', $weekAgo)->count(),
        ];

        return view('admin.users.index', compact('users', 'analytics', 'q', 'verified', 'from', 'to'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        // Hard delete – if you prefer soft deletes, add SoftDeletes to User model and call $user->delete()
        $name = $user->name ?? ('User#'.$user->id);
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('status', "Deleted {$name}");
    }

    public function export(Request $request): StreamedResponse
    {
        // Reuse the same filters as index
        $q         = trim($request->input('q', ''));
        $verified  = $request->input('verified'); // 'yes' | 'no' | null
        $from      = $request->input('from');
        $to        = $request->input('to');

        $rows = User::query()
            ->when($q, function ($query, $q) {
                $like = '%' . str_replace('%', '\%', $q) . '%';
                $query->where(function ($sub) use ($like) {
                    $sub->where('name', 'like', $like)
                        ->orWhere('email', 'like', $like)
                        ->orWhere('id', $like);
                });
            })
            ->when($verified === 'yes', fn ($q) => $q->whereNotNull('email_verified_at'))
            ->when($verified === 'no',  fn ($q) => $q->whereNull('email_verified_at'))
            ->when($from, fn ($q) => $q->whereDate('created_at', '>=', $from))
            ->when($to,   fn ($q) => $q->whereDate('created_at', '<=', $to))
            ->orderBy('id')
            ->get(['id','name','email','email_verified_at','created_at']);

        $filename = 'users_export_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID','Name','Email','Verified At','Created At']);
            foreach ($rows as $r) {
                fputcsv($out, [
                    $r->id,
                    $r->name,
                    $r->email,
                    optional($r->email_verified_at)->toDateTimeString(),
                    optional($r->created_at)->toDateTimeString(),
                ]);
            }
            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
