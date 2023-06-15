<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        $lang = $request->query('lang') ?: Cookie::get('lang', 'en');
        App()->setLocale($lang);
        
        return $next($request);
    }
}
