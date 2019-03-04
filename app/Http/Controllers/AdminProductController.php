<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\RestaurantMenu;
use App\Restaurant;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        //tests
//        $this->middleware('role:delivery');  //access to product contrller will be given only to delivery role for example.

    }

    public function index(Request $request)
    {

//        if ($request->user()->hasRole('admin')) {
//            {
//                $products = RestaurantMenu::sortable()->orderBy('id', 'DESC')->paginate(5);
//                return view('admin.product.products', compact('products'));
//            }
//        } else {
//
//            return redirect(url('admin'))->withErrors(['Unauthorized!']);
//        }

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

        $product = RestaurantMenu::create(
            [
                'name_en' => request('name_en'),
                'name_ru' => request('name_ru'),
                'name_am' => request('name_am'),
                'description_en' => request('description_en'),
                'description_ru' => request('description_ru'),
                'description_am' => request('description_am'),
                'type' => request('type'),
                'avatar' => $fileNameToStore,
                'parent_id' => request('parent_id'),
                'restaurant_id' => request('restaurant_id'),
                'price' => request('price'),
                'weight' => request('weight'),
                'status' => request('status')
            ]
        );

        if ($product) {
            return redirect(url('admin/insert/products'))->with('success', "Product Created Successfully");
        }


    }

    public function edit($id)
    {
        $product = RestaurantMenu::find($id);
        if (!$product) {
            return redirect()->route('admin.error')->withErrors('Product not found!')->with('status_cod', 404);;
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
            return redirect()->route('admin.error')->withErrors('Product not found!')->with('status_cod', 404);;
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



        $product->update([
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'name_am' => $request->name_am,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'description_am' => $request->description_am,
            'avatar' => $fileNameToStore,
            'parent_id' => $request->parent_id,
            'restaurant_id' => $request->restaurant_id,
            'price' => $request->price,
            'weight' => $request->weight,
            'status' => $request->status
        ]);


        if (!$request->avatar) {
            $product->update(['avatar' => $product_image]);
        }



        return redirect(url('admin/insert/products'))->with('success', "Product Updated Successfully");

    }


    public function delete($id)
    {
        $product = RestaurantMenu::find($id);
        $file_path = 'public/products/';
        Storage::delete($file_path . $product->avatar);
        $delete = $product->delete();

        return redirect(url('admin/insert/products'))->with('success', 'Product Deleted Successfully');


    }
}
