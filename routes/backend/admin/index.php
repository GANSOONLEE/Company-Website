<?php

use Illuminate\Support\Facades\Route;

/* Return View */
use App\Http\Controllers\frontend\AdminController;
use App\Domains\Product\Views\ProductEditController;
use App\Domains\Product\Views\PendingOrderController;

/* Method */
use App\Domains\Product\Events\Product\CreatedProductEvent;
use App\Domains\Product\Events\Product\UpdatedProductEvent;
use App\Domains\Product\Events\Product\DeletedProductEvent;

use App\Domains\Order\Events\AdminViewOrderEvent;
use App\Domains\Order\Views\ViewOrder;

// 後臺系統

/**
 * sidebar 連接
 * 
 */
Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

Route::group(['prefix' => 'product'], function(){
    Route::get('/newProduct', [AdminController::class,'newProduct'])->name('newProduct');
    Route::get('/editProduct', [ProductEditController::class,'editProduct'])->name('editProduct');

    Route::post('/newProduct', [CreatedProductEvent::class, 'createProduct'])->name('createdProduct');
    Route::post('/editProduct', [UpdatedProductEvent::class , 'updateProduct'])->name('updatedProduct');
});

Route::group(['prefix' => 'order'], function(){
    Route::get('/viewOrder', [ViewOrder::class,'viewOrder'])->name('viewOrder');
    Route::get('/pendingOrder', [PendingOrderController::class,'pendingOrder'])->name('pendingOrder');
});

Route::group(['prefix' => 'user'], function(){
    Route::get('/managerAccount', [AdminController::class,'managerAccount'])->name('managerAccount');
});

Route::get('/admin-view-order/{orderID}',[AdminViewOrderEvent::class, 'adminViewOrder'])->name('api.admin-view-order');