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


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//    public function store(Request $request)
//    {
//        if ($request->hasFile('name')) {
//            $fileNameWithExt = $request->file('name')->getClientOriginalName();
//            //Get just filename
//            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//            //Get the extension
//            $extension = $request->file('name')->getClientOriginalExtension();
//            //Filename to store
//            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
//            //Upload Image
//            $path = $request->file('name')->storeAs('public/images', $fileNameToStore);
//        } else {
//            $fileNameToStore = 'noimage.jpg';
//        }
//
//        $validator = Validator::make($request->all(), [
//            'restaurant_id' => 'required|numeric',
//            'name' => 'required'
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Error',
//                'data' => [],
//                'errors' => $validator->errors()
//            ]);
//        }
//
//        $request->name = $fileNameToStore;
//        $image = RestaurantImage::create($request->all());
//        return response()->json([
//            'success' => true,
//            'message' => 'Created a new image.',
//            'data' => $image,
//            'errors' => false
//        ]);
//    }
//
//
//    /**
//     * @param Request $request
//     * @param $id
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function update(Request $request, $id)
//    {
//
//        $image = RestaurantImage::find($id);
//        if ($image == null) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Data not found or not exist.',
//                'data' => null,
//                'errors' => true
//            ]);
//        }
//        if ($request->hasFile('name')) {
//            $fileNameWithExt = $request->file('name')->getClientOriginalName();
//            //Get just filename
//            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//            //Get the extension
//            $extension = $request->file('name')->getClientOriginalExtension();
//            //Filename to store
//            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
//            //Upload Image
//            $path = $request->file('name')->storeAs('public/images', $fileNameToStore);
//        } else {
//            $fileNameToStore = 'noimage.jpg';
//        }
//
//        $validator = Validator::make($request->all(), [
//            'restaurant_id' => 'required|numeric',
//            'name' => 'required'
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Error',
//                'data' => null,
//                'errors' => $validator->errors()
//            ]);
//        }
//
//        $request->name = $fileNameToStore;
//        try {
//            $image->update($request->all());
//        } catch (\Exception $err) {
//            var_dump($err->getMessage());
//            die;
//        }
//
//        return response()->json([
//            'success' => true,
//            'message' => 'Image data updated.',
//            'data' => $image,
//            'errors' => false
//        ]);
//
//    }
//
//    /**
//     * @param $id
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function delete($id)
//    {
//        $image = RestaurantImage::find($id);
//        if ($image == null) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Data not found or not exist.',
//                'data' => null,
//                'error' => true
//            ]);
//        }
//
//        $image->delete();
//        if ($image->name != 'noimage.jpg') {
//            Storage::delete('public/images/' . $image->name);
//        }
//        return response()->json([
//            'success' => true,
//            'message' => 'Deleted image data.',
//            'data' => $image,
//            'errors' => false
//        ]);
//    }


}
