<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\CatelogController;
use App\Http\Controllers\Backend\ModelController;
use App\Http\Controllers\frontend\AdminController;

// 後臺系統

// 新增产品组
    Route::get('/NewProduct', [AdminController::class, 'products'])->name('newProduct');


Route::post('/EditProduct', [AdminController::class, 'editProduct'])->name('editProduct');

Route::get('/dashboard',[AdminController::class,'product'])->name('dashboard');
Route::get('/dashboard',[AdminController::class,'product'])->name('dashboard');

Route::post('/models', [ModelController::class, 'create'])->name('model.store');
Route::post('/catelogs', [CatelogController::class, 'create'])->name('catelog.store');