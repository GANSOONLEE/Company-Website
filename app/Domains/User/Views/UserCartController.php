<?php

namespace App\Domains\User\Views;

use App\Http\Controllers\Controller;
use App\Models\Cart;

class UserCartController extends Controller{

    public function cart(){

        $email = auth()->user()->email_address;
    
        $carts = Cart::where('email_address', $email)
            ->get();

        return view('backend.user.cart.cart', compact('carts'));
    }

}