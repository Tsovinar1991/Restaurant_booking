<?php

namespace App\Http\Controllers;

use App\RestaurantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\RestaurantMenu;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        //tests
//        $this->middleware(['roles:superadmin|waiter']); multiple roles
//        $this->middleware('role:delivery');  //access to product contrller will be given only to delivery role for example.

    }

    public function index(Request $request)
    {
//        dd($request->user());
//        if ($request->user()->hasRole('admin')) {
//        $request->user()->authorizeRoles(['admin', 'manager']); //give access to admin and manager

        $products = RestaurantMenu::sortable()->orderBy('id', 'DESC')->paginate(5);
        return view('admin.product.products', compact('products'));
    }

    public function create()
    {
        $restaurants = Restaurant::select('id', 'name')->get();
        $parents = RestaurantMenu::select('id', 'name_en')->get();
//        echo "<pre>";
//        var_dump($restaurant);
//        die();
        return view('admin.product.productCreate', compact(['restaurants', 'parents']));
    }


    public function show($id)
    {
        $product = RestaurantMenu::find($id);

        if (!$product) {
            return redirect()->route('admin.error')->with('error','Product not found!')->with('status_cod', 404);
        }

        return view('admin.product.product')->with('product', $product);
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
            $path = $request->file('avatar')->storeAs('public/products', $fileNameToStore);


        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ru' => 'required',
            'name_am' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_am' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'required|numeric',
            'restaurant_id' => 'required|numeric',
            'price' => 'required|numeric',
            'weight' => 'required'

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $id = Auth::guard('admin')->user()->id;
        $product = new RestaurantMenu;
        $product->name_en = $request->name_en;
        $product->name_ru = $request->name_ru;
        $product->name_am = $request->name_am;
        $product->description_en = $request->description_en;
        $product->description_ru = $request->description_ru;
        $product->description_am = $request->description_am;
        $product->avatar = '/storage/products/' . $fileNameToStore;
        $product->parent_id = $request->parent_id;
        $product->restaurant_id = $request->restaurant_id;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->status = $request->status;
        $product->created_by = $id;
        $product->save();
        if ($product) {
            return redirect(url('admin/insert/products'))->with('success', "Product Created Successfully");
        }


    }

    public function edit($id)
    {
        $product = RestaurantMenu::find($id);
        if (!$product) {
            return redirect()->route('admin.error')->with('error','Product not found!')->with('status_cod', 404);
        }
        $restaurants = Restaurant::select('id', 'name')->get();
        $parents = RestaurantMenu::select('id', 'name_en')->get();
        $restaurant_id = $product->restaurant_id;
        $restaurantName = Restaurant::where('id', $restaurant_id)->get(['name'])->first();
        $r_name = $restaurantName->name;

        return view('admin.product.updateProduct', compact(['product', 'restaurants', 'parents', 'r_name']));
    }


    public function update(Request $request, $id)
    {

        $product = RestaurantMenu::find($id);
        if ($product == null) {
            return redirect()->route('admin.error')->with('error','Product not found!')->with('status_cod', 404);
        }
        $product_image = $product->avatar;


        if ($request->hasFile('avatar')) {
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension
            $extension = $request->file('avatar')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('avatar')->storeAs('public/products', $fileNameToStore);


        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ru' => 'required',
            'name_am' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'description_am' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'required|numeric',
            'restaurant_id' => 'required|numeric',
            'price' => 'required|numeric',
            'weight' => 'required',

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin_id = Auth::guard('admin')->user()->id;
        $product = RestaurantMenu::where('id', $id)->first();
        $product->name_en = $request->name_en;
        $product->name_ru = $request->name_ru;
        $product->name_am = $request->name_am;
        $product->description_en = $request->description_en;
        $product->description_ru = $request->description_ru;
        $product->description_am = $request->description_am;
        $product->avatar = '/storage/products/' . $fileNameToStore;
        $product->parent_id = $request->parent_id;
        $product->restaurant_id = $request->restaurant_id;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->status = $request->status;
        $product->updated_by = $admin_id;
        $product->save();


//        $product->update([
//            'name_en' => $request->name_en,
//            'name_ru' => $request->name_ru,
//            'name_am' => $request->name_am,
//            'description_en' => $request->description_en,
//            'description_ru' => $request->description_ru,
//            'description_am' => $request->description_am,
//            'avatar' => '/storage/products/' . $fileNameToStore,
//            'parent_id' => $request->parent_id,
//            'restaurant_id' => $request->restaurant_id,
//            'price' => $request->price,
//            'weight' => $request->weight,
//            'status' => $request->status
//        ]);

        if (!$request->avatar) {
            $product->update(['avatar' => $product_image]);
        }

        return redirect(url('admin/insert/products'))->with('success', "Product Updated Successfully");

    }


    public function productStatus(Request $request)
    {
        $product = RestaurantMenu::find($request->id);

        $product->update(['status' => $request->status]);
        return response($product);
//        return response(['Product status is' . $request->status]);
    }
}
