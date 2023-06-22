<?php

namespace App\Domains\Product\Events\Product;

use \App\Domains\Product\Events\Notification\ProductDeletedNotification;
use App\Models\Product;

class DeletedProductEvent{

    public function destroy($productID)
    {
        try {
            // 刪除指定的產品
            $product = Product::findOrFail($productID);
            $product->delete();

            // 成功刪除產品的翻譯訊息
            $message = trans('delete.success');
            $type = 'success';

            $notification = new ProductDeletedNotification($message, $type);
            $notification = $notification->getResult();
        } catch (\Exception $e) {

            // 錯誤訊息的翻譯訊息
            $message = trans('delete.warning');
            $type = 'warning';

            $notification = new ProductDeletedNotification($message, $type);
            $notification = $notification->getResult();
            
        }

        // 重定向到產品列表頁面或其他適當的頁面，並將通知物件傳遞給視圖
        return redirect()->route('backend.admin.dashboard')->with('notification', $notification);
    }

}