<?php

namespace App\Domains\Auth\Events;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\UserOperation;
use Illuminate\Http\Request;

class RestoreRecordEvent extends Controller{
    public function restoreRecord(Request $request){
        
        try{
            $id = $request->id;
            $operationID = $request->operationID;

            $operation = UserOperation::where('operationID', $operationID)->first();
            $operation->delete();
    
            $product = Product::withTrashed()->where('productID', $id)->first();
            $product->restore();

            $status = ['success' => 'success'];
        }catch(\Exception $e){
            $status = ['error' => $e->getMessage()];
        }

        return response()->json($status);
    }
}