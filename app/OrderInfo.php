<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $table = "order_infos";
    protected $fillable = ["name", "delivery_price", "is_delivery", "payment_type", "telephone", "address", "total"];
}
