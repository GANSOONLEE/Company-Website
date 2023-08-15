<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Views\ViewOrderDetail;

Route::get('/order/{orderID}',[ViewOrderDetail::class, 'viewOrderDetail'])->name('orderDetail');