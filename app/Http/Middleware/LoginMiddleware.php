<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $email = Cookie::get('email');
        $accessToken = Cookie::get('accessToken');
    
        // 在数据库中查找与 cookie 中的电子邮件匹配的用户
        $user = User::where('Email', $email)
            // ->where('AccessToken', $accessToken)
            ->first();
        
        if($user){
            $request->session()->flash('user', $user);
            Auth::login($user, false); // 将用户实例登录到内置身份验证系统中
        }
        return $next($request);
    }
}
