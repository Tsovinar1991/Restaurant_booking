<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderInfo;
use App\MenuOrder;
use App\RestaurantMenu;

use Illuminate\Support\Facades\DB;

class AdminDeliveryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function orders()
    {
        $order = OrderInfo::whereStatus('confirmed')->Orwhere('status', 'in progress')->Orwhere('status', 'canceled')->orderBy('id', 'DESC')->paginate(6);
        foreach ($order as $key => $o) {
            $orderItem = MenuOrder::select('restaurant_menus.*', 'order_menus.count', 'order_menus.total')
                ->join('restaurant_menus', 'restaurant_menus.id', '=', 'order_menus.menu_id')
                ->where('order_menus.order_info_id', '=', $o['id'])
                ->get();
            $order_list[$o['id']] = $orderItem;
        }
        return view("admin.delivery.productOrders", compact('order', 'order_list'));
    }

    public function getNewOrders(Request $request)
    {
        if (isset($request->o)) {
            $order_list = [];
            $orders = OrderInfo::where('status', '=', 'new')->where('id', '>', "$request->o")->get();
            foreach ($orders as $key => $order) {
                $orderItem = MenuOrder::select('restaurant_menus.*', 'order_menus.count', 'order_menus.total')
                    ->join('restaurant_menus', 'restaurant_menus.id', '=', 'order_menus.menu_id')
                    ->where('order_menus.order_info_id', '=', $order['id'])
                    ->get();
                $order_list[$order['id']] = [
                    'products' => $orderItem,
                    'order_info' => $order
                ];
            }
            return json_encode($order_list, true);
        }
        $order_list = [];
        $orders = OrderInfo::where('status', '=', 'new')->get();
        foreach ($orders as $key => $order) {
            $orderItem = MenuOrder::select('restaurant_menus.*', 'order_menus.count', 'order_menus.total')
                ->join('restaurant_menus', 'restaurant_menus.id', '=', 'order_menus.menu_id')
                ->where('order_menus.order_info_id', '=', $order['id'])
                ->get();
            $order_list[$order['id']] = [
                'products' => $orderItem,
                'order_info' => $order
            ];
        }
        return json_encode($order_list, true);
    }

    public function setStatus(Request $request)
    {
        if (isset($request->id) && isset($request->status)) {
            $order = OrderInfo::find($request->id);
            if ($order) {
                $order->status = $request->status;
                $order->save();
            }
            if ($order->status === "in progress") {
                return response()->json("Order is in Progress");
            } elseif ($order->status === "confirmed") {
                return response()->json("Order is Confirmed");
            } else {
                return response()->json("Order is Canceled");
            }
        }
    }

    public function test()
    {
        $order_list = [];
        $orders = OrderInfo::whereStatus('confirmed')->Orwhere('status', 'in progress')->Orwhere('status', 'canceled')->orderBy('id', 'DESC')->get();
        foreach ($orders as $key => $order) {
            $orderItem = MenuOrder::select('restaurant_menus.*', 'order_menus.count', 'order_menus.total')
                ->join('restaurant_menus', 'restaurant_menus.id', '=', 'order_menus.menu_id')
                ->where('order_menus.order_info_id', '=', $order['id'])
                ->get();
            $order_list[$order['id']] = $orderItem;
        }
// return json_encode($order_list, true);
        foreach ($order_list as $key => $products) {
            foreach ($products as $prod) {
                echo "<pre>";
                print_r($key . "   " . $prod['id'] . "<br>");
            }
//            var_dump($o['products']);
        }
        die();
        return json_encode($order_list, true);
    }
}