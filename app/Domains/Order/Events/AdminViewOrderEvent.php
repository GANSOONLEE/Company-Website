<?php

namespace App\Domains\Order\Events;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminViewOrderEvent{

    public function adminViewOrder(Request $request, $orderID){
        
        $order = Order::where('order_id', $orderID)
            ->first();

        if($order->order_status == 'Pending'){
            $order->update([
                'order_status' => 'Processing'
            ]);
        }

        $products = json_decode($order->order_content);
        $productData = [];
        
        // Unit Test
        foreach($products as $product){
            $productElement = Product::where('product_id', $product->id)
                ->orderBy('product_category', 'asc')
                ->first();
            $productData[] = [$productElement , $product];
        }

        // $data = ['productData' => $order];
        // return response()->json($data);

        $productCatelogs = [];
        foreach ($productData as $productItem) {
            $productCatelogs[] = $productItem[0]->productCatelog;
        }

        array_multisort($productCatelogs, SORT_ASC, $productData);

        $orderNew = session('orderNew');

        return view('backend.admin.viewOrderDetail', compact('order', 'orderNew', 'productData'));
    }

}