<?php

namespace App\Domains\Product\Views;

// Model
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Request;

class ProductEditController{

    public function editProduct(Request $request){

        // $productData = Product::orderBy('productCatelog', 'asc')
        //     ->get('productID', 'productCatelog', 'productType', 'productStatus', 'productNameList');

        $productData = Product::all();

        $catelogs = Category::all();
        $orderNew = session('orderNew');

        return view('backend.admin.editProduct', compact('productData', 'catelogs', 'orderNew'));
    }

}