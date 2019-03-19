<?php

namespace App\Http\Controllers;

use App\RestaurantMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Role;
use App\Admin;
use App\AdminRole;
use Validator;


class AdminProfileController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminUserProfile()
    {
        $currentUser = Auth::guard('admin')->user();
        $createdBy = RestaurantMenu::all()->where('created_by', '==', $currentUser->id)->where('created_at', '>', Carbon::now()->subDays(7));
        $updatedBy = RestaurantMenu::all()->where('updated_by', '==', $currentUser->id)->where('updated_at', '>', Carbon::now()->subDays(7));
        return view('admin.profile.profile', compact(['currentUser', 'createdBy', 'updatedBy', 'roles']));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request, $id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('admin.error')->with('error', 'Admin not found!')->with('status_cod', 404);
        }

        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('image')->storeAs('public/profiles', $fileNameToStore);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:admins,email,' . $admin->id,
            'job_title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->avatar = '/storage/profiles/'.$fileNameToStore;
            $admin->job_title = $request->job_title;
            $admin->save();
        } else {
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->job_title = $request->job_title;
            $admin->save();
        }

        if ($admin) {
            return redirect(route('admin.user.profile'))->with('success', 'Your profile is updated Successfully!');
        }
    }


}
