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
            ->first();

        // dd($user);

        if (!$user || !$user->isAdmin()) {
            // 如果用户不是管理员，可以根据需要重定向到其他路由或返回错误页面
            return redirect()->route('login');
        }

        $request->session()->flash('user', $user);
        // 执行请求
        return $next($request);
    }
}
