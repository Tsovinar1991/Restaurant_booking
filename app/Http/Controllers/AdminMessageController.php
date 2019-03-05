<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use DB;

class AdminMessageController extends Controller
{
    public function set_messages_read(Request $request){

       //$mails =  ContactUs::all()->update(['status'=> $request->status]);
        $mails = DB::table('contact_us')->update(array('status' => 1));
        return response($mails);
       if($mails) {
           return response(["Done"]);
       }else{
           return response(["Not Done"]);
       }
    }
}
