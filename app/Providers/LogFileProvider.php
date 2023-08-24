<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LogFileProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('Log', function () {
            return new \Illuminate\Support\Facades\Log();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
