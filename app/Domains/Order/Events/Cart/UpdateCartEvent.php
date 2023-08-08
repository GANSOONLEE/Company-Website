<?php

namespace App\Domains\Order\Events\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class UpdateCartEvent extends Controller{
    
    public function updateCart(Request $request){

        try{
            $ID = $request->input('ID');
            $productID = $request->input('productID');
            $productBrand = $request->input('productBrand');
            $quantity = $request->input('quantity');

            $cart = Cart::where('ID', $ID)->first();

            $cart->update([
                'quantity' => $quantity,
            ]);

            $data = [
                'after-quantity' => $cart->quantity,
                'success' => 'update',
                'quantity' => $quantity,
            ];
            
        }catch(\Exception $e){

            $data = [
                'error' => $e->getMessage(),
            ];

        }

        return response()->json($data);
    }

}