<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Validator;

class AdminRestaurantController extends Controller
{
    /**
     * AdminRestaurantController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $restaurants = Restaurant::paginate(6);
//        dd($restaurants);
        return view('admin.restaurants.restaurants', compact('restaurants'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.restaurants.restaurantCreate');
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
            $path = $request->file('avatar')->storeAs('public/restaurant_avatar', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
            'tel' => 'required',
            'email' => 'required|email',
            'open_hour' => 'required',
            'close_hour' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $restaurant = Restaurant::create(
            [
                'name' => request('name'),
                'type' => request('type'),
                'description' => request('description'),
                'avatar' => '/storage/restaurant_avatar/' . $fileNameToStore,
                'address' => request('address'),
                'tel' => request('tel'),
                'email' => request('email'),
                'open_hour' => request('open_hour'),
                'close_hour' => request('close_hour'),
            ]
        );

        if ($restaurant) {
            return redirect(url('admin/insert/restaurants'))->with('success', "Restaurant Created Successfully");
        }
    }

    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return redirect()->route('admin.error')->with('error', 'Restaurant not found!')->with('status_cod', 404);
        }
        return view('admin.restaurants.restaurantEdit', compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return redirect()->route('admin.error')->with('error', 'Restaurant  not found!')->with('status_cod', 404);;
        }
        $oldImage = $restaurant->avatar;

        if ($request->hasFile('avatar')) {
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension
            $extension = $request->file('avatar')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('avatar')->storeAs('public/restaurant_avatar', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'address' => 'required',
            'tel' => 'required',
            'email' => 'required|email',
            'open_hour' => 'required',
            'close_hour' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $restaurant->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'avatar' => '/storage/restaurant_avatar/' . $fileNameToStore,
            'address' => $request->address,
            'tel' => $request->tel,
            'email' => $request->email,
            'open_hour' => $request->open_hour,
            'close_hour' => $request->close_hour,
        ]);


        if (!$request->avatar) {
            $restaurant->update(['avatar' => $oldImage]);
        }

        if ($restaurant) {
            return redirect(route('admin.restaurants'))->with('success', "Restaurant Updated Successfully");
        }
    }

    public function show($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if (!$restaurant) {
            return redirect()->route('admin.error')->with('error', 'Restaurant not found!')->with('status_cod', 404);
        }
//        dd($restaurant);
        return view('admin.restaurants.restaurant', compact('restaurant'));
    }
}
