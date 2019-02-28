<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;

class AdminRoles extends Model
{

    protected $table = "admin_roles";
    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }
}
