<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\RestaurantMenu;
use App\Restaurant;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {


        $products = RestaurantMenu::sortable()->orderBy('id', 'DESC')->paginate(5);
        return view('admin.product.products', compact('products'));
    }

    public function create()
    {
        $restaurants = Restaurant::select('id', 'name')->get();
        $parents = RestaurantMenu::select('id', 'name')->get();
//        echo "<pre>";
//        var_dump($restaurant);
//        die();
        return view('admin.product.productCreate', compact(['restaurants', 'parents']));
    }

    public function store(Request $request)
    {

        if ($request->hasFile('avatar')) {
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension
            $extension = $request->file('avatar')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('avatar')->storeAs('public', $fileNameToStore);


        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'required|numeric',
            'restaurant_id' => 'required|numeric',
            'price' => 'required|numeric',
            'weight' => 'required'

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = RestaurantMenu::create(
            [
                'name' => request('name'),
                'description' => request('description'),
                'type' => request('type'),
                'avatar' => $fileNameToStore,
                'parent_id' => request('parent_id'),
                'restaurant_id' => request('restaurant_id'),
                'price' => request('price'),
                'weight' => request('weight')
            ]
        );

        if ($product) {
            return redirect(url('admin/insert/products'))->with('success', "Product Created Successfully");
        }


    }

    public function edit($id)
    {
        $restaurants = Restaurant::select('id', 'name')->get();
        $parents = RestaurantMenu::select('id', 'name')->get();
        $product = RestaurantMenu::find($id);
        $restaurant_id = $product->restaurant_id;
        $restaurantName = Restaurant::where('id', $restaurant_id)->get(['name'])->first();
        $r_name = $restaurantName->name;

        if (!$product) {
            return view('admin.404');
        }
        return view('admin.product.updateProduct', compact(['product', 'restaurants', 'parents', 'r_name']));
    }


    public function update(Request $request, $id)
    {

        $product = RestaurantMenu::find($id);
        $product_image = $product->avatar;

        if ($product == null) {
            return view('admin.404');
        }


        if ($request->hasFile('avatar')) {
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension
            $extension = $request->file('avatar')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('avatar')->storeAs('public', $fileNameToStore);


        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'required|numeric',
            'restaurant_id' => 'required|numeric',
            'price' => 'required|numeric',
            'weight' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


//        echo "<pre>";
//        var_dump($request->all());
//        die();
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'avatar' => $fileNameToStore,
            'parent_id' => $request->parent_id,
            'restaurant_id' => $request->restaurant_id,
            'price' => $request->price,
            'weight' => $request->weight

        ]);

        if(!$request->avatar){
            $product->update(['avatar' => $product_image]);
        }
        return redirect(url('admin/insert/products'))->with('success', "Product Updated Successfully");

    }


    public function delete($id)
    {
        $product = RestaurantMenu::find($id);
        $delete = $product->delete();


        return redirect(url('admin/insert/products'))->with('success', 'Product Deleted Successfully');


    }
}
