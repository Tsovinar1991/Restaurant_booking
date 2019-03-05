<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin');
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


}
