<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Product\Views\ProductDetailController;

Route::group(['as' => 'product.'], function(){
    Route::get('product/detail/{productCode}',[ProductDetailController::class, 'view'])->name('detail');
});