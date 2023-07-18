<?php

namespace App\Domains\Order\Events\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;

class AddToCartEvent{
    public function productAddToCart(Request $request){

        /**
         *  Encapsulation data
         */
        
        $data = [
            'productCode' => $request->productCode,
            'productBrand' => $request->productBrand,
            'quantity' => $request->quantity,
            'Email' => $request->email,
        ];

        /**
         *  Check record
         *  @return object
         */

        $checkRecordDuplicate = Cart::where('Email', $data['Email'])
                                    ->where('productBrand', $data['productBrand'])
                                    ->where('productCode', $data['productCode'])
                                    ->first();

        if($checkRecordDuplicate){
            $recordUpdateID = $checkRecordDuplicate->ID;
            $recordUpdate = Cart::where('ID', $recordUpdateID)->first();
            $recordUpdateQuantity = $recordUpdate->quantity + $data['quantity'];

            $data = [
                'quantity' => $recordUpdateQuantity
            ];

            Cart::where('ID', $recordUpdateID)->update($data);
        }else{
            Cart::create($data);
        }
        
    }
}