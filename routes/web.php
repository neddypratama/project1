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

Auth::routes(['verify' => true]);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware(['auth', 'verified'] );

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['middleware' => ['role:1']], function () {
        Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
        Route::resource('role', 'App\Http\Controllers\RoleController', ['except' => ['show']]);
        Route::resource('apar', 'App\Http\Controllers\AparController', ['except' => ['show']]);
        Route::resource('uraian', 'App\Http\Controllers\UraianController', ['except' => ['show']]);
        Route::resource('suburaian', 'App\Http\Controllers\SubUraianController', ['except' => ['show']]);
        Route::get('apar/riwayat', ['as' => 'apar.riwayat', 'uses' => 'App\Http\Controllers\AparController@riwayat']);
        Route::get('apar/tampil/{id}', ['as' => 'apar.tampil', 'uses' => 'App\Http\Controllers\AparController@tampil']);
        Route::get('apar/approve', ['as' => 'apar.approve', 'uses' => 'App\Http\Controllers\AparController@approve']);
        Route::put('apar/status/{apar}', ['as' => 'apar.approvestatus', 'uses' => 'App\Http\Controllers\AparController@approveStatus']);
        Route::get('apar/revisi/{id}', ['as' => 'apar.revisi', 'uses' => 'App\Http\Controllers\AparController@revisi']);
        Route::put('apar/simpan/{apar}', ['as' => 'apar.simpan', 'uses' => 'App\Http\Controllers\AparController@simpan']);
        Route::get('apar/acc/{id}', ['as' => 'apar.acc', 'uses' => 'App\Http\Controllers\AparController@acc']);
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile/{id}', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        Route::put('profile/password/{id}', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
        Route::get('download-pdf/{tahun}', [ExportController::class, 'downloadPDF'])->name('download.pdf');
        Route::get('download-excel/{tahun}', [ExportController::class, 'downloadExcel'])->name('download.excel');
        Route::get('print/{tahun}', [ExportController::class, 'print'])->name('print.view');
    });

    Route::group(['middleware' => ['role:2']], function () {
        Route::resource('apar', 'App\Http\Controllers\AparController', ['except' => ['show']]);
        Route::get('apar/approve', ['as' => 'apar.approve', 'uses' => 'App\Http\Controllers\AparController@approve']);
        Route::put('apar/status/{apar}', ['as' => 'apar.approvestatus', 'uses' => 'App\Http\Controllers\AparController@approveStatus']);
        Route::get('apar/acc/{id}', ['as' => 'apar.acc', 'uses' => 'App\Http\Controllers\AparController@acc']);
        Route::get('apar/revisi/{id}', ['as' => 'apar.revisi', 'uses' => 'App\Http\Controllers\AparController@revisi']);
        Route::put('apar/simpan/{apar}', ['as' => 'apar.simpan', 'uses' => 'App\Http\Controllers\AparController@simpan']);
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile/{id}', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        Route::put('profile/password/{id}', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
        Route::get('download-pdf/{tahun}', [ExportController::class, 'downloadPDF'])->name('download.pdf');
        Route::get('download-excel/{tahun}', [ExportController::class, 'downloadExcel'])->name('download.excel');
        Route::get('print/{tahun}', [ExportController::class, 'print'])->name('print.view');
    });

    Route::group(['middleware' => ['role:3']], function () {
        Route::resource('apar', 'App\Http\Controllers\AparController', ['except' => ['show']]);
        Route::get('apar/riwayat', ['as' => 'apar.riwayat', 'uses' => 'App\Http\Controllers\AparController@riwayat']);
        Route::get('apar/tampil/{id}', ['as' => 'apar.tampil', 'uses' => 'App\Http\Controllers\AparController@tampil']);
        Route::put('apar/simpan/{apar}', ['as' => 'apar.simpan', 'uses' => 'App\Http\Controllers\AparController@simpan']);
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile/{id}', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        Route::put('profile/password/{id}', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    });

    Route::group(['middleware' => ['role:4']], function () {
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile/{id}', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        Route::put('profile/password/{id}', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    });

	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::resource('role', 'App\Http\Controllers\RoleController', ['except' => ['show']]);
    Route::resource('apar', 'App\Http\Controllers\AparController', ['except' => ['show']]);
    Route::resource('uraian', 'App\Http\Controllers\UraianController', ['except' => ['show']]);
    Route::resource('suburaian', 'App\Http\Controllers\SubUraianController', ['except' => ['show']]);
});

// Route::group(['middleware' => ['auth', 'verified']], function () {
    
//     // Untuk Admin saja
//     Route::group(['middleware' => ['role:admin']], function () {
//         Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
//         Route::resource('role', 'App\Http\Controllers\RoleController', ['except' => ['show']]);
//     });

//     // Untuk Akses Umum User
//     Route::group(['middleware' => ['role:user']], function () {
//         Route::resource('apar', 'App\Http\Controllers\AparController', ['except' => ['show']]);
//         Route::resource('uraian', 'App\Http\Controllers\UraianController', ['except' => ['show']]);
//         Route::resource('suburaian', 'App\Http\Controllers\SubUraianController', ['except' => ['show']]);
//     });

//     Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
//     Route::put('profile/{id}', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
//     Route::put('profile/password/{id}', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

//     Route::get('download-pdf/{tahun}', [ExportController::class, 'downloadPDF'])->name('download.pdf');
//     Route::get('download-excel/{tahun}', [ExportController::class, 'downloadExcel'])->name('download.excel');
//     Route::get('print/{tahun}', [ExportController::class, 'print'])->name('print.view');
// });


Route::get('/test-email', function () {
    Mail::raw('Test!', function ($message) {
        $message->to('burlleyjaya@gmail.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
})->name("send-email");


