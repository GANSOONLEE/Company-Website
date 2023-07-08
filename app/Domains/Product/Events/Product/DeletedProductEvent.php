<?php

namespace App\Domains\Product\Events\Product;

use \App\Domains\Product\Events\Notification\ProductDeletedNotification;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DeletedProductEvent{

    public function destroy($productID)
    {

        try {
            $product = Product::findOrFail($productID);

            

            $productCatelog = $product->productCatelog;
            $primaryModel = $product->productModel;
            $productCode = $product->productCode;
            
            Storage::disk('product')->deleteDirectory("$productCatelog/$primaryModel/$productCode");

            $product->delete();

            $message = trans('delete.success');
            $type = 'success';


        } catch (\Exception $e) {

            $message = trans('delete.warning');
            $type = 'warning';
            
        }

        return redirect()->back();
    }
}