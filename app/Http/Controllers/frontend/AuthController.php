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
            'username' => $request->input('username'),
            'phone_number' => $request->input('phone_number'),
            'email_address' => $request->input('email_address'),
            'birthday' => $request->input('birthday'),
            'address' => $request->input('address'),
            'profession' => $request->input('profession'),
            'company_name' => $request->input('company_name'),
            'password' => Hash::make($request->input('password')),
            'access_token' => $accessToken,
        ];
        
        User::create($data);        

        cookie()->queue('access_token', $accessToken, 0, null, null, false, false, True);
        cookie()->queue('email', $data['email_address'], 0, null, null, false, false, True);

        return redirect()->back();
    }

    public function login(Request $request){
        
        $data = [
            'email_address' => $request->input('email_address'),
            'password' => $request->input('password'),
        ];

        $user = User::where('email_address', $data['email_address'])->first();

        if ($user && Hash::check($data['password'], $user->Password)) {

            $newAccessToken = $this->generateAccessToken();

            $updateData = ['access_token' => $newAccessToken,];

            User::updateUser($request->input('email_address'), $updateData);

            cookie()->queue('access_token', $newAccessToken, 60*24*180, null, null, false, false);
            cookie()->queue('email_address', $data['email_address'], 60*24*180, null, null, false, false);

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
            ->withCookie(Cookie::forget('email_address'))
            ->withCookie(Cookie::forget('access_token'));

        Auth::logout();

        return $response;
    }
}
