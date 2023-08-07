<?php

namespace App\Domains\Order\Events;

use App\Models\Order;
use App\Events\Order\NewOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class CreatedOrderEvent{

    function createOrder(Request $request): void{

        try{
            /**
             * Defined variable
             */

            $orderID = $this->generatorOrderID();
            $Email = Auth::user()->email;
            $orderReceivedDate = date('Y-m-d');
            $orderReceivedTime = date('H:i:s');
            $orderContent = $request->input('productOrder');

            $data = [
                'orderID' => $orderID,
                'Email' => $Email,
                'orderReceivedDate' => $orderReceivedDate,
                'orderReceivedTime' => $orderReceivedTime,
                'orderContent' => $orderContent,
            ];

            Order::created($data);

        }catch(\Exception $e){
            return redirect()->back()->json($e->getMessage());
        }

    }

    public function generatorOrderID(){
        $currentTime = date('YmdHis'); // 获取当前时间，格式为"年月日时分秒"，例如：202308071014SS
        $randomChars = Str::random(2); // 生成两个随机字符

        $orderID = $currentTime . $randomChars;
        return $orderID;
    }

}