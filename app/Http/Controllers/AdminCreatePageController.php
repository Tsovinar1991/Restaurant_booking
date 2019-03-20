<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Menu;;
use Validator;

class AdminCreatePageController extends Controller
{


    public function __construct()
    {

    }


    public function index(Request $request, $p)
    {
        $page = Page::where('id', $p)->first();
        if (!$page) {
            return redirect()->route('admin.error')->with('error', 'Page item not found!')->with('status_cod', 404);
        }
        return view('admin.pages.page')->with('page', $page);
    }


    public function all()
    {
        $pages = Page::all();
        return view('admin.pages.pages')->with('pages', $pages);
    }


    public function create()
    {
        $menus = Menu::all();
        return view('admin.pages.createPage', compact('menus'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ru' => 'required',
            'name_am' => 'required',
            'name_en' => 'required',
            'description_ru' => 'required',
            'description_am' => 'required',
            'description_en' => 'required',
            'menu_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }

        $page = Page::create($request->all());

        if ($page) {
            return redirect(route('admin.page.single' , $page->id))->with('success', "Created Successfully");;
        }
    }


    public function edit($id)
    {
        $menus = Menu::all();
        $pages = Page::find($id);
        if (!$pages) {
            return redirect()->route('admin.error')->with('error', 'Page item not found!')->with('status_cod', 404);
        }
        return view('admin.pages.updatePage', compact(['menus', 'pages']));

    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        if ($page == null) {
            return redirect()->route('admin.error')->with('error', 'Page item not found!')->with('status_cod', 404);
        }

        $validator = Validator::make($request->all(), [
            'name_ru' => 'required',
            'name_am' => 'required',
            'name_en' => 'required',
            'description_ru' => 'required',
            'description_am' => 'required',
            'description_en' => 'required',
            'menu_id' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $page->update($request->all());
        return redirect(route('admin.page.single' , $page->id))->with('success', "Updated Successfully");
    }


    public function delete($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect(route('admin.pages'))->with('success', "Deleted Successfully");;
    }




}
