<?php

namespace App\Domains\User\Views;

use App\Http\Controllers\Controller;
use App\Models\Cart;

class UserCartController extends Controller{

    public function cart(){

        $email = auth()->user()->Email;
    
        $carts = Cart::where('Email', $email)
            ->orderBy('productCategory', 'asc')
            ->get();

        return view('backend.user.cart.cart', compact('carts'));
    }

}