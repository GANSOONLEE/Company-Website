<?php

namespace App\Domains\Product\Views;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductDetailController extends Controller{

    function view($productCode){

        $product = Product::where('productCode', $productCode)
            ->first();

        $directory = "$product->productCatelog/$product->productModel/$product->productCode/";
        
        $files = Storage::disk('product')->allFiles($directory);
        $images = [];

        foreach ($files as $file) {
            if (basename($file) !== 'cover.png') {
                $images[] = $file;
            }
        }

        return view('frontend.product.productDetail', ['product' => $product, 'images' => $images]);

    }
}