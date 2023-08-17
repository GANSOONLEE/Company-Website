<?php

namespace App\Domains\Order\Views;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ViewOrder{

    function viewOrder(){

        $orderData = Order::orderBy('updated_at', 'desc')
            ->get();

        $orderNew = session('orderNew');

        return View('backend.admin.viewOrder', compact('orderData', 'orderNew'));
    }

}