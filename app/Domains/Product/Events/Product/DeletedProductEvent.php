<?php

namespace App\Domains\Product\Events\Product;

use \App\Domains\Product\Events\Notification\ProductDeletedNotification;
use App\Models\Product;

class DeletedProductEvent{

    public function destroy($productID)
    {
        try {
            $product = Product::findOrFail($productID);
            $product->delete();

            $message = trans('delete.success');
            $type = 'success';

            $notification = new ProductDeletedNotification($message, $type);
            $notification = $notification->getResult();
        } catch (\Exception $e) {

            $message = trans('delete.warning');
            $type = 'warning';

            $notification = new ProductDeletedNotification($message, $type);
            $notification = $notification->getResult();
            
        }

        return redirect()->route('backend.admin.dashboard')->with('notification', $notification);
    }

}