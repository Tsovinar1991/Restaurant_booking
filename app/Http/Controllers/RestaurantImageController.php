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
    public function index(Request $request)
    {

        if (isset($request->offset) and isset($request->limit)) {
            $images = RestaurantImage::skip($request->input('offset'))->take($request->input('limit'))->get();
            if ($images->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image table data not exist.',
                    'data' => null,
                    'errors' => true
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Restaurant images table all data.',
                'data' => $images,
                'errors' => false
            ]);
        }else{
            $not_specified = collect(['Restaurant Image' => ['Restaurant images offset and limit are not specified.']]);
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $not_specified
            ]);
        }
    }

    public function show($id)
    {
        $image = RestaurantImage::find($id);
        if ($image == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => null,
                'error' => true
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Restaurant images single data.',
            'data' => $image,
            'errors' => false
        ]);
    }

}
