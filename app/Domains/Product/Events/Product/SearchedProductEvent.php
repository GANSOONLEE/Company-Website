<?php

namespace App\Domains\Product\Events\Product;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchedProductEvent{

    public function searchProductByModal(Request $request){

        $results = Product::whereIn('modal', $request->input('modal'))->get();

        // 返回 JSON 格式的数据
        return response()->json($results);
    }

}