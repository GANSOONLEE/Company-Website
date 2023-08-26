<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        $email = Cookie::get('email_address');
        $access_token = Cookie::get('access_token');

        $user = User::where('email_address', $email)
            // ->where('access_token', $access_token) //禁止單一賬號從多個地方登入
            ->first();

        $request->session()->flash('username', $user);
        
        if(($user->isUser() || $user->isAdmin()) && $request->is('user*')){
            Auth::login($user);
            return $next($request);
        }
        return redirect()->route('frontend.login');
        
    }
}
