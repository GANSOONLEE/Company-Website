<?php

namespace App\Http\Middleware;

use App\Models\Order;
use App\Models\Product;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class AdminMiddleware
{
    
    public function handle($request, Closure $next)
    {
        $email = Cookie::get('email');
        $accessToken = Cookie::get('access_token');
        $orderNew = Order::where('order_status', 'New')
            ->count();
    
        // 在数据库中查找与 cookie 中的电子邮件匹配的用户
        $user = User::where('email_address', $email)
            // ->where('AccessToken', $accessToken)
            ->where('role', 'admin')
            ->first();
    
        if (!$user) {
            return redirect()->route('frontend.login');
        }
    
        $request->session()->flash('user', $user);
    
        if ($user->isAdmin() && $request->is('admin*')) {
            Auth::login($user, false); // 将用户实例登录到内置身份验证系统中
            $request->session()->put('orderNew', $orderNew); // 将$productDelist保存到Session中
            return $next($request);
        }
    
        return redirect()->route('frontend.login');
    }
    
}
