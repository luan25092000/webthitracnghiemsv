<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.admin');
// });

Route::prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\backend\AdminController::class, 'dashboard'])->name('admin.dashboard');
   
    Route::resources([
        'student'   => App\Http\Controllers\StudentController::class,
        'teacher'   => TeacherController::class,
        'exam'      => ExamController::class,
        'theme'     => ThemeController::class,
        'quest'     => backend\QuestController::class,
        'rank'      => RankController::class,
        // 'blog'      => BlogController::class,
        // 'tag'       => TagController::class
    ]);
});
