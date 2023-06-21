<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\CatelogController;
use App\Http\Controllers\Backend\ModelController;
use App\Http\Controllers\frontend\AdminController;

// 後臺系統
Route::get('/product', [AdminController::class, 'products'])->name('/admin/products');
Route::post('/product', [AdminController::class, 'products'])->name('/admin/products');

Route::get('/dashboard',[AdminController::class,'product'])->name('dashboard');

Route::post('/models', [ModelController::class, 'create'])->name('model.store');
Route::post('/catelogs', [CatelogController::class, 'create'])->name('catelog.store');