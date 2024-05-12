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

Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login.index');
Route::get('/user', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('user.register');
Route::post('/user/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('user.exec.register');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/memo', function() {
    return view('memo');
  })->name('memo.index');
  Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('memo.logout');
});

Auth::routes();