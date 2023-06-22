<?php

namespace App\Domains\Product\Events\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class UpdatedProductEvent{

    public function updateProduct(Request $request, $productID){

        try {
            
            $auth = Product::where('productID', $productID)
                    ->get('productCode');

            if($auth != substr($request->input('productCode'), 0, 255)){
                
            }

            $data = [
                'productName' => substr($request->input('productName'), 0, 255),
                'productCode' => substr($request->input('productCode'), 0, 255),
                'productCatelog' => $request->input('productCatelog'),
                'productModel' => $request->input('productModel'),
                'productBrand' => $request->input('productBrand'),
                'productType' => $request->input('productType'),
            ];
            Product::updateProduct($productID, $data);
        
            $alertType = 'success';
            $message = trans("product.success");

        } catch (QueryException $err) {

            $alertType = 'warning';

            $errorCode = $err->getCode();
            if ($errorCode === '23000') {
                $errorMsg = trans("product.duplicate");
            }else{
                $errorMsg = $err->getMessage();
            }
            
            $message = trans("product.warning") . $errorMsg;
        }
        
        return redirect()->back()->with('alertType', $alertType)->with('message', $message);       
    }

}
