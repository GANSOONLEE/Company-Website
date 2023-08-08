<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\UserController;

/** View */
use App\Domains\User\Views\UserCartController;

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/favorite', [UserController::class, 'favorite'])->name('favorite');
Route::get('/cart', [UserCartController::class, 'cart'])->name('cart');
Route::get('/order', [UserController::class, 'order'])->name('order');
Route::get('/account', [UserController::class, 'account'])->name('account');