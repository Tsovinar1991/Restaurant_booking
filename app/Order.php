<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Restaurant;
use App\Seat;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['restaurant_id', 'seat_id', 'name', 'tel', 'guest_count', 'start', 'end', 'message', 'status'];


    public function restaurant(){
        return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
    }

    public function seat(){
        return $this->hasOne(Seat::class, 'id', 'seat_id');
    }
}
