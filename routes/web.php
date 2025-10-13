<?php
use App\Http\Controllers\Admin\FeedbackHubController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\User\MyReportsController;
use App\Http\Controllers\Public\SiteFeedbackController;
/*
|--------------------------------------------------------------------------
| Public controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Public\ResourceBrowseController;
use App\Http\Controllers\Public\ReportController;
use App\Http\Controllers\Public\NewsBrowseController;
use App\Http\Controllers\Public\EducationBrowseController;

/*
|--------------------------------------------------------------------------
| User controllers (web guard)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Forum controllers (shared for auth users/admins)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Forum\ForumPostController;
use App\Http\Controllers\Forum\ForumCommentController;
use App\Http\Controllers\Auth\User\PasswordResetLinkController as UserPasswordResetLinkController;
use App\Http\Controllers\Auth\User\NewPasswordController as UserNewPasswordController;

/*
|--------------------------------------------------------------------------
| Admin controllers (admin guard)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SiteFeedbackController as AdminSiteFeedbackController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthController;
use App\Http\Controllers\Admin\ResourceCategoryController as AdminResourceCategoryController;
use App\Http\Controllers\Admin\ResourceController as AdminResourceController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| PUBLIC (no auth)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'welcome'])->name('home');

// Resources (public browse)
Route::get('/resources',              [ResourceBrowseController::class, 'index'])->name('resources.index');
Route::get('/resources/{resource}',   [ResourceBrowseController::class, 'show'])->name('resources.show');

// Reporting (public/anonymous allowed)
Route::get('/report',                 [ReportController::class, 'create'])->name('report.create');
Route::post('/report',                [ReportController::class, 'store'])->middleware('throttle:10,1')->name('report.store');
Route::get('/report/success',         [ReportController::class, 'success'])->name('report.success');
Route::post('/report/feedback',       [ReportController::class, 'storeFeedback'])->middleware('throttle:20,1')->name('report.feedback');

// News (public)
Route::get('/news',                   [NewsBrowseController::class, 'index'])->name('news.index');
Route::get('/news/{slug}',            [NewsBrowseController::class, 'show'])->name('news.show');

// Education (public)
Route::get('/education',              [EducationBrowseController::class, 'index'])->name('education.index');
Route::get('/education/{slug}',       [EducationBrowseController::class, 'show'])->name('education.show');
// Public downloads/previews (by numeric id)
Route::get('/education/{item}/view',      [EducationBrowseController::class, 'view'])->whereNumber('item')->name('education.view');
Route::get('/education/{item}/download',  [EducationBrowseController::class, 'download'])->whereNumber('item')->name('education.download');

Route::get('/feedback', [SiteFeedbackController::class, 'create'])->name('site.feedback.create');
Route::post('/feedback', [SiteFeedbackController::class, 'store'])->name('site.feedback.store');
Route::get('/feedback/thanks', [SiteFeedbackController::class, 'thanks'])->name('site.feedback.thanks');
/*
|--------------------------------------------------------------------------
| USER (web guard)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::patch('/dashboard/display-name', [DashboardController::class, 'updateDisplayName'])->name('dashboard.display_name.update');
});
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password',  [\App\Http\Controllers\Auth\User\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\User\PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\User\NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password',        [\App\Http\Controllers\Auth\User\NewPasswordController::class, 'store'])->name('password.update');
});
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
// Email verification
Route::get('/email/verify', fn () => view('auth.verify-email'))->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('status', 'Your email has been verified.');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth','verified'])->prefix('my')->name('my.')->group(function () {
    Route::get('reports', [\App\Http\Controllers\User\MyReportsController::class, 'index'])->name('reports.index');
    Route::get('reports/{report}', [\App\Http\Controllers\User\MyReportsController::class, 'show'])->name('reports.show');
});
// routes/web.php
Route::middleware(['auth','verified'])->prefix('my')->name('my.')->group(function () {
    Route::get('feedback', [\App\Http\Controllers\User\FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('feedback/create', [\App\Http\Controllers\User\FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('feedback', [\App\Http\Controllers\User\FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('feedback/{feedback}', [\App\Http\Controllers\User\FeedbackController::class, 'show'])->name('feedback.show');
    Route::delete('feedback/{feedback}', [\App\Http\Controllers\User\FeedbackController::class, 'destroy'])->name('feedback.destroy');
});

// Profile (users)
Route::middleware('auth')->group(function () {
    Route::get('/profile',                [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',              [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/account',      [ProfileController::class, 'updateAccount'])->name('profile.account.update');
    Route::patch('/profile/password',     [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile',             [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| FORUM (allow either logged-in user OR logged-in admin)
| You must have a custom middleware 'auth.any' that allows auth:web OR auth:admin.
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.any'])->prefix('forums')->name('forum.')->group(function () {
    // posts
    Route::get('/',                [ForumPostController::class, 'index'])->name('index');
    Route::get('/create',          [ForumPostController::class, 'create'])->name('create');
    Route::post('/',               [ForumPostController::class, 'store'])->name('store');
    Route::get('/{post}',          [ForumPostController::class, 'show'])->name('show');
    Route::get('/{post}/edit',     [ForumPostController::class, 'edit'])->name('edit');
    Route::put('/{post}',          [ForumPostController::class, 'update'])->name('update');
    Route::delete('/{post}',       [ForumPostController::class, 'destroy'])->name('destroy');

    // comments
    Route::post('{post}/comments',                   [ForumCommentController::class, 'store'])->name('comments.store');
    Route::post('{post}/comments/{comment}/reply',   [ForumCommentController::class, 'reply'])->name('comments.reply');
    Route::put('comments/{comment}',                 [ForumCommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}',              [ForumCommentController::class, 'destroy'])->name('comments.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN (separate guard: admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // admin login
  
    // protected admin area
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login',  [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'store'])->name('login.store');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');


        Route::get('feedback-hub', [FeedbackHubController::class, 'index'])->name('feedback.hub');
        // Resource categories & resources
        Route::resource('resource-categories', AdminResourceCategoryController::class)->except(['show']);
        Route::resource('resources',           AdminResourceController::class);

        // Reports
        Route::resource('reports', AdminReportController::class)->only(['index','show','update','destroy']);
        Route::get('site-feedback',            [AdminSiteFeedbackController::class, 'index'])->name('site_feedback.index');
    Route::get('site-feedback/{feedback}', [AdminSiteFeedbackController::class, 'show'])->name('site_feedback.show');
    Route::delete('site-feedback/{feedback}', [AdminSiteFeedbackController::class, 'destroy'])->name('site_feedback.destroy');
    Route::get('site-feedback-export',     [AdminSiteFeedbackController::class, 'exportCsv'])->name('site_feedback.export');
        // News
        Route::resource('news', AdminNewsController::class);
        Route::post('news/{news}/publish', [AdminNewsController::class, 'publish'])->name('news.publish');
        
        // Education (admin CRUD)
        Route::resource('education', AdminEducationController::class);
        Route::post('education/{education}/publish',   [AdminEducationController::class,'publish'])->name('education.publish');
        Route::post('education/{education}/unpublish', [AdminEducationController::class,'unpublish'])->name('education.unpublish');
        Route::get('education/{education}/download',   [AdminEducationController::class,'download'])->name('education.download');

        // Forum moderation (read-only list/show + delete)
        Route::get('forum/posts',               [AdminForumController::class, 'index'])->name('forum.posts.index');
        Route::get('forum/posts/{post}',        [AdminForumController::class, 'show'])->name('forum.posts.show');
        Route::delete('forum/posts/{post}',     [AdminForumController::class, 'destroy'])->name('forum.posts.destroy');
        Route::delete('forum/comments/{comment}', [AdminForumController::class, 'destroyComment'])->name('forum.comments.destroy');

        // Feedback
        Route::resource('feedback', AdminFeedbackController::class)->only(['index','show','destroy']);
        Route::get('feedback-export', [AdminFeedbackController::class, 'exportCsv'])->name('feedback.export');

        // Users (admin sees users table)
        Route::get('users/export', [AdminUserController::class, 'export'])->name('users.export');
        Route::resource('users', AdminUserController::class)->only(['index','show','destroy']);
    });
});

/*
|--------------------------------------------------------------------------
| Auth scaffolding (users) - Breeze/Fortify/etc.
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
