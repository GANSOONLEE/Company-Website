<?php

namespace App\Domains\User\Views;
use App\Http\Controllers\Controller;
use App\Models\Order;

class UserOrderController extends Controller{

    public function order(){

        $email = auth()->user()->Email;

        $orderData = Order::where('Email', $email)
            -> get();

        return view('backend.user.order.order', compact('orderData'));
    }
}