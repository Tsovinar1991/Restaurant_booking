<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminRoles;


class AdminUserController extends Controller
{
    public function registerForm(){

        $roles = AdminRoles::select('id', 'name')->get();
        if(count($roles)> 0 ) {
            return view('admin.users.userRegisterForm', compact('roles'));
        }
        return view('admin.users.userRegisterForm');

    }


}
