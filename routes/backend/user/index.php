<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\UserController;

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');