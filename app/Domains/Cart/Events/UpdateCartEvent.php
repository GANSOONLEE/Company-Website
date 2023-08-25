<?php

namespace App\Domains\Cart\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;

// /api/update-cart-quantity

class UpdateCartEvent extends Controller{
    
    public function updateCart(Request $request){

        try{
            $email = $request->input('email');
            $productCode = $request->input('product_code');
            $quantity = $request->input('quantity');

            // 查找购物车记录
            $cart = Cart::where('email_address', $email)->first();

            if (!$cart) {
                Log::error('Cart not found');
                throw new \Exception('Cart not found');
            }

            // 在购物车内容中查找指定商品
            $cartContent = $cart->cart_content ?? [];
            $found = false;

            foreach ($cartContent as &$item) {
                if ($item['product_code'] === $productCode) {
                    $item['cart_content'][0]['quantity'] = $quantity;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                Log::error('Product not found');
                throw new \Exception('Product not found in cart');
            }

            // 更新购物车记录
            $cart->update([
                'cart_content' => $cartContent,
            ]);

            $data = [
                'after-quantity' => $quantity,
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
