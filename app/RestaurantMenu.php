<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class RestaurantMenu extends Model
{

    use Sortable;
    public $sortable = ['id', 'name', 'description', 'price', 'weight', 'status', 'restaurant_id', 'parent_id'];
    protected $table = 'restaurant_menus';

    protected $fillable = ['name', 'description', 'weight', 'avatar', 'parent_id', 'restaurant_id', 'price', 'status'];

}