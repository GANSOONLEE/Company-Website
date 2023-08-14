<?php

namespace App\Domains\User\Views;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller{

    public function order(Request $request){

        $email = auth()->user()->Email;
        if(!$request->status){
            $status = 'New';
        }else{
            $status = $request->status;
        }

        $orderData = Order::where('Email', $email)
            -> where('orderStatus', $status)
            -> orderBy('created_at', 'desc')
            -> get();

        return view('backend.user.order.order', compact('orderData'));
    }
}