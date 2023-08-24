<?php

namespace App\Domains\Order\Views;
use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ViewOrder{

    function viewOrder(){

        $orderData = Order::orderBy('updated_at', 'desc')
            ->get();

        $orderNew = session('orderNew');

        return View('backend.admin.viewOrder', compact('orderData', 'orderNew'));
    }

}
