<?php

namespace App\Domains\Product\Events\Product;

use \App\Domains\Product\Events\Notification\ProductDeletedNotification;
use App\Models\Product;
use App\Models\User;
use App\Models\UserOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeletedProductEvent{

    public function deleteProduct(Request $request)
    {
        try {
            $product = Product::where('productID', $request->productID)->first();

            $productID = $request->input('productID');
            $productCatelog = $product->productCatelog;
            
            // Storage::disk('product')->deleteDirectory("$productCatelog/$productID");

            $email = $request->input('email');
            $user = User::where('Email', $email)->first();

            $operation = [
                'userID' => $user->Name,
                'operationType' => 'Delete Product',
                'ID' => $request->productID,
            ];

            UserOperation::create($operation);

            $product->delete();

            $status = [
                'success' => 'success',
            ];

        } catch (\Exception $err) {
            $status = [
                'error' => $err->getMessage(),
                'debug' => $request->input('email'),
            ];
        }
        
        return response()->json($status);
    }

    public function showAlert($message, $type = 'info')
    {
        session()->flash('alert', [
            'type' => $type,
            'message' => $message
        ]);
    }
}