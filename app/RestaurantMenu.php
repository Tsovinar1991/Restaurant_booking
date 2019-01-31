<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantMenu extends Model
{
    protected $table = 'restaurant_menus';

    protected $fillable = ['name', 'description', 'avatar', 'parent_id', 'restaurant_id', 'price'];

}