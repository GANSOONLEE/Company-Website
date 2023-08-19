<?php

namespace App\Domains\Product\Events\Product;

use App\Http\Controllers\backend\ProductController;

use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class SearchedProductEvent{

    public function searchProductByModal(Request $request){

        try{

            $status = [
                'success' => 'success',
                'debug' => $request-> filter,
            ];

        }catch(\Exception $e){
            $status = [
                'code' => $e->getCode(),
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($status);

    }
}