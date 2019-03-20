<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Validator;

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
            if ($menu->save()) {
                return response()->json("Menu name with id - '" . $request->id . "' &nbsp; is changed successfully");
            }
            return response()->json("Something went wrong");
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'menu_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $menu = new Menu;
        $menu->name = $request->menu_name;
        if ($menu->save()) {
            return redirect()->back()->with('success', "Created Successfully");;
        }


    }


}
