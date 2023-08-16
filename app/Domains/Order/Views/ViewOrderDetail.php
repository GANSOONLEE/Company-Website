<?php

namespace App\Domains\Order\Views;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ViewOrderDetail extends Controller{

    public function viewOrderDetail(Request $request)
    {

        /** @de */
        $orderData = Order::where('orderID', $request->orderID)
                        ->first();

        $products = json_decode($orderData->orderContent);
        $productData = [];
        
        // Unit Test
        foreach($products as $product){
            $productElement = Product::where('productID', $product->id)
                ->orderBy('productCatelog', 'asc')
                ->first();
            $productData[] = [$productElement , $product->quantity];
        }

        $productCatelogs = [];
        foreach ($productData as $productItem) {
            $productCatelogs[] = $productItem[0]->productCatelog;
        }

        array_multisort($productCatelogs, SORT_ASC, $productData);
        
        return view('backend.user.order.orderDetail', compact('orderData', 'productData'));
    }

}