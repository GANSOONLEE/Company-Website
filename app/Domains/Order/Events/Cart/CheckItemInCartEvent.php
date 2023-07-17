<?php

namespace App\Domains\Order\Events\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;

class CheckItemInCartEvent{
    public function checkItemInCartEvent(Request $request){
        
        $data = [
            'productCode' => $request->productCode,
            'productBrand' => $request->productBrand,
            'quantity' => $request->quantity,
            'Email' => $request->email,
        ];

        Cart::create($data);
    }
}