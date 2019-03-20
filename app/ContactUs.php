<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';
    protected $fillable = ['name','email','message'];

    public function parent(){
        return $this->hasOne(ContactUs::class,'id', 'parent_id');
    }

    public function childs(){
        return $this->hasMany(ContactUs::class,'parent_id', 'id');
    }
}


