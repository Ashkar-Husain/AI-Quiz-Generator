<?php

use App\Exports\QuestionTemplateExport;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Imports\QuizImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

Route::post('/quiz-import', function (Request $request) {

    try {

        $request->validate([
            'excel_file' => 'required|file|max:10240|mimetypes:text/plain,text/csv,application/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);

        Excel::import(new QuizImport, $request->file('excel_file'));

        return back()->with('success', 'Questions Imported Successfully ✅');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

        $failures = $e->failures();

        return back()->with('error', 'Something went wrong, please try again later! ' . $e->getMessage());
    } catch (\Exception $e) {
        return back()->with('error', 'Import failed! ' . $e->getMessage());
    }
});




Route::get('/download-template/{type}', function ($type) {

    if (!in_array($type, ['xlsx', 'csv'])) {
        abort(404);
    }

    $fileName = 'question_template.' . $type;

    $format = $type === 'csv'
        ? ExcelExcel::CSV
        : ExcelExcel::XLSX;

    return Excel::download(
        new QuestionTemplateExport,
        $fileName,
        $format
    );
});


Route::get('/', function () {
    return view('welcome');
});

//* Signup
Route::get('/signup', [AuthController::class, 'signup_yourself'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup_store'])->name('signup.post');

//* Login
Route::get('/login', [AuthController::class, 'login_yourself'])->name('login');
Route::post('/login', [AuthController::class, 'login_store'])->name('login.post');

//* Dashboard Admin
Route::get('/admin/dashboard', [DashboardController::class, 'admin_dashboard'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');
//* Dashboard Normal User
Route::get('/user/dashboard', [DashboardController::class, 'user_dashboard'])->middleware(['auth', 'role:user'])->name('user.dashboard');

//* Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//* Forgot Password
Route::get('/forgot-password', [AuthController::class, 'forgot_password_form'])
    ->name('forgot.password');

Route::post('/forgot-password', [AuthController::class, 'forgot_password_send'])
    ->name('forgot.password.post');

//* Verify Otp
Route::get('/verify-otp', [AuthController::class, 'verify_otp_form'])
    ->name('verify.otp.form');

Route::post('/verify-otp', [AuthController::class, 'verify_otp'])
    ->name('verify.otp.post');


//* Reset Password
Route::get('/reset-password', [AuthController::class, 'reset_password_form'])
    ->name('reset.password.form');

Route::post('/reset-password', [AuthController::class, 'reset_password'])
    ->name('reset.password.post');


//* Admin Dashboard Routes
Route::get('/dashboard/create-quizzes', [DashboardController::class, 'create_quizzes'])->middleware(['auth', 'role:admin'])->name('admin.dashboard.add_quiz');

Route::get('/dashboard/create-users', [UserController::class, 'create_users'])->middleware(['auth', 'role:admin'])->name('admin.dashboard.add_users');

Route::post('/dashboard/create-users', [UserController::class, 'add_new_user'])->middleware(['auth', 'role:admin'])->name('admin.dashboard.add_new_user');

//* Quiz Through Pdf
Route::middleware(['auth', 'role:admin'])->group(function () {

    //* PDF Upload
    Route::get('/dashboard/upload-pdf', [QuizController::class, 'upload_pdf_page'])
        ->name('admin.dashboard.upload_pdf');

    Route::post('/dashboard/upload-pdf', [QuizController::class, 'uploadPdf'])
        ->name('admin.dashboard.upload_pdf.store');

    //* Quiz Setup
    Route::get('/quiz/setup', [QuizController::class, 'quizSetup'])
        ->name('quiz.setup');
    //* start Quiz
    Route::post('/quiz/start', [QuizController::class, 'startQuiz'])
        ->middleware(['auth', 'role:admin'])
        ->name('quiz.start');
});


//* Test Mail
Route::get('/dashboard/test-mail', [UserController::class, 'test_mail']);


//* Github Login
// Redirect to GitHub (stateless)
Route::get('/auth/github', function () {
    return Socialite::driver('github')->stateless()->redirect();
});

// Callback (stateless)
Route::get('/auth/github/callback', function () {
    try {
        $githubUser = Socialite::driver('github')->stateless()->user();
    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'GitHub login failed. Please try again.');
    }

    $user = User::where('provider', 'github')
        ->where('provider_id', $githubUser->getId())
        ->first();

    if (!$user) {
        $existingUser = User::where('email', $githubUser->getEmail())->first();
        if ($existingUser) {
            return redirect('/login')
                ->with('error', 'This email is already registered. Please login manually and link GitHub.');
        }

        $user = User::create([
            'branch_id' => 'Main Branch',
            'user_name' => $githubUser->getName() ?? $githubUser->getNickname(),
            'email' => $githubUser->getEmail(),
            'provider' => 'github',
            'provider_id' => $githubUser->getId(),
            'avatar' => $githubUser->getAvatar(),
            'password' => bcrypt('github_login_dummy'),
            'role' => 'user',
        ]);
    }

    Auth::login($user);

    return $user->role === 'admin'
        ? redirect('/admin/dashboard')
        : redirect('/user/dashboard');
});
