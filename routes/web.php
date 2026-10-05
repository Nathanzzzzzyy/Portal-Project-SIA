<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\RecordController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// ---------- Guests ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showStudent'])->name('login');
    Route::post('/login', [LoginController::class, 'student'])->middleware('throttle:10,1');
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->middleware('throttle:10,1');
    Route::get('/admin/login', [LoginController::class, 'showAdmin'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'admin'])->middleware('throttle:10,1');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// ---------- Email verification ----------
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')->name('verification.send');

    Route::get('/dashboard', [StudentController::class, 'redirect'])->name('dashboard');
});

// ---------- Student area (must be logged in AND email-verified) ----------
Route::middleware(['auth', 'verified'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::get('/enrollment', [StudentController::class, 'enrollment'])->name('enrollment');
    Route::post('/enrollment/{subject}', [StudentController::class, 'enroll'])->name('enroll');
    Route::delete('/enrollment/{subject}', [StudentController::class, 'drop'])->name('drop');
    Route::get('/subjects', [StudentController::class, 'subjects'])->name('subjects');
    Route::get('/grades', [StudentController::class, 'grades'])->name('grades');
    Route::get('/schedule', [StudentController::class, 'schedule'])->name('schedule');
    Route::get('/announcements', [StudentController::class, 'announcements'])->name('announcements');
    Route::get('/settings', [StudentController::class, 'settings'])->name('settings');
    Route::put('/settings/password', [StudentController::class, 'updatePassword'])->name('password');
});

// ---------- Admin area ----------
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', UserController::class)->except('show');
    Route::get('/records', [RecordController::class, 'index'])->name('records.index');
    Route::get('/records/{user}', [RecordController::class, 'show'])->name('records.show');
    Route::put('/records/grade/{enrollment}', [RecordController::class, 'grade'])->name('records.grade');
    Route::resource('announcements', AnnouncementController::class)->except('show');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings/password', [AdminController::class, 'updatePassword'])->name('password');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
});