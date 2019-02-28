<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderInfo;
use App\MenuOrder;
use Validator;
use App\RestaurantMenu;

class GetOrdersController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'total' => 'required|numeric'


        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $validator->errors()
            ]);
        }

        //Calculation
        //Check order total price correct or not
        $menu_id = [];
        for ($i = 0; $i < count(request('products')); $i++) {
            array_push($menu_id, $request->products[$i]['menu_id']);
            $products = RestaurantMenu::whereIn('id', $menu_id)->get();
        }
        //var_dump($menu_id);

        //var_dump($products);
        //die();


        $total = "";
        $totalItem = [];
        for ($i = 0; $i < count(request('products')); $i++) {
            for ($i = 0; $i < count($products); $i++) {
                $totalItem[$products[$i]->id] = $products[$i]->price * $request->products[$i]['count'];
                $total += $products[$i]->price * $request->products[$i]['count'];
            }
        }


        //var_dump($totalItem);

        $order = OrderInfo::create([
            'name' => request('name'),
            'telephone' => request('phone'),
            'address' => request('address'),
            'total' => $total
        ]);


        for ($i = 0; $i < count(request('products')); $i++) {
            $counter = $request->products[$i]['menu_id']; //6,7
            var_dump($totalItem[$counter]);
            $order_menu = MenuOrder::create([
                'order_info_id' => $order->id,
                'menu_id' => $request->products[$i]['menu_id'],
                'count' => $request->products[$i]['count'],
                'total' => $totalItem[$counter]
            ]);


        }

        if ($order && $order_menu) {
            return response()->json([
                'success' => true,
                'message' => 'Order is Send',
                'data' => $order,
                'errors' => false
            ]);
        }

    }


    public function test()
    {

    }
}

