<?php

namespace App\Domains\Order\Events;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminViewOrderEvent{

    public function adminViewOrder(Request $request, $orderID){
        
        $order = Order::where('orderID', $orderID)
            ->first();

        if($order->orderStatus == 'Received'){
            $order->update([
                'orderStatus' => 'In Process'
            ]);
        }

        $products = json_decode($order->orderContent);
        $productData = [];
        
        // Unit Test
        foreach($products as $product){
            $productElement = Product::where('productID', $product->id)
                ->orderBy('productCatelog', 'asc')
                ->first();
            $productData[] = [$productElement , $product];
        }

        $productCatelogs = [];
        foreach ($productData as $productItem) {
            $productCatelogs[] = $productItem[0]->productCatelog;
        }

        array_multisort($productCatelogs, SORT_ASC, $productData);

        $orderNew = session('orderNew');

        return view('backend.admin.viewOrderDetail', compact('order', 'orderNew', 'productData'));
    }

}