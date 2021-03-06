<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class RestaurantMenu extends Model
{

    use Sortable;
    public $sortable = ['id', 'price', 'weight', 'status', 'restaurant_id', 'parent_id'];
    protected $table = 'restaurant_menus';

    protected $fillable = ['name_en', 'name_ru', 'name_am', 'description_en', 'description_ru', 'description_am', 'weight', 'avatar', 'parent_id', 'restaurant_id', 'price', 'status'];

    public function restaurant()
    {
        return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
    }

    public function adminCreated()
    {
        return $this->hasOne(Admin::class, 'id', 'created_by');
    }

    public function adminUpdated()
    {
        return $this->hasOne(Admin::class, 'id', 'updated_by');
    }

    public function category()
    {
        return $this->hasOne(RestaurantMenu::class, 'id', 'parent_id');
    }


}