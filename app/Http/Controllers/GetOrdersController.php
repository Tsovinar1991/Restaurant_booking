<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderInfo;
use App\MenuOrder;
use Validator;
use App\RestaurantMenu;
use DB;

class GetOrdersController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'total' => 'required|numeric',
            'delivery_price' => 'required|numeric',
            'is_delivery' => 'required|numeric',
            'payment_type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $validator->errors()
            ], 401);
        }

        //filling results into products array
        $menu_id = [];
        for ($i = 0; $i < count(request('products')); $i++) {
            $menu_id[] .= $request->products[$i]['menu_id'];
            $tempStr = implode(',', $menu_id);
            $products = RestaurantMenu::whereIn('id', $menu_id)->orderByRaw(DB::raw("FIELD(id, $tempStr)"))->get();
        }


        //checking if product is active, if not error massage
        foreach ($products as $p) {
            if ($p->status != 1) {
                $not_active = collect(['Order' => [$p->name_en . ' not active at the moment.']]);
                return response()->json([
                    'success' => false,
                    'message' => 'Error',
                    'data' => null,
                    'errors' => $not_active
                ], 404);

            }

        }


        //check if resuls count is equal request products count, if not return error
        if (count($products) != count(request('products'))) {
            $not_exist = collect(['Order' => ['Product does not exist.']]);
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'data' => null,
                'errors' => $not_exist
            ], 404);
        }


        //calculation part
        $total = 0;
        $totalItem = [];
        for ($i = 0; $i < count($products); $i++) {
            $totalItem[$products[$i]->id] = $products[$i]->price * $request->products[$i]['count'];
            $total += $products[$i]->price * $request->products[$i]['count'];
        }

        $order = OrderInfo::create([
            'name' => request('name'),
            'telephone' => request('phone'),
            'address' => request('address'),
            'delivery_price' => request('delivery_price'),
            'is_delivery' => request('is_delivery'),
            'payment_type' => request('payment_type'),
            'total' => $total
        ]);


        for ($i = 0; $i < count(request('products')); $i++) {
            $order_menu = MenuOrder::create([
                'order_info_id' => $order->id,
                'menu_id' => $request->products[$i]['menu_id'],
                'count' => $request->products[$i]['count'],
                'total' => $totalItem[$request->products[$i]['menu_id']]
            ]);
        }

        if ($order && $order_menu) {
            return response()->json([
                'success' => true,
                'message' => 'Order is Send',
                'data' => $order,
                'errors' => false
            ],200);
        }
    }


    public function test()
    {

    }
}
