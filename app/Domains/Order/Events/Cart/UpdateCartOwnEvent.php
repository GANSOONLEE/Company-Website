<?php

namespace App\Domains\Order\Events\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

class UpdateCartOwnEvent extends Controller{
    
    public function updateOwnCart(Request $request){

        try{
            $orderID = $request->input('orderID');
            $cartID = $request->input('cartID');
            $own = $request->input('own');

            $order = Order::where('orderID', $orderID)->first();

            $orderContentArray = json_decode($order->orderContent, true); // 將 JSON 轉換為陣列

            foreach ($orderContentArray as &$item) {
                if ($item['cartID'] === $cartID) {
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