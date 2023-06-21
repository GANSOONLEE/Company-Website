<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $email = Cookie::get('email');
        $accessToken = Cookie::get('accessToken');

        // 在数据库中查找与 cookie 中的电子邮件匹配的用户
        $user = User::where('Email', $email)
            ->where('AccessToken', $accessToken)
            ->where('Role', 'admin')
            ->first();

        if(!$user){
            return redirect()->route('frontend.login');
        }

        $request->session()->flash('user', $user);
        
        if ($user->isAdmin() && $request->is('admin*')) {
            return $next($request);
        }

        return redirect()->route('frontend.login');
        
    }
}
