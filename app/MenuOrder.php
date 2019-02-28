<?php

namespace App;

use App\RestaurantMenu;
use App\OrderInfo;
use Illuminate\Database\Eloquent\Model;

class MenuOrder extends Model
{
    protected $table = 'order_menus';

    protected $fillable = ['order_info_id', 'menu_id', 'count', 'total'];

    public function order_infos(){

        return $this->hasMany(OrderInfo::class , 'id', 'order_info_id');
    }


    public function menus(){

        return $this->hasMany(RestaurantMenu::class,'id', 'menu_id');
    }
}
