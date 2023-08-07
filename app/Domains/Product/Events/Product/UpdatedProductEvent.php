<?php

namespace App\Domains\Product\Events\Product;

use App\Models\Product;
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

            $productID = $request->input('productID');
            $productCatelog = $request->input('productCatelog');
            $productType = $request->input('productType');
            $productStatus = $request->input('productStatus');

            $product = Product::where('productID', $productID)->first();

            if ($product) {
                
                $product->update([
                    'productNameList' => array_filter($productNameCarModel),
                    'productBrandList' => array_filter($productBrandList),
                    'productCatelog' => $productCatelog,
                    'productType' => $productType,
                    'productStatus' => $productStatus,
                ]);

                $this->showAlert(trans('product.success'), 'success');
                return redirect()->back();

            } else {
                $this->showAlert(trans('product.warning'), 'warning');
                return redirect()->back();
            }

        } catch (QueryException $err) {
            $this->showAlert(trans('product.duplicate'), 'warning');
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
