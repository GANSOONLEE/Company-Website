<?php

namespace App\Domains\Product\Events\Product;

use App\Models\Product;
use App\Models\Image;

use App\Domains\Product\Services\Image\ImageGroupService;
use Illuminate\Http\Request;

class CreatedProductEvent{

    public function createProduct(Request $request){


        $primaryBrand = $request->input('primaryBrand');
        $primaryModel = $request->input('primaryModel');
        $productName = $primaryBrand . ' ' . $primaryModel;

        $secondaryBrand = $request->input('secondaryBrand');
        $secondaryModel = $request->input('secondaryModel');
        
        $combinedArray = [];
        if (isset($secondaryBrand, $secondaryModel)) {

            foreach ($secondaryBrand as $key => $brand) {
                $model = $secondaryModel[$key];
                $combinedArray[] = [
                    'brand' => strtoupper($brand),
                    'model' => strtoupper($model)
                ];
            }
            $jsonData = json_encode($combinedArray);
        } else {
            $jsonData = '';
        }

        $data = [
            'productName' => strtoupper($productName),
            'productCode' => $request->input('productCode'),
            'productCatelog' => $request->input('productCatelog'),
            'productSubname' => $jsonData,
            'productModel' => strtoupper($primaryModel),
            'productBrand' => strtoupper($primaryBrand),
            'productType' => $request->input('productType'),
        ];
        
        $product = Product::create($data);

        /**
         *  从数据库读取 productID 并回传给 createdImageGroupEvent 
         * 
         */
        $retrievedProduct = Product::where('productCode', $data['productCode'])->first();
        $retrievedProductID = $retrievedProduct->productID;

        $createdImageGroupEvent = new ImageGroupService;
        $createdImageGroupEvent->create($request, $retrievedProductID);

        return back();

    }
}