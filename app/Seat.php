<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Restaurant;

class Seat extends Model
{
    protected $table = 'seats';
    protected $fillable = ['restaurant_id', 'total', 'name', 'price'];

    public function restaurant(){
        return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
    }
}
