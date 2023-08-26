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
            Order::where('order_id', $orderId)->update(['order_status' => 'Pending']);

            $orderNewCount = Order::where('order_status', 'New')->count();
            event(new NewOrderEvent($orderNewCount));

            return response()->json(['status' => "Pending, "]);
        }catch(\Exception $err){
            return response()->json(['error' => $err->getMessage()]);
        }
    }
}