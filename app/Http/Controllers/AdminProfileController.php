<?php

namespace App\Http\Controllers;

use App\RestaurantMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminUserProfile()
    {
        $currentUser = Auth::guard('admin')->user();
        $createdBy = RestaurantMenu::all()->where('created_by', '==', $currentUser->id)->where( 'created_at', '>', Carbon::now()->subDays(7));
        $updatedBy =   RestaurantMenu::all()->where('updated_by', '==', $currentUser->id)->where( 'updated_at', '>', Carbon::now()->subDays(7));
        return view('admin.profile.profile', compact(['currentUser','createdBy', 'updatedBy']));
    }

}
