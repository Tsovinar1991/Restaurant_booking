<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\RestaurantImage;
use App\Restaurant;


class AdminRestaurantImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:superadmin|admin|delivery|waiter|manager');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $images = RestaurantImage::sortable()->orderBy('id', 'DESC')->paginate(5);
        $categories = RestaurantImage::distinct()->get(['title']);
        return view('admin.restaurant_images.images', compact(['images', 'categories']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $restaurants = Restaurant::select('id', 'name')->get();
        return view('admin.restaurant_images.imageCreate', compact('restaurants'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->hasFile('name')) {
            $fileNameWithExt = $request->file('name')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension
            $extension = $request->file('name')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('name')->storeAs('public/restaurant_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|numeric',
            'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = RestaurantImage::create(
            [
                'restaurant_id' => request('restaurant_id'),
                'name' => '/storage/restaurant_images/' . $fileNameToStore,
                'title' => request('title')
            ]
        );

        if ($image) {
            return redirect(route('admin.images'))->with('success', "Image Created Successfully");
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $image = RestaurantImage::find($id);
        if (!$image) {
            return redirect()->route('admin.error')->with('error', 'Restaurant Image not found!')->with('status_cod', 404);
        }
        $restaurants = Restaurant::select('id', 'name')->get();
        $restaurant_id = $image->restaurant_id;
        $restaurantName = Restaurant::where('id', $restaurant_id)->get(['name'])->first();
        $r_name = $restaurantName->name;

        return view('admin.restaurant_images.updateImage', compact(['image', 'r_name', 'restaurants']));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $image = RestaurantImage::find($id);
        if (!$image) {
            return redirect()->route('admin.error')->with('error', 'Restaurant Image not found!')->with('status_cod', 404);
        }
        $oldImage = $image->name;

        if ($request->hasFile('name')) {
            $fileNameWithExt = $request->file('name')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension
            $extension = $request->file('name')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('name')->storeAs('public/restaurant_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|numeric',
            'title' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $image->update([
            'restaurant_id' => $request->restaurant_id,
            'name' => '/storage/restaurant_images/' . $fileNameToStore,
            'title' => $request->title,
        ]);

        if (!$request->name) {
            $image->update(['name' => $oldImage]);
        }

        if ($image) {
            return redirect(route('admin.images'))->with('success', "Image Updated Successfully");
        }


    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete($id)
    {
        $image = RestaurantImage::find($id);
        Storage::delete($image->name);
        $delete = $image->delete();
        return redirect(route('admin.images'))->with('success', 'Restaurant Image Deleted Successfully');
    }

    /**
     * @param Request $request
     * @param $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gallery(Request $request, $category)
    {
        $images = RestaurantImage::where('title', $category)->paginate(5);
        return view('admin.restaurant_images.gallery', compact(['category', 'images']));
    }


}
