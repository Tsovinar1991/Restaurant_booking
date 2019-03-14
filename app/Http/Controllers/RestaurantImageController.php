<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RestaurantImage;
use Validator;
use Illuminate\Support\Facades\Storage;

class RestaurantImageController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $id)
    {

        if (isset($request->offset) and isset($request->limit)) {
            $images = RestaurantImage::where('restaurant_id', $id)->skip($request->input('offset'))->take($request->input('limit'))->get();
            $count = count(RestaurantImage::all());
            if ($images->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image table data not exist.',
                    'data' => null,
                    'errors' => true
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Restaurant images table all data.',
                'data' => $images,
                'total' => $count,
                'errors' => false
            ], 200);
        } else {
            $not_specified = collect(['Restaurant Image' => ['Restaurant images offset and limit are not specified.']]);
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $not_specified
            ], 404);
        }
    }

}