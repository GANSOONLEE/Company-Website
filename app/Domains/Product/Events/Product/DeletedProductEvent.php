<?php

namespace App\Domains\Product\Events\Product;

use \App\Domains\Product\Events\Notification\ProductDeletedNotification;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeletedProductEvent{

    public function deleteProduct(Request $request)
    {
        try {
            $product = Product::where('productID', $request->productID)->first();

            $productID = $request->input('productID');
            $productCatelog = $product->productCatelog;
            
            Storage::disk('product')->deleteDirectory("$productCatelog/$productID");

            $product->delete();    

        } catch (\Exception $err) {

        }
        
        return redirect()->back();
    }

    public function showAlert($message, $type = 'info')
    {
        session()->flash('alert', [
            'type' => $type,
            'message' => $message
        ]);
    }
}