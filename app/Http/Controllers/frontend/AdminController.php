<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\backend\ProductController;
use App\Models\Product;
use App\Models\productModel;
use App\Models\productCatelog;

class AdminController extends Controller{

    public function dashboard(): object{
        return view('backend.admin.dashboard');
    }

    /**
     *  Product Pages
     * 
     */

    public function newProduct(): object{
        $products = Product::all();

        // 查询所有车款数据
        $models = productModel::orderBy('modelName', 'asc')->get();

        // 查询所有种类数据
        $catelogs = productCatelog::orderBy('catelogName', 'asc')->get();

        return view('backend.admin.newProduct',compact('products','models','catelogs'));
    }

    public function editProduct(): object{
        // 查询所有车款数据
        $models = productModel::orderBy('modelName', 'asc')->get();

        // 查询所有种类数据
        $catelogs = productCatelog::orderBy('catelogName', 'asc')->get();

        return view('backend.admin.editProduct',compact('models','catelogs'));
    }

    /**
     *  Order Pages
     * 
     */

    public function viewOrder(): object{
        return view('backend.admin.viewOrder');
    }

    public function editOrder(): object{
        return view('backend.admin.editOrder');
    }

    /**
     *  User Pages
     * 
     */

    public function editUser(): object{
        return view('backend.admin.editUser');
    }
}

?>