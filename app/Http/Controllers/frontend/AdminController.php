<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\backend\ProductController;
use App\Models\Product;
use App\Models\productModel;
use App\Models\productCatelog;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class AdminController extends Controller{

    public function products(){

        // 查询所有产品数据
        $products = Product::all();

        // 查询所有车款数据
        $models = productModel::all();

        // 查询所有种类数据
        $catelogs = productCatelog::all();

        return view('backend.products',compact('products','models','catelogs'));
    }

    public function product(){
        return view('backend.product');
    }
}

?>