<?php

namespace App\Domains\Product\Events\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

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
        
        // 获取上传的照片文件
        $photo = $request->file('productImage');

        // 目标高度
        $targetHeight = 900;

        // 打开图像并等比例缩小
        $image = Image::make($photo)->heighten($targetHeight, function ($constraint) {
            $constraint->upsize();
        });

        // 将图像转换为 Base64 编码
        $encodedImage = $image->encode('data-url');

        // 从请求中获取用户输入的值并创建新产品
        $data = [
            'productName' => strtoupper($productName),
            'productCode' => $request->input('productCode'),
            'productCatelog' => $request->input('productCatelog'),
            'productSubname' => $jsonData,
            'productModel' => strtoupper($primaryModel),
            'productBrand' => strtoupper($primaryBrand),
            'productType' => $request->input('productType'),
            'productImage' => $encodedImage, // 上传的产品图像文件
        ];

        // dd($data);

        Product::createProduct($data);

        return back();

    }
}