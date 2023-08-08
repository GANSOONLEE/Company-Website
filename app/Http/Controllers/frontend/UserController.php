<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;



class UserController extends Controller{

    /**
     * #TODO Change the view
     */

    public function dashboard() :View{
        return view('backend.user.dashboard');
    }

    public function favorite() :View{
        return view('backend.user.dashboard'); // 修改
    }
    
    public function order() :View{
        return view('backend.user.dashboard'); // 修改
    }

    public function account() :View{
        return view('backend.user.dashboard'); // 修改
    }

}