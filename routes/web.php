<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.welcome');
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware(['auth', 'verified'] );
Route::get('/home-data', 'App\Http\Controllers\HomeController@index')->name('home.data')->middleware(['auth', 'verified'] );


Route::group(['middleware' => ['auth']], function () {
    // Rute untuk Admin (role:1)
    Route::group(['middleware' => ['role:1']], function () {
        Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
        Route::resource('role', 'App\Http\Controllers\RoleController', ['except' => ['show']]);
        Route::resource('uraian', 'App\Http\Controllers\UraianController', ['except' => ['show']]);
        Route::resource('suburaian', 'App\Http\Controllers\SubUraianController', ['except' => ['show']]);
    });
    
    // Rute untuk Admin dan Manager (role:1,2)
    Route::group(['middleware' => ['role:2']], function () {
        Route::get('apar/approve', ['as' => 'apar.approve', 'uses' => 'App\Http\Controllers\AparController@approve']);
        Route::put('apar/status/{apar}', ['as' => 'apar.approvestatus', 'uses' => 'App\Http\Controllers\AparController@approveStatus']);
        Route::get('apar/acc/{id}', ['as' => 'apar.acc', 'uses' => 'App\Http\Controllers\AparController@acc']);
        Route::get('apar/revisi/{id}', ['as' => 'apar.revisi', 'uses' => 'App\Http\Controllers\AparController@revisi']);
        Route::put('apar/simpan/{apar}', ['as' => 'apar.simpan', 'uses' => 'App\Http\Controllers\AparController@simpan']);
        Route::get('download-pdf/{tahun}', [ExportController::class, 'downloadPDF'])->name('download.pdf');
        Route::get('download-excel/{tahun}', [ExportController::class, 'downloadExcel'])->name('download.excel');
        Route::get('print/{tahun}', [ExportController::class, 'print'])->name('print.view');
    });
    
    // Rute untuk Admin dan Staff (role:1,3)
    Route::group(['middleware' => ['role:1,3']], function () {
        Route::get('apar/riwayat', ['as' => 'apar.riwayat', 'uses' => 'App\Http\Controllers\AparController@riwayat']);
        Route::get('apar/tampil/{id}', ['as' => 'apar.tampil', 'uses' => 'App\Http\Controllers\AparController@tampil']);
    });
    
    // Rute untuk semua role (role:1,2,3,4)
    Route::group(['middleware' => ['role:1,2,3,4']], function () {
        Route::resource('apar', 'App\Http\Controllers\AparController', ['except' => ['show']]);
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile/{id}', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        Route::put('profile/password/{id}', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    });
});


Route::get('/test-email', function () {
    Mail::raw('Test!', function ($message) {
        $message->to('burlleyjaya@gmail.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
})->name("send-email");


