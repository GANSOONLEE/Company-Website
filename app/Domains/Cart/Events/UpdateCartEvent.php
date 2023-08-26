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
            $cart_ID = $request->input('cartID');
            $product_id = $request->input('productID');
            $productBrand = $request->input('productBrand');
            $quantity = $request->input('quantity');

            // 查找购物车记录
            $cart = Cart::where('cart_ID', $cart_ID)->first();

            if (!$cart) {
                Log::error('Cart not found');
                throw new \Exception('Cart not found');
            }

            // 在购物车内容中查找指定商品
            $cartContent = $cart->cart_content ?? [];
            $debugArray = [];
            $found = false;

            foreach ($cartContent as &$item) {
                if ($item['product_code'] !== $product_id) {
                    continue;
                }
                foreach ($item['cart_content'] as &$cartItem) {
                    if ($cartItem['brand_code'] === $productBrand) {
                        $cartItem['quantity'] = intval($quantity);
                        $found = true;
                        break;
                    }
                }
            }

            $debugArray = $cartContent;

            if (!$found) {
                Log::error('Product not found');
                throw new \Exception('Product not found in cart');
            }

            // 更新购物车记录
            $cart->update([
                'cart_content' => $cartContent,
            ]);

            $data = [
                'after-quantity' => $debugArray,
                'success' => 'update',
            ];
            
        }catch(\Exception $e){

            $data = [
                'error' => $e->getMessage(),
            ];

        }

        return response()->json($data);
    }

}
