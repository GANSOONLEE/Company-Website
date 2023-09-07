<?php


use Illuminate\Support\Facades\Route;
use App\Domains\Product\Events\Product\CreatedProductEvent;
use App\Domains\Product\Events\Product\UpdatedProductEvent;
use App\Domains\Product\Events\Product\DeletedProductEvent;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\frontend\ViewController;

use App\Models\Product;
use App\Models\productCatelog;
use App\Models\productModel;

use App\Http\Controllers\LocaleController;

use App\Domains\Product\Events\Product\SearchedProductEvent;

require_once app_path('Helpers/Global/SystemHelper.php');

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

Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/**
 * 前端頁面
 */
// Route::domain('frozen.com')->group(function(){
    Route::group(['as' => 'frontend.', 'middleware' => 'login'], function () {
        includeRouteFiles(__DIR__ . '/frontend/');
    });

    Route::get('/back',function(){
        return redirect()->route('frontend.index');
    })->name('back');
// });

/**
 * 後端頁面
 */

    Route::group(['as' => 'backend.', 'middleware' => 'user'], function () {
        includeRouteFiles(__DIR__ . '/backend/public/');
    });

// Route::domain('customer.frozen.com')->group(function(){
    Route::group(['prefix' => 'user', 'as' => 'backend.user.', 'middleware' => 'user'], function () {
        includeRouteFiles(__DIR__ . '/backend/user/');
    });
// });

// Route::domain('admin.frozen.com')->group(function(){
    Route::group(['prefix' => 'admin', 'as' => 'backend.admin.', 'middleware' => 'admin'], function () {
        includeRouteFiles(__DIR__ . '/backend/admin/');
    });
// });

/**
 * API Pusher
 */

Route::group(['prefix' => 'api'], function () {
    includeRouteFiles(__DIR__ . '/api/');
});



Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/product/delete/{productId}', [DeletedProductEvent::class, 'destroy'])->name('products.destroy');
Route::get('/product/delete/{productId}', [DeletedProductEvent::class, 'destroy'])->name('products.destroy');

// 產品
Route::post('/product/search/',[SearchedProductEvent::class,'searchProductByModal'])->name('search.product');
Route::get('/product/search/',[SearchedProductEvent::class,'searchProductByModal'])->name('search.product');

// Test

// Route::get('/testing', function () {
//     event(new App\Events\StatusLiked('Someone'));
//     return "Event has been sent!";
// });

// Route::get('/', function () {
//     return View('welcome');
// });

// Multi domains
// Route::group(['domain' => 'example.com'], function(){
//     Route::get('/domain', [ViewController::class, 'product']);
// });

// Route::domain('admin.example.com')->group(function(){
//     Route::get('/domain', [ViewController::class, 'register']);
// });