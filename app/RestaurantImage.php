<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantImage extends Model
{
    protected $table = 'restaurant_images';
    protected $fillable = ['restaurant_id', 'name'];

    public function restaurant(){
        return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
    }
}
