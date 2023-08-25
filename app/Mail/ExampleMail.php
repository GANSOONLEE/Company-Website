<?php

namespace App\Mail;

use Illuminate\Http\JsonResponse;
use Illuminate\Mail\Mailable;

class ExampleMail extends Mailable
{
    public function build()
    {
        
        try{
            return $this
                ->subject('這是一封示例郵件')
                ->markdown('emails.subscribers');

        }catch(\Exception $e){
            return new JsonResponse(
                [
                    'success' => false, 
                    'message' => $e->getMessage()
                ], 
                500
            );
        }
    }
}
