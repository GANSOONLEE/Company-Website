<?php


use Illuminate\Support\Facades\Route;
use App\Domains\Product\Events\Product\CreatedProductEvent;
use App\Domains\Product\Events\Product\UpdatedProductEvent;
use App\Domains\Product\Events\Product\DeletedProductEvent;
use App\Http\Controllers\backend\ProductController;


use App\Http\Controllers\LocaleController;

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

Route::group(['as' => 'frontend.', 'middleware' => 'login'], function () {
    includeRouteFiles(__DIR__ . '/frontend/');
});

Route::get('/back',function(){
    return redirect()->route('frontend.index');
})->name('back');


/**
 * 後端頁面
 */

Route::group(['prefix' => 'user', 'as' => 'backend.user.', 'middleware' => 'user'], function () {
    includeRouteFiles(__DIR__ . '/backend/user/');
});

Route::group(['prefix' => 'admin', 'as' => 'backend.admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__ . '/backend/admin/');
});



// Product 產品處理路由
Route::post('/products', [CreatedProductEvent::class, 'createProduct'])->name('products.store');
Route::post('/products/{productID}', [UpdatedProductEvent::class, 'updateProduct'])->name('products.update');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/product/{productID}/delete', [DeletedProductEvent::class, 'destroy'])->name('products.destroy');
