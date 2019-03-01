<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use App\AdminRole;
use Illuminate\Support\Facades\Auth;


class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:superadmin');

    }

    public function registerForm()
    {

        $roles = Role::select('id', 'name')->where('name', '!=', 'superadmin')->get();
        if (count($roles) > 0) {
            return view('admin.users.userRegisterForm', compact('roles'));
        }
        return view('admin.users.userRegisterForm');
    }


    public function register(Request $request)
    {

        //Validates data
        $this->validator($request->all())->validate();

        //Create seller
        $admin = $this->create($request->all());


         //giving role to admin
        Validator::make($request->all(), [
            'role' => 'required|num',
        ]);

        AdminRole::create([
            'role_id'=> $request->role,
            'admin_id' => $admin->id

        ]);





        //Redirects sellers
        return redirect(url('admin'))->with('success', 'Admin User is Created Successfully!');
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6',
            'job_title' => 'required',
        ]);
    }

    //Create a new seller instance after a validation.
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'job_title' => $data['job_title']
        ]);
    }

    //Get the guard to authenticate Seller
    protected function guard()
    {
        return Auth::guard('admin');
    }


}
