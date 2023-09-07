<?php

namespace App\Domains\Product\Events\Product;


use App\Models\Operation;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreatedProductEvent{

    public function createProduct(Request $request){


        /**
         * productNameList
         * @param car,model
         */

        #region

        $productNameCars = $request->input('productNameList-Car');
        $productNameModels = $request->input('productNameList-Model');

        $productNameList = [];
        
        foreach($productNameCars as $index => $productNameCar){
            $car = $productNameCar;
            $model = $productNameModels[$index];
            $carModel = $car . ' ' . $model;
            $productNameList[] = strtoupper($carModel);
        }

        #endregion

        /**
         * productBrandList
         * @param code,brand,FZcode
         */

        #region

        $productBrandCodes = $request->input('productBrandList-Code');
        $productBrandBrands = $request->input('productBrandList-Brand');
        $productBrandFZcodes = $request->input('productBrandList-FZcode');

        $productBrandList = [];

        foreach($productBrandCodes as $index => $productBrandCode){
            $code = $productBrandCode;
            $brand = $productBrandBrands[$index];
            $fzcode = $productBrandFZcodes[$index];
            $carBrand = [
                'code' => $code,
                'brand' => $brand,
                'fzcode' => $fzcode,
            ];
            $productBrandList[] = $carBrand;
        }

        #endregion

        $productCatelog = $request->input('productCatelog');
            $productType = $request->input('productType');
            $productID = $this->generateProductID();

        $uploadedFiles = $request->allFiles();

        // dd($uploadedFiles);

        // $array = [];

        foreach ($uploadedFiles['uploadFiles'] as $index => $image) {
            $fileName = $index === 0 ? 'cover.png' : $image->getClientOriginalName();
            // $array[] = $image;

            $directory = "$productCatelog/$productID/$fileName";

            Storage::disk('product')->put(
                $directory,
                file_get_contents($image)
            );
        }

        foreach ($uploadedFiles['image-brand'] as $index => $brand_image){

            $fileName = 'brand.png';

            // if(!isset($productBrandList[$index])){
            //     break;
            // }

            $brand = $productBrandList[$index]['code'];

            $directoryBrandImage = "$productCatelog/$productID/$brand/$fileName";

            Storage::disk('product')->put(
                $directoryBrandImage,
                file_get_contents($brand_image)
            );

        }

        try{
            $data = [
                'product_id' => $productID,
                'product_category' => $productCatelog,
                'product_type' => $productType,
                'product_name_list' => json_encode($productNameList),
                'product_brand_list' => json_encode($productBrandList,)
            ];

            Product::create($data);

            $operation = [
                'email_address' => auth()->user()->email_address,
                'operation_data' => [
                    'product' => $productID,
                ],
                'operation_type' => 'Create Product',
            ];

            Operation::create($operation);

            $this->showAlert('Data sent successfully!', 'success');

        } catch (\Exception $e) {
            $this->showAlert('Error occurred while sending data: ' . $e->getMessage(), 'danger');
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

    function generateProductID(): string {
        $productId = Str::random(12); // 產生指定長度(12)的字串
    
        // 檢查是否已經存在相同的產品ID
        $productIdAlreadyHave = Product::where('product_id', $productId)->exists();
    
        if ($productIdAlreadyHave) {
            // 如果已經有相同的產品ID，則重新生成一個新的ID
            return $this->generateProductID();
        }
    
        return $productId;
    }
}