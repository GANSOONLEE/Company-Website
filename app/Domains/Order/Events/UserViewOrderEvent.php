<?php

namespace App\Domains\Order\Events;

use App\Models\Order;
use Illuminate\Http\Request;

class UserViewOrderEvent{

    function userViewOrder(Request $request){

        try{
            $orderID = $request->orderID;
            $order = Order::where('order_id', $orderID)
                ->first();

            $status = [
                'status' => 'Success loading',
                'order' => $order
            ];
        }catch(\Exception $e){
            $status = [
                'status' => "Error! {$e->getMessage()}"
            ];
        }

        return response()->json($status);

    }

}