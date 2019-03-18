<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


}
