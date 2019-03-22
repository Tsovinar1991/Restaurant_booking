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
//        $this->middleware('auth:admin');

        //tests
//        $this->middleware(['roles:superadmin|waiter']); multiple roles
//        $this->middleware('role:delivery');  //access to product contrller will be given only to delivery role for example.

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        dd($request->user());
//        if ($request->user()->hasRole('admin')) {
//        $request->user()->authorizeRoles(['admin', 'manager']); //give access to admin and manager
        $products = RestaurantMenu::sortable()->orderBy('id', 'DESC')->paginate(5);
        return view('admin.product.products', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $restaurants = Restaurant::select('id', 'name')->get();
        $parents = RestaurantMenu::select('id', 'name_en')->where('parent_id', 0)->get();
        return view('admin.product.productCreate', compact(['restaurants', 'parents']));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = RestaurantMenu::find($id);
        if (!$product) {
            return redirect()->route('admin.error')->with('error', 'Product not found!')->with('status_cod', 404);
        }
        return view('admin.product.product')->with('product', $product);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            return redirect(route('admin.products'))->with('success', "Product Created Successfully");
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = RestaurantMenu::find($id);
        if (!$product) {
            return redirect()->route('admin.error')->with('error', 'Product not found!')->with('status_cod', 404);
        }
        $restaurants = Restaurant::select('id', 'name')->get();
        $parents = RestaurantMenu::select('id', 'name_en')->where('parent_id', 0)->get();
        $restaurant_id = $product->restaurant_id;
        $restaurantName = Restaurant::where('id', $restaurant_id)->get(['name'])->first();
        $r_name = $restaurantName->name;
        return view('admin.product.updateProduct', compact(['product', 'restaurants', 'parents', 'r_name']));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = RestaurantMenu::find($id);
        if ($product == null) {
            return redirect()->route('admin.error')->with('error', 'Product not found!')->with('status_cod', 404);
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

        if (!$request->avatar) {
            $product->update(['avatar' => $product_image]);
        }
        return redirect(route('admin.products'))->with('success', "Product Updated Successfully");

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function productStatus(Request $request)
    {
        $product = RestaurantMenu::find($request->id);
        $product->update(['status' => $request->status]);
        return response($product);
    }

    public function categories()
    {
        $categories = RestaurantMenu::select('id', 'name_en as name')->where('parent_id', 0)->paginate(6);
        return view('admin.product.categories', compact('categories'));

    }

    public function storeCategory(Request $request){
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
            return redirect(route('admin.products'))->with('success', "Product Created Successfully");
        }
    }

}
