<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\productCatelog;

class ViewController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.index');
    }

    public function type(){
        return view('frontend.type');
    }
    public function catelog(){

        $catelogs = ProductCatelog::orderBy('catelogName', 'asc')->get();

        return view('frontend.catelog',compact('catelogs'));
    }

    public function contact(){
        return view('frontend.contact');
    }
}


