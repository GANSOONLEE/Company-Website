<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        $language = $request->query('language') ?: Cookie::get('language', 'en');
        App::setLocale($language);

        if ($request->is('admin/*')) {
            Cookie::queue(Cookie::make('language', $language, 60*24*180, '/admin'));
        }

        return $next($request);
    }
}
