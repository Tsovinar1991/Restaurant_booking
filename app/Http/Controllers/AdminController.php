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
//        echo("<pre>");
//        var_dump(session()->all());
//        die();
        $message_count = count(session()->get('contact_id'));
        return view('admin.admin');
    }


    public function read_message()
    {

        if (session()->has('contact_id')) {
            $messages = ContactUs::all()->whereIn('id', session()->get('contact_id'));
//            dd($messages);
            return view('admin.contact.messages')->with('messages', $messages);
        } else
            return view('admin.contact.messages');

    }


    public function clear_messages()
    {
        session()->forget('contact_id');
        return redirect()->back()->with('success', 'Message list is empty, until new messages appear!');
    }


}
