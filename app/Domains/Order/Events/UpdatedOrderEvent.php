<?php

namespace App\Domains\Order\Events;

use App\Models\Order;
use App\Models\UserOperation;
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

        $operation = [
            'userID' => auth()->user()->Name,
            'operationType' => `Update order status from $currentOrder->orderStatus to $request->status`,
        ];

        UserOperation::create($operation);

        $response = [
            'type' => '200',
            'event' => "The order {$request->orderID} are update!\nFrom {$currentOrder->orderStatus} to {$request->status}"
        ];

        return response()->json($response);

    }

}