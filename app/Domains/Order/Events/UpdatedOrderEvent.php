<?php

namespace App\Domains\Order\Events;

use App\Models\Operation;
use App\Models\Order;
use App\Models\UserOperation;
use Illuminate\Http\Request;
use App\Events\NewOrderEvent;
use Illuminate\Support\Facades\Log;

class UpdatedOrderEvent{

    function updateOrder(Request $request){

        try{
            $currentOrder = Order::where('order_id', $request->orderID)
                            ->first();
    
            $order = $currentOrder;
            
            if($request->status == 'complete'){
                $order->update([
                    'order_status' => 'Completed'
                ]);
            }elseif($request->status == 'pending'){
                $order->update([
                    'order_status' => 'Pending'
                ]);
            }elseif($request->status == 'processing'){
                $order->update([
                    'order_status' => 'Processing'
                ]);
            }elseif($request->status == 'on hold'){
                $order->update([
                    'order_status' => 'On Hold'
                ]);
            }
    
            // $operation = [
            //     'userID' => auth()->user()->Name,
            //     'operationType' => `Update order status from $currentOrder->orderStatus to $request->status`,
            // ];
    
            // Operation::create($operation);

            $response = [
                'type' => '200',
                'event' => "The order {$request->orderID} are update!\nFrom {$currentOrder->orderStatus} to {$request->status}"
            ];
        }catch(\Exception $e){
            
            $response = [
                'debug' => $e->getMessage(),
            ];
        }
        

        return response()->json($response);

    }

}