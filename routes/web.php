<?php

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
Route::group(['middleware' => ['web']], function () {

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();
Route::get('/home', [\App\Http\Controllers\UserEmilSettings::class, 'create'])->name('user_mail_settings.index');
Route::post('/home', [\App\Http\Controllers\UserEmilSettings::class, 'store'])->name('user_mail_settings.store');
//Route::get('/user-email-setting/{id}/edit', [\App\Http\Controllers\UserEmilSettings::class, 'edit'])->name('user_mail_settings.edit'); 
Route::get('/home/{id}/edit', [App\Http\Controllers\UserEmilSettings::class, 'edit'])->name('user_email_settings.edit');
Route::put('/home/{id}', [App\Http\Controllers\UserEmilSettings::class, 'update'])->name('user_mail_settings.update');
Route::get('/mailnotification', [App\Http\Controllers\HomeController::class, 'mailnotify'])->name('mailnotify');
Route::get('/getMailInfo', [App\Http\Controllers\HomeController::class, 'getMailInfo']);

Route::get('/sendcronmail', [App\Http\Controllers\CronController::class, 'cronmailnotify'])->name('cronmailnotify');

Route::get('/sendnotification', [App\Http\Controllers\CronController::class, 'index'])->name('sendnotification');
});