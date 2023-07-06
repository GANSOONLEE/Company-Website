<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AjaxDataController;
use App\Http\Controllers\backend\ProductController;
use App\Domains\Product\Events\Image\CreatedImageGroupEvent;

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

// Ajax 數據請求
Route::get('/ajax-product',[AjaxDataController::class,'productData']);
Route::post('/create-product',[ProductController::class,'store']);
Route::post('/create-image-group/{productID}',[CreatedImageGroupEvent::class,'create']);