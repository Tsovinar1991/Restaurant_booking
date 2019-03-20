<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\RestaurantMenu;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\Builder;


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
            $restaurants = Restaurant::skip($request->input('offset'))->take($request->input('limit'))->get();
            if ($restaurants->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Restaurants table data not exist.',
                    'data' => [],
                    'errors' => true
                ], 404);

            }
            return response()->json([
                'success' => true,
                'message' => 'All restaurant table data.',
                'data' => $restaurants,
                'errors' => false
            ], 200);
        } else {
            $not_specified = collect(['Restaurant' => ['Restaurant  offset and limit are not specified.']]);
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => [],
                'errors' => $not_specified
            ], 404);
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $lang = $request->header('lang');
        if (isset($lang)) {
            $restaurant = Restaurant::with(array('products' => function ($query) use ($lang) {
                $query->select('id', "name_$lang as name", "description_$lang as description", "avatar", "parent_id", "price", "weight", "status", "created_by", "updated_by", 'restaurant_id');
            }))
                ->find($id);
        } else {
            $restaurant = Restaurant::with(array('products' => function ($query) use ($lang) {
                $query->select('id', "name_en as name", "description_en as description", "avatar", "parent_id", "price", "weight", "status", "created_by", "updated_by", 'restaurant_id');
            }))
                ->find($id);
        }


        if ($restaurant == null) {
            $not_exist = collect(['Restaurant' => ['Restaurant table data not exist.']]);
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => [],
                'errors' => $not_exist
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'A single restaurant data.',
            'data' => $restaurant,
            'errors' => false
        ], 200);
    }

    public function product(Request $request, $id)
    {
        $lang = $request->header('lang');
        if (isset($lang)) {
            $product = RestaurantMenu::select('id', "name_$lang as name", "description_$lang as description", "avatar",
                "parent_id", "price", "weight", "status", "created_by", "updated_by", 'restaurant_id')
                ->where('id', $id)->first();
            return response()->json($product);
        }
        else{
            $product = RestaurantMenu::select('id', "name_en as name", "description_en as description", "avatar",
                "parent_id", "price", "weight", "status", "created_by", "updated_by", 'restaurant_id')
                ->where('id', $id)->first();
            return response()->json($product);

        }
    }


}
