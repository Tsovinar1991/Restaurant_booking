<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;


class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:superadmin');

    }

    public function registerForm(){

        $roles = Role::select('id', 'name')->get();
        if(count($roles)> 0 ) {
            return view('admin.users.userRegisterForm', compact('roles'));
        }
        return view('admin.users.userRegisterForm');

    }


}
