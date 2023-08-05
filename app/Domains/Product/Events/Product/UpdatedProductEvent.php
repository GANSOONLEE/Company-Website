<?php

namespace App\Domains\Product\Events\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class UpdatedProductEvent{

    public function updateProduct(Request $request){

        try {

            //

            $productID = $request->input('productID');
            $productCatelog = $request->input('productCatelog');
            $productType = $request->input('productType');
            $productStatus = $request->input('productStatus');

            $product = Product::where('productID', $productID)->first();

            if ($product) {
                
                $product->update([
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
