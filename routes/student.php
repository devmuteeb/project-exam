<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Student authentication routes
Route::middleware('guest:student')->group(function () {

    Route::get('login', [StudentController::class, 'showLoginForm'])->name('student.login');
    Route::post('login', [StudentController::class, 'login'])->name('student.login.submit');

    Route::get('register', [StudentController::class, 'create'])->name('student.register');
    Route::post('register', [StudentController::class, 'store'])->name('student.register.submit');
});

// Student dashboard and other routes
Route::middleware(['auth.student'])->name('student.')->group(function () {
    Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [StudentController::class, 'logout'])->name('student.logout');

    Route::get('exam', [StudentController::class, 'exam']);
    Route::get('join_exam/{id}', [StudentController::class, 'join_exam']);
    Route::post('submit_questions', [StudentController::class, 'submit_questions']);
    Route::get('show_result/{id}', [StudentController::class, 'show_result']);
    Route::get('apply_exam/{id}', [StudentController::class, 'apply_exam']);
    Route::get('view_result/{id}', [StudentController::class, 'view_result']);
    Route::get('view_answer/{id}', [StudentController::class, 'view_answer']);
});
