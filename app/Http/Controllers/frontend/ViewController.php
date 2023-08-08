<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\productCatelog;

class ViewController extends Controller
{
    public function index(){return view('frontend.index');}

    public function about(){return view('frontend.about');}

    public function type(){return view('frontend.type');}

    public function product(){
        $catelogs = ProductCatelog::orderBy('catelogName', 'asc')->get();
        return view('frontend.catelog',compact('catelogs')); 
    }

    public function contact(){return view('frontend.contact');}

    public function register(){return view('frontend.register');}

    public function login(){return view('frontend.login');}
}


