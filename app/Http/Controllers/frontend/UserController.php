<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class UserController extends Controller{

    public function dashboard() :View{
        return view('backend/user/dashboard');
    }

    public function favorite() :View{
        return view('backend/user/dashboard');
    }

    public function cart() :View{
        return view('backend/user/dashboard');
    }

    public function order() :View{
        return view('backend/user/dashboard');
    }

    public function account() :View{
        return view('backend/user/dashboard');
    }

}