<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Seat;
use App\City;
use Validator;
use App\Restaurant;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->offset) and isset($request->limit)) {
            $orders = Order::skip($request->input('offset'))->take($request->input('limit'))->get();
            if ($orders->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order table data not exist.',
                    'data' => null,
                    'errors' => true
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order table all data.',
                'data' => $orders,
                'errors' => false
            ]);
        } else {
            $not_specified = collect(['Restaurant' => ['Order  offset and limit are not specified.']]);
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

        $restaurants = Restaurant::get()->all();
        return response()->json([
            'success' => true,
            'message' => 'Restaurant table all data.',
            'data' => $restaurants,
            'errors' => false
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|numeric',
            'phone' => 'required',
            'name' => 'required',
            'guest_count' => 'required|numeric',
            'start' => 'required',
            'message' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $validator->errors()
            ], 400);
        }


        $request->date .= " " . $request->start;
        $request->start = $request->date;


        $order = Order::create([

            'restaurant_id' => $request->restaurant_id,
            'tel' => $request->phone,
            'name' => $request->name,
            'guest_count' => $request->guest_count,
            'start' => $request->start,
            'message' => $request->message


        ]);
        return response()->json([
            'success' => true,
            'message' => 'Created a new order.',
            'data' => $order,
            'errors' => false
        ], 201);


    }


    public function isWeekend($date)
    {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => $order,
                'errors' => true
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Single order data.',
            'data' => $order,
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
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exist.',
                'data' => null,
                'errors' => true
            ]);
        }


        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|numeric',
            'phone' => 'required',
            'name' => 'required',
            'guest_count' => 'required|numeric',
            'start' => 'required',
            'message' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $validator->errors()
            ], 400);
        }


        try {
            $request->date .= " " . $request->start;
            $request->start = $request->date;

            $order->update([
                'restaurant_id' => $request->restaurant_id,
                'tel' => $request->phone,
                'name' => $request->name,
                'guest_count' => $request->guest_count,
                'start' => $request->start,
                'message' => $request->message

            ]);
        } catch (\Exception $err) {
            var_dump($err->getMessage());
            die;
        }

        return response()->json([
            'success' => true,
            'message' => 'Order data updated.',
            'data' => $order,
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
        $order = Order::find($id);
        if ($order == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found or not exists.',
                'data' => $order,
                'errors' => true
            ]);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted order data.',
            'data' => $order,
            'errors' => false
        ]);
    }
}
