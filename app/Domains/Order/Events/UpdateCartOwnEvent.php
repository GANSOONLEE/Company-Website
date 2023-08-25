<?php

namespace App\Domains\Order\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class UpdateCartOwnEvent extends Controller{
    
    public function updateOwnCart(Request $request){

        try{
            $orderID = $request->input('orderID');
            $product_code = $request->input('product_code');
            $product_brand_code = $request->input('product_brand_code');
            $own = $request->input('own');

            $order = Order::where('orderID', $orderID)->first();

            $orderContentArray = json_decode($order->orderContent, true); // 將 JSON 轉換為陣列

            foreach ($orderContentArray as &$item) {
                if ($item['product_code'] === $product_code && $item['product_brand_code'] === $product_brand_code) {
                    $item['own'] = $own;
                    break;
                }
            }
            
            // 將陣列轉換回 JSON 字串
            $newOrderContent = json_encode($orderContentArray);
            
            // 使用 update 方法更新資料庫中的記錄
            $order->update(['orderContent' => $newOrderContent]);

            $data = [
                'status' => 'success',
                'item' => $item,
            ];
            
        }catch(\Exception $e){

            $data = [
                'status' => $e->getMessage(),
            ];

        }

        return response()->json($data);
    }

}