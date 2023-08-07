<?php

namespace App\Domains\Product\Observer;

use App\Models\Product;
use App\Domains\Product\Events\Product\CreatedProductEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ProductCreatedNotification extends Controller
{

    public function newProductUpload()
    {
        $productStatusDelistCount = Product::where('productStatus', 'Delist')
            -> count();

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $pusher->trigger('sidebar', 'product-delist-event', ['productStatusDelistCount' => $productStatusDelistCount]);
    }
}