<?php

namespace App\Domains\Product\Events\Product;

use App\Models\Product;
use App\Models\Operation;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Domains\Product\Observer\ProductCreatedNotification;

class UpdatedProductEvent{

    public function updateProduct(Request $request){

        try {

            /**
             * productNameList
             * 
             */

            #region

            $productNameCarModel = $request->input('productNameList-CarModel');
            #endregion

            /**
             * productBrandList
             * 
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
                if(!$brand){
                    $brand = null;
                }
                if(!$fzcode){
                    $fzcode = null;
                }
                $carBrand = [
                    'code' => $code,
                    'brand' => $brand,
                    'fzcode' => $fzcode,
                ];
                $productBrandList[] = array_filter($carBrand);
            }

            $productID = $request->input('product_id');
            $productCatelog = $request->input('productCategory');
            $productType = $request->input('productType');
            $productStatus = $request->input('productStatus');

            $product = Product::where('product_id', $productID)->first();

            if ($product) {
                
                $product->update([
                    'product_name_list' => array_filter($productNameCarModel),
                    'product_brand_list' => array_filter($productBrandList),
                    'product_category' => $productCatelog,
                    'product_type' => $productType,
                    'product_status' => $productStatus,
                ]);

                $operation = [
                    'email_address' => auth()->user()->email_address,
                    'operation_data' => [
                        'product' => $productID,
                    ],
                    'operation_type' => 'Update Product',
                ];
    
                Operation::create($operation);

                $this->showAlert(trans('product.success'), 'success');
                return redirect()->back();

            } else {
                $this->showAlert(trans('product.warning'), 'warning');
                return redirect()->back();
            }

        } catch (QueryException $err) {
            // $this->showAlert(trans('product.duplicate'), 'warning');
            
            return redirect()->back();
        }   
    }

    public function showAlert($message, $type = 'info')
    {
        session()->flash('alert', [
            'type' => $type,
            'message' => $message
        ]);
    }

}
