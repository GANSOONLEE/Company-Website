<?php

namespace App\Domains\Order\Events\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;

class AddToCartEvent{
    public function productAddToCart(Request $request){

        try{
            /**
             *  Encapsulation data
             */
            
            $data = [
                'productID' => $request->productID,
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
                                        ->where('productID', $data['productID'])
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
        } catch (\Exception $e) { 
            return $e->getMessage();
        }
        
    }
}