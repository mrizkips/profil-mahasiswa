<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'password.email' => false,
    'password.request' => false,
    'password.reset' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {

    // Admin Authentication
    Route::namespace('Auth')->group(function() {
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');
    });

    Route::middleware('auth:admin')->group(function() {
        Route::get('/', function() {
            return redirect()->route('admin.login');
        });
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('mahasiswa', 'MahasiswaController');
    });
});

Route::get('clear-cache', function() {
    $exit = Artisan::call('cache:clear');
    return back()->with('alert', ['color' => 'primary', 'content' => 'Clear cache successful']);
});

Route::get('clear-route', function() {
    $exit = Artisan::call('route:clear');
    return back();
});

Route::get('clear-config', function() {
    $exit = Artisan::call('config:cache');
    $exit = Artisan::call('cache:clear');
    return back();
});

Route::get('clear-view', function() {
    $exit = Artisan::call('view:clear');
    return back();
});
