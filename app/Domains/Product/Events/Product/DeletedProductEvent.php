<?php

namespace App\Domains\Product\Events\Product;

use \App\Domains\Product\Events\Notification\ProductDeletedNotification;
use App\Models\Product;
use App\Models\User;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeletedProductEvent{

    public function deleteProduct(Request $request)
    {
        try {
            $product = Product::where('product_id', $request->productID)->first();

            $productID = $request->input('productID');
            // $productCatelog = $product->productCatelog;
            
            // Storage::disk('product')->deleteDirectory("$productCatelog/$productID");

            $email = $request->input('email');
            $user = User::where('email_address', $email)->first();

            $operation = [
                'email_address' => $user->email_address,
                'operation_type' => 'delete product',
                'operation_data' => [
                    'product' => $productID,
                ],
            ];

            Operation::create($operation);

            $product->delete();

            $status = [
                'success' => 'success',
            ];

        } catch (\Exception $err) {
            $status = [
                'error' => $err->getMessage(),
                'file' => $err->getFile(),
                'line' => $err->getLine(),
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