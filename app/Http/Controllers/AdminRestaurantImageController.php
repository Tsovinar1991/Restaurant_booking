<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\RestaurantImage;
use App\Restaurant;


class AdminRestaurantImageController extends Controller
{
    public function all()
    {
        $images = RestaurantImage::sortable()->orderBy('id', 'DESC')->paginate(5);
        return view('admin.restaurant_images.images', compact('images'));
    }

    public function create()
    {
        $restaurants = Restaurant::select('id', 'name')->get();
        return view('admin.restaurant_images.imageCreate', compact('restaurants'));
    }


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
                'name' => $fileNameToStore,
                'title' => request('title')

            ]
        );


        if ($image) {
            return redirect(url('admin/insert/images'))->with('success', "Image Created Successfully");
        }


    }

    public function edit($id)
    {

        $restaurants = Restaurant::select('id', 'name')->get();
        $image = RestaurantImage::find($id);
        $restaurant_id = $image->restaurant_id;
        $restaurantName = Restaurant::where('id', $restaurant_id)->get(['name'])->first();
        $r_name = $restaurantName->name;

        if (!$image) {
            return view('admin.404');
        }
        return view('admin.restaurant_images.updateImage', compact(['image', 'r_name', 'restaurants']));


    }


    public function update(Request $request, $id)
    {
        $image = RestaurantImage::find($id);
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
            'name' => $fileNameToStore,
            'title' => $request->title,
        ]);

        if (!$request->name) {
            $image->update(['name' => $oldImage]);
        }


        if ($image) {
            return redirect(url('admin/insert/images'))->with('success', "Image Updated Successfully");
        }


    }


    public function delete($id)
    {
        $image = RestaurantImage::find($id);
        $delete = $image->delete();


        return redirect(url('admin/insert/images'))->with('success', 'Restaurant Image Deleted Successfully');


    }


}
