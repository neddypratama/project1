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

// Route::group(['middleware' => ['auth', 'verified']], function () {
// 		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
// 		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
// });

Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::resource('role', 'App\Http\Controllers\RoleController', ['except' => ['show']]);
    Route::resource('apar', 'App\Http\Controllers\AparController', ['except' => ['show']]);
    Route::get('apar/riwayat', ['as' => 'apar.riwayat', 'uses' => 'App\Http\Controllers\AparController@riwayat']);
    Route::get('apar/tampil/{id}', ['as' => 'apar.tampil', 'uses' => 'App\Http\Controllers\AparController@tampil']);
    Route::get('apar/approve', ['as' => 'apar.approve', 'uses' => 'App\Http\Controllers\AparController@approve']);
    Route::get('apar/revisi/{id}', ['as' => 'apar.revisi', 'uses' => 'App\Http\Controllers\AparController@revisi']);
    Route::get('apar/acc/{id}', ['as' => 'apar.acc', 'uses' => 'App\Http\Controllers\AparController@acc']);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile/{id}', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password/{id}', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('download-pdf/{tahun}', [ExportController::class, 'downloadPDF'])->name('download.pdf');
    Route::get('download-excel/{tahun}', [ExportController::class, 'downloadExcel'])->name('download.excel');
    Route::get('print/{tahun}', [ExportController::class, 'print'])->name('print.view');
});

Route::get('/test-email', function () {
    Mail::raw('Test!', function ($message) {
        $message->to('burlleyjaya@gmail.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
})->name("send-email");


