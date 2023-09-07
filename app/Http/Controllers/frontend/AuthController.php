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
            'phone_number_whatapps' => $request->input('phone_number_whatapps'),
            'email_address' => $request->input('email_address'),
            'birthday' => $request->input('birthday'),
            'address' => $request->input('address'),
            'profession' => $request->input('profession'),
            'company_name' => $request->input('company_name'),
            'password' => Hash::make($request->input('password')),
            'access_token' => $accessToken,
        ];
        
        $user = User::create($data);        

        cookie()->queue('access_token', $accessToken, null, false, false, false, false);
        cookie()->queue('email_address', $data['email_address'], null, false, false, false, false);

        Auth::login($user);

        return redirect()->route('backend.user.cart');
    }

    public function login(Request $request){
        
        $data = [
            'email_address' => $request->input('email_address'),
            'password' => $request->input('password'),
        ];

        $user = User::where('email_address', $data['email_address'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {

            $newAccessToken = $this->generateAccessToken();

            $updateData = ['access_token' => $newAccessToken,];

            User::updateUser($request->input('email_address'), $updateData);

            if(config('website.multi_subdomains')){
                cookie()->queue('access_token', $newAccessToken, 60*24*180, '/', 'frozen.com', false, false);
                cookie()->queue('email_address', $data['email_address'], 60*24*180, '/', 'frozen.com', false, false);
            }else{
                cookie()->queue('access_token', $newAccessToken, 60*24*180, false, false, false, false);
                cookie()->queue('email_address', $data['email_address'], 60*24*180, false, false, false, false);
            }

            Auth::login($user, false);

            if($user->role=="customer"){
                return redirect()->route('backend.user.cart');
            }else{
                return redirect()->route('backend.admin.newProduct');
            }
        } else {
            return redirect()->route('frontend.login')->with('error', 'Invalid credentials');
        }
    }

    public function dashboard(Request $request){

        $email = $request->cookie('email');
        $accessToken = $request->cookie('accessToken');

        $user = User::where('email_address', $email)->where('access_token', $accessToken)->first();

        if ($user) {
            if($user->Role == 'admin'){
                // 身分組為管理員的邏輯
                return view('background.admin.dashboard');
            }else{

                // 身分組為普通用戶的邏輯
                return redirect()->route('background.user.cart');
            }
        } else {
            return redirect()->route('frontend.login');
        }
    }

    function logout(Request $request){

        if(config('website.multi_subdomains')){
            setcookie('email_address', '', time() - 3600, '/', '.frozen.com');
        }else{
            setcookie('email_address', '', time() - 3600);
        }
        
        Auth::logout();
        
        return back();
    }
}
