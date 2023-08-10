<?php

namespace App\Domains\Order\Events;

use App\Models\Cart;
use App\Models\Order;
use App\Events\Order\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Error;

class CreatedOrderEvent{

    function createOrder(Request $request){

        try{
            /**
             * Defined variable
             */

            $orderID = $this->generatorOrderID();
            $Email = $request->input('email');
            $orderReceivedDate = date('Y-m-d');
            $orderReceivedTime = date('H:i:s');
            $orderContent = $request->input('productIds');

            $data = [
                'orderID' => $orderID,
                'Email' => $Email,
                'orderReceivedDate' => $orderReceivedDate,
                'orderReceivedTime' => $orderReceivedTime,
                'orderContent' => json_encode($orderContent),
            ];

            foreach( $orderContent as $cart){
                $cart = Cart::where('ID', $cart)
                    ->first();

                if($cart->quantity === 0){   
                    throw new Error('Qty can\'t empty! ');
                }
            }

            Order::create($data);

            foreach($orderContent as $cart){
                $cart = Cart::where('ID', $cart)
                    ->first();

                $cart->update([
                    'quantity' => 0,
                ]);
            }

            $status = [
                'success' => 'success',
            ];

        }catch(\Exception $e){
            $status = [
                'error' => $e->getMessage(),
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