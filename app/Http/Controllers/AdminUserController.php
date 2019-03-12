<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use App\AdminRole;
use Illuminate\Support\Facades\Auth;


class AdminUserController extends Controller
{
    /**
     * AdminUserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:superadmin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerForm()
    {
        $roles = Role::select('id', 'name')->get();
        if (count($roles) > 0) {
            return view('admin.users.userRegisterForm', compact('roles'));
        }
        return view('admin.users.userRegisterForm');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:admins,email',
            'password' => 'required|min:6',
            'job_title' => 'required',
            'role' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'job_title' => $request['job_title']
        ]);


        $id = $request->role;

        $role = AdminRole::create([
            'role_id' => $request->role,
            'admin_id' => $admin->id
        ]);
        //Redirects
        if ($id && $role) {
            return redirect(route('admin.user.settings'))->with('success', 'Admin User Created Successfully!');
        }
        else{
            return redirect()->back()->withErrors("Something went wrong");
        }
    }


    /**
     * @param array $data
     * @return mixed
     */


    //Get the guard to authenticate Seller
    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function settings()
    {
        $users = Admin::with('roles')->paginate(8);
        return view('admin.users.settings', compact('users'));
    }


    public function editUser($id)
    {
        $adminUser = Admin::with('roles')->where('id', $id)->first();
        $roles = Role::select('id', 'name')->get();
        if (!$adminUser) {
            return redirect()->route('admin.error')->withErrors('Admin User not found!')->with('status_cod', 404);
        }
        return view('admin.users.updateRegisterForm', compact(['adminUser', 'roles']));
    }


    public function updateUser(Request $request, $id)
    {
        $admin = Admin::where('id', $id)->with('roles')->first();
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:admins,email,' . $admin->id,
//            'password' => 'required|min:6',
            'job_title' => 'required',
            'role' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $admin->update([
            'name' => $request['name'],
            'email' => $request['email'],
//            'password' => bcrypt($request['password']),
            'job_title' => $request['job_title']
        ]);

        $id = $request->role;
        $role = AdminRole::where('admin_id', $admin->id)->first();

        $role->update([
            'role_id' => $id,
            'admin_id' => $admin->id
        ]);

        if ($admin && $role) {
            return redirect(route('admin.user.settings'))->with('success', 'Admin User Updated Successfully!');
        }

    }


    public function deleteUser($id)
    {
        $adminuser = Admin::find($id);
        $delete = $adminuser->delete();
        if ($delete) {
            return redirect(route('admin.user.settings'))->with('success', 'Admin user is deleted succesffully.');
        }
    }


    public function changePassword($id)
    {
//        dd($id);
        $admin = Admin::where('id', $id)->first();
        if(!$admin){
            return redirect()->route('admin.error')->withErrors('User not found!')->with('status_cod', 404);
        }
        return view('admin.users.changePassword', compact('admin'));
    }

    public function updatePassword(Request $request,$id)
    {
//      dd($id, $request->all());

        $validation = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $admin = Admin::where('id', $id)->first();
        if($admin){
            $admin->password = bcrypt($request->password);
            $admin->save();
            return redirect(route('admin.user.settings'))->with('success', 'Admin user password is changed succesfully.');
        }


    }

    public function userStatus(Request $request){
        $admin = Admin::where('id', $request->id)->first();
        $admin->status = $request->status;
        $admin->save();
        return response($admin);
    }


}
