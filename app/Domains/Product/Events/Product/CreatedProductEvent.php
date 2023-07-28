<?php

namespace App\Domains\Product\Events\Product;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreatedProductEvent{

    public function createProduct(Request $request){

        $primaryBrand = $request->input('primaryBrand');
        $primaryModel = $request->input('primaryModel');
        $productName = $primaryBrand . ' ' . $primaryModel;

        $secondaryBrand = $request->input('secondaryBrand');
        $secondaryModel = $request->input('secondaryModel');
        $productCode = $request->input('productCode');
        $productCatelog = $request->input('productCatelog');

        foreach ($request->file('images') as $index => $image) {
            $fileName = $index === 0 ? 'cover.png' : $image->getClientOriginalName();
    
            Storage::disk('product')->put(
                "$productCatelog/$primaryModel/$productCode/$fileName",
                file_get_contents($image)
            );
        }

       
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
            'productSubname' => $jsonData,
            'productCode' => $productCode,
            'productCatelog' => $productCatelog,
            'productModel' => strtoupper($primaryModel),
            'productBrand' => strtoupper($primaryBrand),
            'productType' => $request->input('productType'),
        ];
        
        $product = Product::create($data);

        /**
         *  从数据库读取 productID 并回传给 createdImageGroupEvent 
         * 
         */

        return back();

    }
}