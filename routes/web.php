<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Exports\QuestionTemplateExport;
use App\Http\Controllers\UserController;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

use App\Imports\QuizImport;
use Illuminate\Http\Request;

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


Route::get('/dashboard/test-mail', [UserController::class, 'test_mail']);
