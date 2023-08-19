
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\ViewController;
use App\Http\Controllers\backend\ProductController;

// 視圖路由
// Route::get('{productType}/catelog', [ViewController::class, 'catelog'])->name('catelog');

// 處理路由
Route::get('/catelog/{catelogName}',[ProductController::class, 'index'])->name('catelog.index');