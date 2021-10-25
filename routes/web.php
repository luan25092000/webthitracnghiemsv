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
            return redirect()->route('dashboard.index');
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
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
        Route::get('/listing/{model}', 'ListingController@index')->name('listing.index');
        Route::get('/creating/{model}', 'CreateController@index')->name('create.index');
        Route::post('/creating/{model}', 'CreateController@store')->name('create.store');
        Route::get('/editing/{model}/{id}', 'EditController@index')->name('editing.index');
        Route::put('/editing/{model}/{id}', 'EditController@update')->name('editing.update');
        Route::get('/destroy/{model}/{id}', 'ListingController@destroy')->name('listing.destroy');
        Route::get('/rank', 'DashboardController@rank')->name('rank.index');
        Route::get('/profile', 'DashboardController@profile')->name('profile.index');
        Route::get('/print', 'DashboardController@print')->name('print');
        Route::post('/showtable', 'DashboardController@showTable')->name('rank.showtable');
        Route::post('/getdata', 'DashboardController@getData')->name('rank.getData');

        // Route::resources([
        //     'student'   => 'StudentController',
        //     'teacher'   => 'TeacherController',
        //     'exam'      => 'ExamController',
        //     'theme'     => 'ThemeController',
        //     'quest'     => 'QuestController',
        //     'rank'      => 'RankController',
        // ]);
    });
});
//Home
Route::namespace('Page')->prefix('/')->group(function () {
    Route::get('/', 'HomeController@index')->name('page.home');
    // Route::get('/endTest', 'HomeController@index')->name('page.home');
    Route::resources([
            'test'   => 'TestController',
        //     'teacher'   => 'TeacherController',
        //     'exam'      => 'ExamController',
        //     'theme'     => 'ThemeController',
        //     'quest'     => 'QuestController',
        //     'rank'      => 'RankController',
        ]);
    
});
