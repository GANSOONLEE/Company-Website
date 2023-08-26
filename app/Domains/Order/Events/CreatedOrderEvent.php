<?php

namespace App\Domains\Order\Events;

use App\Events\NewOrderEvent;
use App\Models\Cart;
use App\Models\Order;
use App\Events\Order\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpParser\Error;


class CreatedOrderEvent{

    function createOrder(Request $request){

        try{
            /**
             * Defined variable
             */

            $orderID = $this->generatorOrderID();
            $email = $request->input('email');
            $orderReceivedDate = date('Y-m-d');
            $orderReceivedTime = date('H:i:s');
            $orderContent = $request->input('productIds');

            $data = [
                'order_id' => $orderID,
                'email_address' => $email,
                'order_received_date' => $orderReceivedDate,
                'order_received_time' => $orderReceivedTime,
                'order_content' => json_encode($orderContent),
            ];

            foreach($orderContent as $cart){
                if($cart['quantity'] === 0){
                    throw new Error('Qty can\'t empty! ');
                }
            }

            Order::create($data);

            $orderNewCount = Order::where('order_status', 'New')->count();
            event(new NewOrderEvent($orderNewCount));

            $productInCart = Cart::where('email_address', $email)
                ->first();
                
            $cartContent = $productInCart->cart_content ?? [];


            foreach($orderContent as $cart){

                foreach($cartContent as &$cartItem){
                    if($cartItem['product_code'] !== $cart['id']){
                        continue;
                    }
                    foreach($cartItem->cart_content as &$item){
                        if($item[0]['brand'] === $cart['brand']){
                            $item[0]['quantity'] = 0;
                        }
                    }
                }
            }

            $productInCart->cart_content = $cartContent;
            $productInCart->save();

            // $status = [
            //     'id' => $cart['id'],
            //     'cartID' => $cart['cartID'],
            //     'brand' => $cart['brand'],
            //     'quantity' => $cart['quantity'],
            //     'cart' => $productInCart,
            // ];

            $status = [
                'success' => 'success',
            ];

        }catch(\Exception $e){
            $status = [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ];
        }

        return response()->json($status);

    }

    public function generatorOrderID(){
        $currentTime = date('YmdHis'); // 获取当前时间，格式为"年月日时分秒"，例如：202308071014SS
        $randomChars = Str::random(2); // 生成两个随机字符

        $orderID = $currentTime . $randomChars;
        return $orderID;
    }

}