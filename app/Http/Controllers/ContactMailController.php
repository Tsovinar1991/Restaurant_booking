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
        return view('contact.contact_form');
    }

    public function store(Request $request)
    {


//        dd(session()->all());
        $lastRecord = DB::table('contact_us')->orderBy('id', 'DESC')->first();
//       dd($lastRecord->id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $mail = ContactUS::create($request->all());


        try {
            Mail::send('contact.email',
                array(
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'user_message' => $request->get('message')
                ), function ($message) {
                    $message->from('tsovinar.nemesida.grigoryan@gmail.com');
                    $message->to('tsovinar.nemesida.grigoryan@gmail.com', 'Admin')->subject('Contact Us');
                });

        }catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }



        if (!Session::has('contact_id')){
            config(['session.lifetime'=> 1*(60 *24 *365)]);
        Session::put('contact_id', [$mail->id]);
        return back()->with('success', 'Thanks for contacting us!');
        }else{
            config(['session.lifetime'=> 1*(60 *24 *365)]);
            Session::push('contact_id', $mail->id);
            return back()->with('success', 'Thanks for contacting us!');
        }


    }
}



