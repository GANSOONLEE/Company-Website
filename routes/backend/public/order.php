<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Events\CreatedOrderEvent;
use App\Domains\Order\Events\UpdatedOrderEvent;
use App\Domains\Order\Events\DeletedOrderEvent;
use App\Domains\Order\Events\SearchedOrderEvent;

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/create',[CreatedOrderEvent::class, 'createOrder'])->name('create');
    Route::get('/update',[UpdatedOrderEvent::class, 'updateOrder'])->name('update');
    Route::get('/delete',[DeletedOrderEvent::class, 'deleteOrder'])->name('delete');
    Route::get('/search',[SearchedOrderEvent::class, 'searchOrder'])->name('search');
});