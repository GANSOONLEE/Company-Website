<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        $email = Cookie::get('email');
        $accessToken = Cookie::get('accessToken');

        $user = User::where('Email', $email)
            ->where('AccessToken', $accessToken)
            ->first();

        $request->session()->flash('user', $user);
        
        if(($user->isUser() || $user->isAdmin()) && $request->is('user*')){
            return $next($request);
        }
        return redirect()->route('frontend.login');
        
    }
}
