<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\AuthController;

Route::post('/login/data', [AuthController::class, 'login'])->name('login.post');
Route::post('/register/data', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');