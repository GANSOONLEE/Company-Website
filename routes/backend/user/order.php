<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Views\ViewOrderDetail;

Route::get('/user/order/{orderID}',[ViewOrderDetail::class, 'viewOrderDetail'])->name('orderDetail');