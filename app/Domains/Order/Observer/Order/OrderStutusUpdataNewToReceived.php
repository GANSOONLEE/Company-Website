<?php

namespace App\Domains\Order\Observer\Order;

use App\Events\NewOrderEvent;
use App\Models\Order;
use App\Events\Order\NewToReceived;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderStutusUpdataNewToReceived extends Controller
{
    public function orderStatusNewToReceived($orderId)
    {
        try{
            // Update order status to "Received" in database
            Order::where('orderID', $orderId)->update(['orderStatus' => 'Received']);

            $orderNewCount = Order::where('orderStatus', 'New')->count();
            event(new NewOrderEvent($orderNewCount));

            return response()->json(['status' => "Received"]);
        }catch(\Exception $err){
            return response()->json(['error' => $err->getMessage()]);
        }
    }
}