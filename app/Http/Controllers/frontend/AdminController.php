<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\backend\ProductController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AdminController extends Controller{

    public function dashboard(): object{
        
        $orderNew = session('orderNew');
        return view('backend.admin.dashboard', compact('orderNew'));
    }

    /**
     *  Product Pages
     * 
     */

    public function newProduct(): object{
        $products = Product::all();

        // 查询所有种类数据
        $categories = Category::orderBy('categoryName', 'asc')->get();

        $brands = Brand::orderBy('brandName', 'asc')->get();
        $orderNew = session('orderNew');

        return view('backend.admin.addProduct',compact(
            'products',
            'categories',
            'brands', 
            'orderNew')
        );
    }

    /**
     *  Order Pages
     * 
     */

    public function viewOrder(): object{
        $orderNew = session('orderNew');
        return view('backend.admin.viewOrder', compact('orderNew'));
    }

    public function editOrder(): object{
        $orderNew = session('orderNew');
        return view('backend.admin.editOrder', compact('orderNew'));
    }

    /**
     *  User Pages
     * 
     */

    public function editUser(): object{
        $orderNew = session('orderNew');
        return view('backend.admin.editUser', compact('orderNew'));
    }
}

?>