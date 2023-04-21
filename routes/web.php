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

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return redirect('/login');
    })->name('landing'); });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user-mail-settings', [App\Http\Controllers\UserMailSettingController::class, 'index'])->name('user_mail_settings.index');
Route::get('/user_mail_settings/create', [App\Http\Controllers\UserMailSettingController::class, 'create'])->name('user_mail_settings.create');
Route::post('/user_mail_settings', [App\Http\Controllers\UserMailSettingController::class, 'store'])->name('user_mail_settings.store');
Route::get('/user_mail_settings/{id}/edit', [App\Http\Controllers\UserMailSettingController::class, 'edit'])->name('user_mail_settings.edit');
Route::put('/user_mail_settings/{id}', [App\Http\Controllers\UserMailSettingController::class, 'update'])->name('user_mail_settings.update');
Route::delete('/user_mail_settings/{id}', [App\Http\Controllers\UserMailSettingController::class, 'destroy'])->name('user_mail_settings.destroy');




Route::get('/mailnotification', [App\Http\Controllers\SentimentAnalysisController::class, 'mailnotify'])->name('mailnotify');
Route::get('/getMailInfo', [App\Http\Controllers\SentimentAnalysisController::class, 'getMailInfo']);

Route::get('/sendcronmail', [App\Http\Controllers\CronController::class, 'cronmailnotify'])->name('cronmailnotify');

Route::get('/sendnotification', [App\Http\Controllers\CronController::class, 'index'])->name('sendnotification');

