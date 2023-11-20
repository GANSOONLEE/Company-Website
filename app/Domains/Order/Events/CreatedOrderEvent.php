<?php

namespace App\Domains\Order\Events;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpParser\Error;
use App\Events\NewOrderEvent;


class CreateOrderEvent{

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

            $orderNewCount = Order::where('order_status', 'New')->count(); 
            event(new NewOrderEvent($orderNewCount));
            
            Order::create($data);


            $productInCart = Cart::where('email_address', $email)
                ->first();
                
            $cartContent = $productInCart->cart_content ?? [];

            // $debug = [];
            
            foreach($cartContent as $index => &$cartItem){
                foreach(json_decode($data['order_content']) as $order){
                    if(!isset($order)){
                        continue;
                    }
                    if($cartItem['product_code'] !== $order->id){
                        continue;
                    }
                    if($cartItem['cart_content'][0]['brand_code'] !== $order->brand){
                        continue;
                    }
                    foreach($cartItem['cart_content'] as &$item){
                        $item['quantity'] = 0;
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
                // 'debug' => $debug,
            ];

        }catch(\Exception $e){
            $status = [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                // '$debug' => $debug,
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