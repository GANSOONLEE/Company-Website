<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Product\Services\Image\ImageGroupService;

Route::group(['prefix' => 'image','as' => 'image'], function(){
    Route::get('create',[ImageGroupService::class, 'create'])->name('create');
});