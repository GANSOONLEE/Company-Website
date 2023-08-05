<?php

namespace App\Domains\Product\Views;

// Model
use App\Models\Product;
use App\Models\productCatelog;

class ProductEditController{

    public function editProduct(){

        // $productData = Product::orderBy('productCatelog', 'asc')
        //     ->get('productID', 'productCatelog', 'productType', 'productStatus', 'productNameList');

        $productData = Product::all();

        $catelogs = productCatelog::all();

        return view('backend.admin.editProduct', compact('productData', 'catelogs'));
    }

}