<?php

namespace App\Domains\Product\Views;
use App\Http\Controllers\Controller;
use App\Models\Order;

class PendingOrderController extends Controller{
    public function pendingOrder(){

        $orderData = Order::where('orderStatus', 'Pending')
            ->orderBy('created_at', 'asc')
            ->get();

        $orderNew = session('orderNew');

        return view('backend.admin.pendingOrder', compact('orderData', 'orderNew'));
    }
}