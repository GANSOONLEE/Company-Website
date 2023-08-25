<?php

namespace App\Http\Controllers;

use App\Mail\ExampleMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller{

    public function sendEmail(Request $request)
    {
        try{
            
            $recipientEmail = $request->email;
            
            Mail::to($recipientEmail)->send(new ExampleMail());

            return new JsonResponse(
                [
                    'success' => true, 
                    'message' => "Thank you for subscribing to our email, please check your inbox"
                ], 
                200
            );

        }catch(\Exception $e){
            return new JsonResponse(
                [
                    'success' => false, 
                    'message' => $e->getMessage()
                ], 
                200
            );
        }
    }

}

