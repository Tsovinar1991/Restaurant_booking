<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use Validator;


class CityController extends Controller
{

    /**
     * @param $offset
     * @param $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        if (isset($request->offset) and isset($request->limit)) {
            $cities = City::skip($request->input('offset'))->take($request->input('limit'))->get();
            if ($cities->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'City table data not exist.',
                    'data' => $cities,
                    'errors' => true
                ],404);
            }
            return response()->json([
                'success' => true,
                'message' => 'City table all data.',
                'data' => $cities,
                'errors' => false
            ],200);
        } else {
            $not_specified = collect(['City' => ['City is not specified.']]);
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $not_specified
            ],404);
        }

    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {


        $city = City::find($id);
        if ($city == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => $city,
                'errors' => true
            ],404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Single City data.',
            'data' => $city,
            'errors' => false
        ],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => "Error",
                'data' => null,
                'errors' => $validator->errors()
            ], 401);
        }

        $city = City::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Created a new city.',
            'data' => $city,
            'errors' => false
        ],201);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $city = City::find($id);
        if ($city == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => null,
                'errors' => true
            ],404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => "Error",
                'data' => null,
                'errors' => $validator->errors()
            ],401);
        }


        $city->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'City data updated.',
            'data' => $city,
            'errors' => false
        ],200);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $city = City::find($id);
        if ($city == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => null,
                'errors' => true
            ],404);
        }

        $city->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted city data.',
            'data' => $city,
            'errors' => false
        ],204);
    }
}
