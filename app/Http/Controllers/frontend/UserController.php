<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

class UserController extends Controller{

    public function dashboard(){
        return view('backend/user/dashboard');
    }

}