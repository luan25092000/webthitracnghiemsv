<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// Admin
Route::namespace('Admin')->prefix('ad')->group(function () {
    Route::get('/', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard.index');
        } else {
            return redirect()->route('auth.show.login');
        }
    });

    Route::prefix('auth')->namespace('Auth')->group(function () {

        Route::get('/login', 'AuthController@showLogin')->name('auth.show.login');
        Route::post('login', 'AuthController@handleLogin')->name('auth.handle.login');

        Route::get('/logout', 'AuthController@handleLogout')->name('auth.handle.logout');
    });

    Route::group(['middleware' => 'check.admin.login'], function() {
        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');
        Route::resources([
            'student'   => 'StudentController',
            'teacher'   => 'TeacherController',
            'exam'      => 'ExamController',
            'theme'     => 'ThemeController',
            'quest'     => 'QuestController',
            'rank'      => 'RankController',
        ]);
    });
});
