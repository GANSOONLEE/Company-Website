<?php

namespace App\Domains\Product\Views;

use App\Http\Controllers\Controller;

class ProductDetailController extends Controller{

    function view(){
        return view('frontend.product.productDetail');
    }
}