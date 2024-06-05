<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Admin authentication routes
Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');
});

// Admin dashboard and other routes
Route::middleware(['auth.admin'])->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name("dashboard");
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    // Route::post('login', [AdminController::class, 'login'])->name('login');


    Route::get('exam_category', [AdminController::class, 'exam_category']);

    Route::get('delete_category/{id}', [AdminController::class, 'delete_category']);
    Route::get('edit_category/{id}', [AdminController::class, 'edit_category']);
    Route::get('category_status/{id}', [AdminController::class, 'category_status']);
    Route::get('manage_exam', [AdminController::class, 'manage_exam']);
    Route::get('exam_status/{id}', [AdminController::class, 'exam_status']);
    Route::get('delete_exam/{id}', [AdminController::class, 'delete_exam']);
    Route::get('edit_exam/{id}', [AdminController::class, 'edit_exam']);
    Route::get('manage_students', [AdminController::class, 'manage_students']);
    Route::get('student_status/{id}', [AdminController::class, 'student_status']);
    Route::get('delete_students/{id}', [AdminController::class, 'delete_students']);
    Route::get('add_questions/{id}', [AdminController::class, 'add_questions']);
    Route::get('question_status/{id}', [AdminController::class, 'question_status']);
    Route::get('delete_question/{id}', [AdminController::class, 'delete_question']);
    Route::get('update_question/{id}', [AdminController::class, 'update_question']);
    Route::get('registered_students', [AdminController::class, 'registered_students']);
    Route::get('delete_registered_students/{id}', [AdminController::class, 'delete_registered_students']);
    Route::get('apply_exam/{id}', [AdminController::class, 'apply_exam']);
    Route::get('admin_view_result/{id}', [AdminController::class, 'admin_view_result']);

    Route::post('edit_question_inner', [AdminController::class, 'edit_question_inner']);
    Route::post('add_new_question', [AdminController::class, 'add_new_question']);
    Route::post('edit_students_final', [AdminController::class, 'edit_students_final']);
    Route::post('add_new_exam', [AdminController::class, 'add_new_exam'])->name("exam.add_new_exam");
    Route::post('add_new_category', [AdminController::class, 'add_new_category']);
    Route::post('edit_new_category', [AdminController::class, 'edit_new_category']);
    Route::post('edit_exam_sub', [AdminController::class, 'edit_exam_sub']);
    Route::post('add_new_students', [AdminController::class, 'add_new_students']);


    // Add more admin routes here
});
