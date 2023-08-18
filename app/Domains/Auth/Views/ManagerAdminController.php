<?php

namespace App\Domains\Auth\Views;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerAdminController extends Controller{
    public function managerAccount(Request $request){

        $orderNew = session('orderNew');

        $user = User::all();
        if(!$request->operation){
            $operation = 'all';
        }else{
            $operation = $request->operation;
        }

        return view('backend.admin.managementUser', compact('orderNew', 'user', 'operation'));
    }
}