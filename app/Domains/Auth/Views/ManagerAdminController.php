<?php

namespace App\Domains\Auth\Views;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\UserOperation;
use Illuminate\Http\Request;

class ManagerAdminController extends Controller{
    public function managerAccount(Request $request){

        $orderNew = session('orderNew');

        $user = User::all();

        $operationData = UserOperation::orderBy('created_at', 'desc')
            ->get();

        return view('backend.admin.managementUser', compact('orderNew', 'user', 'operationData'));
    }
}