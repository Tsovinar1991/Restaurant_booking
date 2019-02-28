<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Validator;
use Illuminate\Support\Facades\Storage;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->offset) and isset($request->limit)) {
            $restaurants = Restaurant::skip($request->input('offset'))->take($request->input('limit'))->with('images', 'seats')->get();
            if ($restaurants->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Restaurants table data not exist.',
                    'data' => null,
                    'errors' => true
                ]);

            }

            return response()->json([
                'success' => true,
                'message' => 'All restaurant table data.',
                'data' => $restaurants,
                'errors' => false
            ]);
        }else{
            $not_specified = collect(['Restaurant' => ['Restaurant  offset and limit are not specified.']]);
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $not_specified
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
            $path = $request->file('avatar')->storeAs('public/avatars', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $validator = Validator::make($request->all(), [
            'city_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'avatar' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'address' => 'required',
            'tel' => 'required|numeric',
            'email' => 'required|email'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $validator->errors()
            ]);
        }

        $restaurant = Restaurant::create(
            [
                'city_id' => request('city_id'),
                'name' => request('name'),
                'type' => request('type'),
                'description' => request('description'),
                'address' => request('address'),
                'tel' => request('tel'),
                'email' => request('email'),
                'avatar' => $fileNameToStore
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Created a new restaurant.',
            'data' => $restaurant,
            'errors' => false
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $restaurant = Restaurant::with('images', 'seats')->find($id);

//       echo "<pre>";
//       var_dump($restaurant);
//       die();


        if ($restaurant == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => null,
                'errors' => true
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'A single restaurant data.',
            'data' => $restaurant,
            'errors' => false
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    ///ashxatel vran
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => null,
                'errors' => true
            ]);
        }
        $validator = Validator::make($request->all(), [

            'city_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'avatar' => 'required',
            'address' => 'required',
            'tel' => 'required|numeric',
            'email' => 'required|email'

        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $validator->errors()
            ]);
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
            $path = $request->file('avatar')->storeAs('public/avatars', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        try {
            $request->avatar = $fileNameToStore;
            $restaurant->update($request->all());
        } catch (\Exception $err) {
            var_dump($err->getMessage());
            die;
        }

        return response()->json([
            'success' => true,
            'message' => 'Restaurant data updated.',
            'data' => $restaurant,
            'errors' => false
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => null,
                'errors' => true
            ]);
        }

        $restaurant->delete();
        if ($restaurant->avatar != 'noimage.jpg') {
            Storage::delete('public/avatars/' . $restaurant->avatar);
        }
        return response()->json([
            'success' => true,
            'message' => 'Deleted restaurant data.',
            'data' => $restaurant,
            'errors' => false
        ]);

    }
}
