<?php

namespace App\Domains\Product\Events\Product;

use App\Http\Controllers\backend\ProductController;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use function PHPUnit\Framework\isNull;

class SearchedProductEvent{

    public function searchProductByModal(Request $request){

        try{

            /** Define variable */
            $category = $request->productCategory;
            $type = $request->productType;
            $brand = $request->productName;

            /** Global Array */
            $brands = Brand::all();

            $query = Product::query();

            if (!empty($type)) {
                $query->whereIn('product_type', $type);
            }

            if (!empty($brand)) {
                $query->searchByName($brand);
            }

            $productData = $query->where('product_category',"$category")->get();

            // $status = [
            //     'success' => 'success',
            //     'type' => $request->productType,
            //     'brand' => $request->productName,
            //     'product' => $productData,
            // ];

            return View::make('frontend.product', [
                    'productData' => $productData
                ],[
                    'brands' => $brands
                ]
                )->render();

        }catch(\Exception $e){
            $status = [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($status);
        // return view('frontend.product', ['products' => $productData]);

    }
}