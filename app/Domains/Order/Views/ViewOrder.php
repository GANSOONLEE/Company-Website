<?php

namespace App\Domains\Order\Views;
use App\Models\Order;

class ViewOrder{

    function viewOrder(){

        $orderData = Order::all();
        $orderNew = session('orderNew');

        return View('backend.admin.viewOrder', compact('orderData', 'orderNew'));
    }

}
