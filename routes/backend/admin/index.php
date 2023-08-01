<?php

use Illuminate\Support\Facades\Route;

/* Return View */
use App\Http\Controllers\frontend\AdminController;

/* Method */
use App\Domains\Product\Events\Product\CreatedProductEvent;
use App\Domains\Product\Events\Product\UpdatedProductEvent;
use App\Domains\Product\Events\Product\DeletedProductEvent;

// 後臺系統

/**
 * sidebar 連接
 * 
 */
Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

Route::group(['prefix' => 'product'], function(){
    Route::get('/newProduct', [AdminController::class,'newProduct'])->name('newProduct');
    Route::get('/editProduct', [AdminController::class,'editProduct'])->name('editProduct');

    Route::post('/newProduct', [CreatedProductEvent::class, 'createProduct'])->name('createdProduct');
    Route::post('/editProduct/{productID}', [UpdatedProductEvent::class , 'updateProduct'])->name('updatedProduct');
});

Route::group(['prefix' => 'order'], function(){
    Route::get('/viewOrder', [AdminController::class,'viewOrder'])->name('viewOrder');
    Route::get('/noteOrder', [AdminController::class,'noteOrder'])->name('noteOrder');
});

Route::group(['prefix' => 'user'], function(){
    Route::get('/managerAccount', [AdminController::class,'managerAccount'])->name('managerAccount');
});