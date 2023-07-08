<?php

namespace App\Domains\Product\Events\Product;

use App\Http\Controllers\backend\ProductController;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchedProductEvent{

    public function searchProductByModal(Request $request){

        $values = $request->input('values');

        $productsData = Product::whereIn('productModel', $values)
            ->get(['productCatelog', 'productName', 'productCode', 'productModel', 'productSubname']);

        $this->search($productsData);


        // 返回查询结果给 AJAX 请求
        return response()->json($productsData);
    }


    function search($productsData){

        return view('frontend.product' ,['$products' => $productsData]);
    }
}