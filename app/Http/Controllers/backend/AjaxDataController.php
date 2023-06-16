<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxDataController extends Controller
{
    function productData(){
        $products = Product::select('productId', 'productName', 'productCode', 'productType', 'productCatelog', 'productModel', 'productBrand','productSubname')
        ->get();

        return response()->json($products); // 将產品数据以JSON格式返回
    }
}
