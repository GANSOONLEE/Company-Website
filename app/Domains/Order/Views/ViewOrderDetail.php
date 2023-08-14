<?php

namespace App\Domains\Order\Views;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ViewOrderDetail extends Controller{

    public function viewOrderDetail(Request $request)
    {

        $orderData = Order::where('orderID', $request->orderID)
                        ->first();

        return view('backend.user.order.orderDetail', compact('orderData'));
    }

}