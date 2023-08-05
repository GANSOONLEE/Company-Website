<?php

namespace App\Domains\Order\Observer\Order;

use App\Models\Order;
use App\Events\Order\NewToReceived;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderStutusUpdataNewToReceived extends Controller
{
    public function orderStatusNewToReceived($orderId)
    {
        try{
            // Update order status to "Received" in database
            Order::where('orderID', $orderId)->update(['orderStatus' => 'Received']);

            // Broadcast notification using Pusher
            event(new NewToReceived());

            return response()->json(['status' => "Received"]);
        }catch(\Exception $err){
            return response()->json(['error' => $err->getMessage()]);
        }
    }
}