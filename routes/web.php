<?php

use App\Http\Controllers\backend\CatelogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\ViewController;
use App\Http\Controllers\frontend\AdminController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\Backend\ModelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// navbar 鏈接
Route::get('/', [ViewController::class, 'index'])->name('index');
Route::get('/about-us', [ViewController::class, 'about'])->name('about');
Route::get('/type', [ViewController::class, 'type'])->name('type');
Route::get('/contact', [ViewController::class, 'contact'])->name('contact');

// Catelog 物品种类
Route::get('{productType}/catelog', [ViewController::class, 'catelog'])->name('catelog');
Route::get('{productType}/catelog/{catelogName}',[ProductController::class, 'index'])->name('catelog.index');
Route::get('{productType}/catelog/{catelogName}/{modelName}',[ProductController::class, 'model'])->name('catelog.model');
Route::post('{productType?}/search', [ProductController::class, 'search'])->name('product.search');

// Product
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{productID}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{productID}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{productID}', [ProductController::class, 'destroy'])->name('products.destroy');

// Admin
Route::get('/admin/product', [AdminController::class, 'products'])->name('/admin/products');
Route::post('/models', [ModelController::class, 'create'])->name('model.store');
Route::post('/catelogs', [CatelogController::class, 'create'])->name('catelog.store');

Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () {
    Route::get('/{language?}', 'AdminController@index'); // 将语言作为可选参数传递给控制器
    // 其他路由...
});
