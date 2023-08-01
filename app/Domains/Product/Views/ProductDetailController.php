<?php

namespace App\Domains\Product\Views;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;

class ProductDetailController extends Controller{

    function view($productID){

        $product = Product::where('productID', $productID)
            ->first();

        $directory = `$product->productCatelog/` . $product->getProductID() . `/`;
        
        $files = Storage::disk('product')->allFiles($directory);
        $images = [];

        foreach ($files as $file) {
            $images[] = $file;
        }

        /**
         *  更新商品數
         */

        if(Auth::check()) {
            $userEmail = Auth::user()->Email;
            $recondCount = Cart::where('Email', $userEmail)->count();
            $data = ['product' => $product, 'images' => $images, 'cart' => $recondCount];
        } else {
            $data = ['product' => $product, 'images' => $images];
        }
        
        return view('frontend.product.productDetail', $data);

    }
}