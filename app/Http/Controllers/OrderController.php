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
    public function index($offset, $limit)
    {
        //$orders = Order::all();
        $orders = Order::skip($offset)->take($limit)->get();
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
            'seat_id' => 'required|numeric',
            'guest_count' => 'required|numeric',
            'start' => 'required|date_format:Y-m-d H:i:s',
            'end' => 'required||date_format:Y-m-d H:i:s',
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


        //checking if order start is valid
        $s = explode(" ", $request->start);
        $start = explode(":", $s[1]);
        if ($start[0] < 9 || $start[0] >= 22) {
            return response()->json([
                'success' => false,
                'message' => "Restaurants is open from 9:00 and is closed after 22:00",
                'data' => null,
                'errors' => true
            ]);
        }

        //Checking if start date is weekend
        if ($this->isWeekend($s[0])) {
            return response()->json([
                'success' => false,
                'message' => "Restaurants is not working in weekend.",
                'data' => [],
                'errors' => true
            ]);
        }

        //checking if order end is valid
        $e = explode(" ", $request->end);
        $end = explode(":", $e[1]);
        if ($end[0] > 22 || $end[0] < 10) {
            return response()->json([
                'success' => false,
                'message' => "Restaurants is closed after 22:00 and is open from 9:00",
                'data' => null,
                'errors' => true
            ]);
        }
        //Checking if end date is weekend
        if ($this->isWeekend($e[0])) {
            return response()->json([
                'success' => false,
                'message' => "Restaurants is not working in weekend.",
                'data' => null,
                'errors' => true
            ]);
        }


        $count_restaurant = Restaurant::select('id')->count();
        if ($request->restaurant_id > $count_restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant is not found.',
                'data' => null,
                'errors' => true
            ]);
        }


        $order = Order::create($request->all());
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
            'seat_id' => 'required|numeric',
            'guest_count' => 'required|numeric',
            'start' => 'required|date_format:Y-m-d H:i:s',
            'end' => 'required|date_format:Y-m-d H:i:s',
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

        //checking if order start is valid
        $s = explode(" ", $request->start);
        $start = explode(":", $s[1]);
        if ($start[0] < 9 || $start[0] >= 22) {
            return response()->json([
                'success' => false,
                'message' => "Restaurants is open from 9:00 and is closed after 22:00",
                'data' => null,
                'errors' => true
            ]);
        }

        //Checking if start date is weekend
        if ($this->isWeekend($s[0])) {
            return response()->json([
                'success' => false,
                'message' => "Restaurants is not working in weekend.",
                'data' => [],
                'errors' => true
            ]);
        }

        //checking if order end is valid
        $e = explode(" ", $request->end);
        $end = explode(":", $e[1]);
        if ($end[0] > 22 || $end[0] < 10) {
            return response()->json([
                'success' => false,
                'message' => "Restaurants is closed after 22:00 and is open from 9:00",
                'data' => null,
                'errors' => true
            ]);
        }
        //Checking if end date is weekend
        if ($this->isWeekend($e[0])) {
            return response()->json([
                'success' => false,
                'message' => "Restaurants is not working in weekend.",
                'data' => null,
                'errors' => true
            ]);
        }

        $count_restaurant = Restaurant::select('id')->count();
        if ($request->restaurant_id > $count_restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant is not found.',
                'data' => null,
                'errors' => true
            ]);
        }


        try {
            $order->update($request->all());
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
    public function destroy($id)
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
