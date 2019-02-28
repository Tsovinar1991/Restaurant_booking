<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    public function admins()
    {
        return $this
            ->belongsToMany('App\Admin')
            ->withTimestamps();
    }
}
