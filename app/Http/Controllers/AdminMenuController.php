<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class AdminMenuController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $menus = Menu::paginate(6);
        if (empty($menus)) {
            return view('admin.menus.menus');
        } else {
            return view('admin.menus.menus', compact('menus'));
        }
    }

    public function change_name(Request $request)
    {

        if (isset($request->id) && isset($request->menu)) {
            $menu = Menu::find($request->id);
            $menu->name = $request->menu;
            if($menu->save()) {return response()->json("Menu name with id - '" . $request->id . "' &nbsp; is changed successfully");}
            return  response()->json("Something went wrong");
        }
    }


}
