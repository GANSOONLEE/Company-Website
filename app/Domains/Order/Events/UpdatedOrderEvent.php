<?php

namespace App\Domains\Order\Events;

use App\Models\Order;
use Illuminate\Http\Request;

class UpdatedOrderEvent{

    function updateOrder(Request $request){

        $currentOrder = Order::where('orderID',$request->orderID)->first();

        $order = $currentOrder;

        if($request->status == 'complete'){
            $order->update([
                'orderStatus' => 'Complete'
            ]);
        }elseif($request->status == 'pending'){
            $order->update([
                'orderStatus' => 'Pending'
            ]);
        }elseif($request->status == 'in process'){
            $order->update([
                'orderStatus' => 'In Process'
            ]);
        }

        $response = [
            'type' => '200',
            'event' => "The order {$request->orderID} are update!\nFrom {$currentOrder->orderStatus} to {$request->status}"
        ];

        return response()->json($response);

    }

}