<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    function generateAccessToken()
{
    // 生成随机字符串作为 accessToken
    return Str::random(32);
}
    public function register(Request $request)
    {
        // 生成 accessToken
        $accessToken = $this->generateAccessToken();

        // 创建用户
        $data = [
            'Name' => $request->input('name'),
            'Phone Number' => $request->input('phone'),
            'Email' => $request->input('email'),
            'Birthday' => $request->input('birthday'),
            'Address' => $request->input('address'),
            'Profession' => $request->input('occupation'),
            'Store / Company Name' => $request->input('store_name'),
            'Password' => Hash::make($request->input('password')),
            'AccessToken' => $accessToken,
        ];
        
        User::create($data);        

        // 将 accessToken 存储在用户的 cookie 中
        // 这里使用 Laravel 的 Cookie facade 进行示例
        cookie()->queue('access_token', $accessToken, 0); // 永久保存

        // 将电子邮件存储在用户的 cookie 中
        cookie()->queue('email', $data['Email'], 0);

        // 自动登录逻辑，可以根据实际需求进行处理

        // 重定向到后台或其他页面
        return redirect()->back();
    }

    public function login(Request $request){
        
        // 获取登录表单数据
        $data = [
            'Email' => $request->input('email'),
            'Password' => $request->input('password'),
        ];

        // 根据 email 查询用户
        $user = User::where('Email', $data['Email'])->first();

        if ($user && Hash::check($data['Password'], $user->Password)) {
            // 登录成功，生成新的 accessToken
            $newAccessToken = $this->generateAccessToken();
            $updateData = [
                'AccessToken' => $newAccessToken,
            ];

            // 更新用户的 accessToken
            User::updateUser($request->input('email'), $updateData);

            // 将新的 accessToken 存储在用户的 cookie 中
            // 这里使用 Laravel 的 Cookie facade 进行示例
            cookie()->queue('accessToken', $newAccessToken, 60*24*180); // 永久保存
            cookie()->queue('email', $data['Email'], 60*24*180);

            // 重定向到后台或其他页面
            return redirect()->route('admin.dashboard');
        } else {
            // 登录失败，重定向到登录界面或返回错误信息
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }


    public function dashboard(Request $request)
    {
        // 从 cookie 中获取用户的 email 和 accessToken
        $email = $request->cookie('email');
        $accessToken = $request->cookie('accessToken');

        // 根据 email 和 accessToken 查询用户
        $user = User::where('Email', $email)->where('AccessToken', $accessToken)->first();

        if ($user) {
            if($user->Role == 'admin'){
                // 管理員
                return view('admin.dashboard');
            }else{
                // 登入的用戶
                return redirect()->route('login');
            }
        } else {
            // 用户验证失败，重定向到登录界面或其他处理
            return redirect()->route('login');
        }
    }
}
