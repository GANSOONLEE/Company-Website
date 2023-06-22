<?php

namespace App\Domains\Product\Events\Notification;

class ProductDeletedNotification{

    private $message;
    private $type;

    public function __construct(string $message = null, string $type = null){
        $this->message = $message;
        $this->type = $type;
    }

    public function getResult(): array{
        $result = [
            'message' => $this->message,
            'type' => $this->type,
        ];

        return $result;
    }

    public function notify(){
        dd('notification!');
    }

}