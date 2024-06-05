<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



// Include admin routes with session middleware
Route::prefix('admin')->namespace('App\Http\Controllers')->group(base_path('routes/admin.php'));

// Include student routes with session middleware
Route::prefix('student')->namespace('App\Http\Controllers')->group(base_path('routes/student.php'));
