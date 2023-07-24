<?php

namespace App\Domains\Product\Events\Product;

use App\Http\Controllers\backend\ProductController;

use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class SearchedProductEvent{

    public function searchProductByModal(Request $request){

        $values = $request->input('values');

        $product = Product::whereIn('productModel', $values)
            ->get(['productCatelog', 'productName', 'productCode', 'productModel', 'productSubname']);

        $product = $product->map(function ($product) {
            $product->detailLink = route('frontend.product.detail',['productCode' => $product->productCode]); // 將新的欄位添加到每個項目中並賦值
            return $product;
        });

        $product = $product->map(function ($product) {
            $product->imageSrc = asset("storage/{$product->productCatelog}/{$product->productModel}/{$product->productCode}/cover.png"); // 將新的欄位添加到每個項目中並賦值
            return $product;
        });

        $this->search($product);


        // 返回查询结果给 AJAX 请求
        return response()->json($product);
    }


    function search($product){

        return view('frontend.product' ,['$product' => $product]);
    }
}