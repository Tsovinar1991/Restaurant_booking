<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Menu;

class Page extends Model
{
    protected $table="pages";
    protected $fillable = ['id', 'name_ru', 'name_am', 'name_en', 'description_ru', 'description_am', 'description_en', 'menu_id'];

      public function menu(){
          return $this->hasOne(Menu::class, 'id', 'menu_id');
      }

}
