<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\backend\AjaxDataController;
use App\Http\Controllers\backend\ProductController;
use App\Domains\Product\Events\Product\SearchedProductEvent;
use App\Domains\Product\Events\Product\DeletedProductEvent;
use App\Domains\Order\Events\Cart\AddToCartEvent;
use App\Domains\Order\Events\Cart\UpdateCartEvent;
use App\Domains\Order\Events\CreatedOrderEvent;
use App\Domains\Order\Events\UserViewOrderEvent;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ajax 數據請求 （获取请求）
Route::get('/ajax-product', [AjaxDataController::class,'productData']);

// Ajax 數據請求 （发送请求）
Route::post('/delete-product', [DeletedProductEvent::class , 'deleteProduct']);
Route::post('/search-product', [SearchedProductEvent::class , 'searchProductByModal']);
Route::post('/user/add-to-cart/', [AddToCartEvent::class, 'productAddToCart']);
Route::post('/update-cart-quantity', [UpdateCartEvent::class , 'updateCart']);
Route::post('/create-order',[CreatedOrderEvent::class, 'createOrder'])->name('api.create-order');
Route::post('/user-view-order',[UserViewOrderEvent::class, 'userViewOrder'])->name('api.user-view-order');