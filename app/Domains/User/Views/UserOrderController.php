<?php

namespace App\Domains\User\Views;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller{

    public function order(Request $request){

        $email = auth()->user()->Email;
        $status = $request->status ?? 'New'; // 如果沒有提供狀態，默認為 'New'

        $orderData = Order::where('email', $email)
            ->when($status === 'In Process', function ($query) {
                // 如果狀態為 'In Process'，包括 'In Process' 和 'Pending' 的訂單
                return $query->whereIn('orderStatus', ['In Process', 'Pending']);
            })
            ->when($status !== 'In Process', function ($query) use ($status) {
                // 其他狀態，只查詢指定狀態的訂單
                return $query->where('orderStatus', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.user.order.order', compact('orderData'));
    }
}