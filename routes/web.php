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

Route::middleware('auth:mahasiswa')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/mahasiswa', 'HomeController@mahasiswa')->name('mahasiswa');
    Route::get('/ganti_password', 'HomeController@ganti_password')->name('ganti_password');
    Route::post('/ganti_password', 'HomeController@password_update')->name('ganti_password.update');
    Route::resource('semester', 'SemesterController');
    Route::resource('krs', 'KrsController')->parameters(['krs' => 'krs'])->except(['show']);
    Route::get('krs/{krs}/view_upload', 'KrsController@view_upload')->name('krs.view_upload');
});

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
        Route::resource('jurusan', 'JurusanController')->except(['show']);
        Route::resource('tahun_akademik', 'TahunAkademikController')->except(['show']);
        Route::resource('ekstrakurikuler', 'EkstrakurikulerController')->except(['show']);

        // Data Master
        Route::namespace('Wilayah')->group(function() {
            Route::resource('provinsi', 'ProvinsiController')->except(['show']);
            Route::resource('kabkota', 'KabKotaController')->except(['show']);
            Route::resource('kecamatan', 'KecamatanController')->except(['show']);
            Route::resource('desa', 'DesaController')->except(['show']);
        });

        Route::resource('pekerjaan', 'PekerjaanController')->except(['show']);
        Route::resource('asal_pemasaran', 'AsalPemasaranController')->except(['show']);
    });
});

Route::get('clear-cache', function() {
    $exit = Artisan::call('cache:clear');
    return back()->with('alert', ['color' => 'primary', 'content' => 'Clear cache successful']);
})->name('clear.cache');

Route::get('clear-route', function() {
    $exit = Artisan::call('route:clear');
    return back()->with('alert', ['color' => 'primary', 'content' => 'Clear cache successful']);
})->name('clear.route');

Route::get('clear-config', function() {
    $exit = Artisan::call('config:cache');
    $exit = Artisan::call('cache:clear');
    return back()->with('alert', ['color' => 'primary', 'content' => 'Clear cache successful']);
})->name('clear.config');

Route::get('clear-view', function() {
    $exit = Artisan::call('view:clear');
    return back()->with('alert', ['color' => 'primary', 'content' => 'Clear cache successful']);
})->name('clear.view');
