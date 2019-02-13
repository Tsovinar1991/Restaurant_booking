<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderInfo;
use App\MenuOrder;
use App\RestaurantMenu;
use \TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Support\Facades\DB;


class VoyagerOrderController extends VoyagerBaseController
{
    public function orders()
    {

        $order = OrderInfo::whereStatus('old')->Orwhere('status', 'in progress')->Orwhere('status', 'canceled')->orderBy('id', 'DESC')->paginate(6);
        //return view("voyager::voyager.order", compact('order'));
        return view("voyager.order", compact('order'));
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
//            $order = OrderInfo::all()->where('status', 'new')->where('id', '>', "$request->o");
//            return response()->json($order);
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



//        $order = OrderInfo::all()->where('status', 'new');
//       return response()->json($order);
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
            } else {
                return response()->json("Order is Canceled");
            }
        }
    }


    public function test()
    {
        $test = DB::table('order_infos')
            ->join('order_menus', 'order_infos.id', '=', 'order_menus.order_info_id')
            ->join('restaurant_menus', 'restaurant_menus.id', '=', 'order_menus.menu_id')
            ->where('order_infos.id', '=', '1')
//            ->where('order_infos.status', '=', 'old')
            ->select('restaurant_menus.*', 'order_infos.*')->get();
        echo("<pre>");
        var_dump($test);
    }
}
