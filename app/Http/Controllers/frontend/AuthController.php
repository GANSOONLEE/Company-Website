<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    function generateAccessToken()
{
    // 隨機的32位亂碼 accessToken
    return Str::random(32);
}
    public function register(Request $request)
    {
        $accessToken = $this->generateAccessToken();

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

        cookie()->queue('access_token', $accessToken, 0);
        cookie()->queue('email', $data['Email'], 0);

        return redirect()->back();
    }

    public function login(Request $request){
        
        $data = [
            'Email' => $request->input('email'),
            'Password' => $request->input('password'),
        ];

        $user = User::where('Email', $data['Email'])->first();

        if ($user && Hash::check($data['Password'], $user->Password)) {

            $newAccessToken = $this->generateAccessToken();

            $updateData = ['AccessToken' => $newAccessToken,];

            User::updateUser($request->input('email'), $updateData);

            cookie()->queue('accessToken', $newAccessToken, 60*24*180);
            cookie()->queue('email', $data['Email'], 60*24*180);

            Auth::login($user, false);

            return redirect()->route('backend.admin.dashboard');
        } else {
            return redirect()->route('frontend.login')->with('error', 'Invalid credentials');
        }
    }

    public function dashboard(Request $request){

        $email = $request->cookie('email');
        $accessToken = $request->cookie('accessToken');

        $user = User::where('Email', $email)->where('AccessToken', $accessToken)->first();

        if ($user) {
            if($user->Role == 'admin'){

                // 身分組為管理員的邏輯
                return view('background.admin.dashboard');
            }else{

                // 身分組為普通用戶的邏輯
                return redirect()->route('frontend.login');
            }
        } else {
            return redirect()->route('frontend.login');
        }
    }

    function logout(Request $request){

        $response = back()
            ->withCookie(Cookie::forget('email'))
            ->withCookie(Cookie::forget('accessToken'));

        Auth::logout();

        return $response;
    }
}
