<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $table = "order_infos";
    protected $fillable = ["name", "telephone", "address", "total"];
}
