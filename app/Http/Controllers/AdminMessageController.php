<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use DB;

class AdminMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function read_message()
    {
        $mails = ContactUs::all()->where('status', 0);
        if ($mails) {
            return view('admin.contact_us.messages', compact('mails'));
        } else {
            return view('admin.contact_us.messages');
        }
    }

    public function set_messages_read(Request $request)
    {

        //$mails =  ContactUs::all()->update(['status'=> $request->status]);
        $mails = DB::table('contact_us')->update(array('status' => 1));
        return response($mails);
        if ($mails) {
            return response(["Done"]);
        } else {
            return response(["Not Done"]);
        }
    }
}
