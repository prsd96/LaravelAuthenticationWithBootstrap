<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\PasswordResetController;

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

//fn () is only for return view statements

Route::get('/', fn() => view('home'))->name('home');

//Registration And Login Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::get('verify-email/{token}','verifyUserEmail')->name('verifyUserEmail');
    Route::get('login', 'login')->name('login');
    Route::post('checkUserLogin', 'checkUserLogin')->name('checkUserLogin');
    Route::get('logout', 'logout')->name('logout');
});

//Password Related Routes
Route::controller(PasswordResetController::class)->group(function () {
    Route::get('forgot-password', 'forgotPassword')->name('forgotPassword');
    Route::post('password-reset','sendPasswordResetLink')->name('sendPasswordResetLink');
    Route::get('forgot-password','forgotPassword')->name('forgotPassword');
    Route::post('password-reset','sendPasswordResetLink')->name('sendPasswordResetLink');
    Route::get('reset-password/{token}','showPasswordResetForm')->name('showPasswordResetForm');
    Route::post('update-password','updatePassword')->name('updatePassword');
});

//Users Routes
Route::Resource('users', UserController::class);

