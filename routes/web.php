<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::patch('/user/update/info', [App\Http\Controllers\UserController::class, 'updateInfo'])->name('updateInfo');
Route::patch('/user/update/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword');
