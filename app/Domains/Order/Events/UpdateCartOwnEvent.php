<?php

namespace App\Domains\Order\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class UpdateCartOwnEvent extends Controller{
    
    public function updateOwnCart(Request $request){

        try{
            $orderID = $request->input('orderID');
            $brand = $request->input('brand');
            $own = $request->input('own');

            $order = Order::where('order_id', $orderID)->first();

            $orderContentArray = json_decode($order->order_content); // 將 JSON 轉換為陣列

            $debug = '';

            foreach ($orderContentArray as &$item) {
                if ($item->brand === $brand) {
                    $item->own = $own;
                    break;
                }
            }
            
            // 將陣列轉換回 JSON 字串
            $newOrderContent = json_encode($orderContentArray);
            
            // 使用 update 方法更新資料庫中的記錄
            $order->update(['order_content' => $newOrderContent]);

            $data = [
                'status' => 'success',
            ];
            
        }catch(\Exception $e){

            $data = [
                'status' => $e->getMessage(),
            ];

        }

        return response()->json($data);
    }

}