<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use Mail;
use App\Mail\ContactMail;
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


        try {
            Mail::send('contact_us.email',
                array(
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'user_message' => $request->get('message')
                ), function ($message) {
                    $message->from('tsovinar.nemesida.grigoryan@gmail.com');
                    $message->to('2019laraveltesting@gmail.com', 'Admin')->subject('Contact Us');
                });

        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }


        if (Mail::failures()) {
            return back()->with('error', 'Email is not send!');
        }
        return back()->with('success', 'Thanks for contacting us!');
    }


}



