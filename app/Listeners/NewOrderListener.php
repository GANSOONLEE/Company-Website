<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;


class NewOrderListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        // Log::info('NewOrderListener are set.'); // 添加此行
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // Log::info('NewOrderListener received an event.'); // 添加此行
        // Log::info($event->orderNewCount);

        Broadcast::channel('create-order-channel', function () use ($event) {
            return $event->orderNewCount;
        });
    }
}
