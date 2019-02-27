<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class RestaurantImage extends Model
{
    use Sortable;
    protected $table = 'restaurant_images';
    protected $fillable = ['restaurant_id', 'name', 'title'];
    public $sortable = ['id', 'title', 'restaurant_id'];

    public function restaurant(){
        return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
    }
}
