<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Validator;

class AdminCreatePageController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(Request $request, $p)
    {
        $page = Page::where('id', $p)->first();

        return view('admin.pages.page')->with('page', $page);
    }


    public function all()
    {
        $pages = Page::all();
        return view('admin.pages.pages')->with('pages', $pages);

    }


    public function create()
    {


        return view('admin.pages.createPage');
    }




    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ru' => 'required',
            'name_am' => 'required',
            'name_en' => 'required',
            'description_ru' => 'required',
            'description_am' => 'required',
            'description_en' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $page = Page::create($request->all());

        if ($page) {
            return redirect(url('admin/page/'. $page->id))->with('success', "Created Successfully");;
        }

    }




    public function edit($id)
    {
        $pages = Page::find($id);
        if (!$pages) {
            return view('admin.404');
        }
        return view('admin.pages.updatePage')->with('pages', $pages);

    }

    public function update(Request $request, $id)
    {

        $page = Page::find($id);
        if ($page == null) {
            return view('admin.404');
        }

        $validator = Validator::make($request->all(), [
            'name_ru' => 'required',
            'name_am' => 'required',
            'name_en' => 'required',
            'description_ru' => 'required',
            'description_am' => 'required',
            'description_en' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $page->update($request->all());
        return redirect(url('admin/page/' . $page->id))->with('success', "Updated Successfully");
    }


    public function delete($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect(url('/admin/pages'));
    }


    public function truncate()
    {
        Page::query()->truncate();
        return redirect(url('admin/pages'));
    }


}
