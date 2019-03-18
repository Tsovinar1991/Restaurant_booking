<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use DB;
use Mail;
use Validator;

class AdminMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function read_message()
    {
        $mails = ContactUs::all()->where('status', 0);
        $mails = $mails->sortByDesc('id');
        if ($mails) {
            return view('admin.contact_us.messages', compact('mails'));
        } else {
            return view('admin.contact_us.messages');
        }
    }

    public function set_messages_read(Request $request)
    {

        //$mails =  ContactUs::all()->update(['status'=> $request->status]);
        $mails = DB::table('contact_us')->where('id', $request->id)->update(array('status' => 1));
        return response($mails);
        if ($mails) {
            return response(["Done"]);
        } else {
            return response(["Not Done"]);
        }
    }


    public function answer_message(Request $request, $id)
    {
        $mail = ContactUs::where('id', $id)->first();
        $emailTo = $mail->email;

//        dd( $request->message . $emailTo);


        $validator = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error', 'Mail is not send, because message field is required!');
        }



        Mail::send('contact_us.email_answer',
                array(
                    'user_message' => $request->message
                ), function ($message) use ($emailTo){
                    $message->from('2019laraveltesting@gmail.com');
                    $message->to( $emailTo, 'Customer')->subject('Contact Us');
                });


        if(Mail::failures()){
            return back()->with('error', 'Email is not send!');
        }
        return back()->with('success', 'Answer is send Successfull!');


    }
}
