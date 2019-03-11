<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;

class AdminLoginController extends Controller
{
///avelacrac
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {

        $messages = [
            "email.required" => "Email is required",
            "email.email" => "Email is not valid",
            "email.exists" => "Email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 6 characters"
        ];

        // Validate the form data
        $validator = $this->validate($request, [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6'
        ], $messages);


        $request_admin = Admin::where("email", $request->email)->select('status', 'password')->first();
        if ($request_admin->status == 1) {
            //if password doesnt mutch return error
            if (!Hash::check(Input::get('password'), $request_admin->password)) {
                return redirect()->back()->withErrors("Wrong Password")->withInput($request->only('email', 'remember'));
            }

            // Attempt to log the user in
            if (Auth::guard('admin')->attempt(['status' => 1, 'email' => $request->email, 'password' => $request->password], $request->remember)) {
                // if successful, then redirect to their intended location
                return redirect()->intended(route('admin.dashboard'));
            }

            // if unsuccessful, then redirect back to the login with the form data
            return redirect()->back()->withErrors($validator)->withInput($request->only('email', 'remember'));
        } else {
            return redirect()->back()->withErrors("You are blocked by Super Admin")->withInput($request->only('email', 'remember'));
        }

    }

    public function logout()
    {

        Auth::guard('admin')->logout();
        return redirect('/');

    }
}
