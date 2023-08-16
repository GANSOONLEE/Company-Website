<?php

namespace App\Domains\Order\Events;

use App\Models\Order;
use Illuminate\Http\Request;

class UpdatedOrderEvent{

    function updateOrder(Request $request){

        $currentOrder = Order::where('orderID',$request->orderID)->first();

        $order = $currentOrder;

        $order->update([
            'orderStatus' => 'Complete'
        ]);

        $response = [
            'type' => '200',
            'event' => "The order {$request->orderID} are update!"
        ];

        return response()->json($response);

    }

}