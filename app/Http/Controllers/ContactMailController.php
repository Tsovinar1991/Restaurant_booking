<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use Mail;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ContactMailController extends Controller
{

    public function index()
    {
        return view('contact_us.contact_form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $mail = ContactUS::create($request->all());

        Mail::to('2019laraveltesting@gmail.com')->send(new ContactEmail($mail));

        if (Mail::failures()) {
            return back()->with('error', 'Email is not send!');
        }
        return back()->with('success', 'Thanks for contacting us!');
    }


}



