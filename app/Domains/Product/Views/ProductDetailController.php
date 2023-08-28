<?php

namespace App\Domains\Product\Views;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;

class ProductDetailController extends Controller{

    function view($productID){

        $product = Product::where('product_id', $productID)
            ->first();

        $directory = $product->product_category . '/' . $product->product_id . '/';
        
        $files = Storage::disk('product')->allFiles($directory);
        $images = [];

        foreach ($files as $file) {
            $images[] = $file;
        }

        /**
         *  更新商品數
         */

        if(Auth::check()) {
            $userEmail = Auth::user()->email_address;
            $record = Cart::where('email_address', $userEmail)->first();

            if (isset($record->cart_content)) {
                
                $content = $record->cart_content;
                if (is_array($content)) {
                    $record_count = 0;
                    $totalCount = count($content); // 总元素数量
            
                    foreach ($content as $item) {
                        if (isset($item['cart_content'][0]['quantity']) && $item['cart_content'][0]['quantity'] > 0) {
                            $record_count++;
                        }
                    }
                }
            }else{
                $record_count = 0;
            }
                            
            $data = ['product' => $product, 'images' => $images, 'cart' => $record_count];
        } else {
            $data = ['product' => $product, 'images' => $images];
        }
        
        return view('frontend.product.productDetail', $data);

    }
}