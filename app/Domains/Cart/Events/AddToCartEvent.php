<?php

namespace App\Domains\Cart\Events;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddToCartEvent
{
    public function addToCart(Request $request)
    {
        try {
            // 获取请求中的数据
            $email = $request->input('email');
            $productCode = $request->input('product_code');
            $brandCode = $request->input('brand_code');
            $quantity = $request->input('quantity');

            // 获取产品的分类
            $product = Product::where('product_id', $productCode)->first();
            $productCategory = $product ? $product->product_category : null;

            // 验证 JSON 格式
            if (!$productCategory) {
                Log::error('Error! This is not a valid JSON format.');
                throw new \Exception('NOT_VALID_JSON');
            }

            // 获取用户购物车
            $cart = Cart::where('email_address', $email)->first();

            if (!$cart) {
                // 如果购物车不存在，创建一个新的
                $cart = Cart::create([
                    'email_address' => $email,
                    'cart_content' => [],
                ]);
            }

            $cartContent = $cart->cart_content ?? [];

            // 标记是否找到相同的产品
            $found = false;

            foreach ($cartContent as &$item) {
                if ($item['product_code'] === $productCode) {
                    foreach ($item['cart_content'] as &$cartItem) {
                        if ($cartItem['brand_code'] === $brandCode) {
                            $cartItem['quantity'] += $quantity;
                            $found = true;
                            break 2; // 退出内外两个循环
                        }
                    }
                }
            }

            // 如果没有找到相同的产品，将新项目添加到购物车
            if (!$found) {
                $newCartItem = [
                    "product_code" => $productCode,
                    "product_category" => $productCategory,
                    "cart_content" => [
                        [
                            "brand_code" => $brandCode,
                            "quantity" => $quantity
                        ]
                    ]
                ];
                $cartContent[] = $newCartItem;
            }

            // 更新购物车记录
            $cart->update(['cart_content' => $cartContent]);

            $status = [
                'success' => 'success',
            ];
        } catch (\Exception $e) {
            $status = ['error' => $e->getMessage()];
            Log::error($e->getMessage());
        }

        return response()->json($status);
    }
}
