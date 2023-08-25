<?php

namespace App\Domains\Cart\Events;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @Route post => api/user/add-to-cart/
 */

class AddToCartEvent{

    private $email;
    private $cart;

    public function __construct(Request $request){
        /**
         *  Defined variable
         */

        $this->email = $request->email;
        $this->cart = $request->cart;

        $this->productAddToCart();
    }

    public function productAddToCart(){
        try{

            /**
             * Validate the JSON format
             */

            if (!is_array($this->cart) || !isset($this->cart['product_code'])) {
                Log::error('Error! This is not a valid JSON format.');
                throw new \Exception('NOT_VALID_JSON');
            }
    
            /**
             * Get customer cart content
             */

            $newCartItem = [
                "product_code" => $this->cart['product_code'],
                "product_category" => $this->cart['product_category'],
                "cart_content" => [
                    [
                        "brand" => $this->cart['brand'],
                        "brand_code" => $this->cart['brand_code'],
                        "quantity" => $this->cart['quantity']
                    ]
                ]
            ];
    
            // Check if the cart exists for the user
            $cart = Cart::where('email_address', $this->email)->first();
    
            if (!$cart) {
                // If the cart doesn't exist, create a new one
                $cart = Cart::create([
                    'email_address' => $this->email,
                    'cart_content' => [$newCartItem],
                ]);
            } else {
                $cartContent = $cart->cart_content ?? [];
    
                // Check if the same product exists in the cart
                $found = false;
                foreach ($cartContent as &$item) {
                    if ($item['product_code'] === $newCartItem['product_code']) {
                        foreach ($item['cart_content'] as &$content) {
                            if ($content['brand_code'] === $newCartItem['cart_content'][0]['brand_code']) {
                                $content['quantity'] += $newCartItem['cart_content'][0]['quantity'];
                                $found = true;
                                break; // Exit the loop once updated
                            }
                        }
                    }
                }
    
                // If the same product is not found, add the new item to the cart
                if (!$found) {
                    $cartContent[] = $newCartItem;
                }
    
                // Update cart content
                $cart->update(['cart_content' => $cartContent]);
            }
    
            $status = ['success' => 'success'];
    
        } catch (\Exception $e) {
            $status = ['error' => $e->getMessage()];
            Log::error($e->getMessage());
        }
    
        return response()->json($status);
    }    

}