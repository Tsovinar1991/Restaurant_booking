<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;
use App\RestaurantImage;


class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = ['city_id','name', 'type', 'description', 'avatar', 'address', 'tel', 'email'];

    public function city(){
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function images(){

        return $this->hasMany(RestaurantImage::class);
    }
    public function seats(){

        return $this->hasMany(Seat::class);
    }
}
