<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Observer\Order\OrderStutusUpdataNewToReceived; 

Route::post('update-order-status/{orderId}',[OrderStutusUpdataNewToReceived::class, 'orderStatusNewToReceived']);