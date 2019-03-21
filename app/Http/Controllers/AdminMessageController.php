<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use DB;
use Mail;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class AdminMessageController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function read_message()
    {
        $mails = ContactUs::with('childs')->where('status', 0)->where('name', '!=','Restaurant Admin')->orderBy('id', 'desc')->get();
        if ($mails) {
            return view('admin.contact_us.messages', compact('mails'));
        } else {
            return view('admin.contact_us.messages');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function answer_message(Request $request, $id)
    {
        $mail = ContactUs::where('id', $id)->first();
        $emailTo = $mail->email;
        $validator = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Mail is not send, because message field is required!');
        }

        $answer = new ContactUs;
        $answer->name = 'Restaurant Admin';
        $answer->email = '2019laraveltesting@gmail.com';
        $answer->message = $request->message;
        $answer->parent_id = $mail->id;
        $answer->save();


        Mail::send('contact_us.email_answer',
            array(
                'user_message' => $request->message
            ), function ($message) use ($emailTo) {
                $message->from('2019laraveltesting@gmail.com');
                $message->to($emailTo, 'Customer')->subject('Contact Us');
            });


        if (Mail::failures()) {
            return back()->with('error', 'Email is not send!');
        }

        if(isset($request->history) && $request->history == 'history') {
            return Redirect::to(URL::previous() . "#here");
        }else{
            return back()->with('success', 'Answer is send Successfull!');
        }

    }

    public function history($id){
        $customer = ContactUs::find($id);
        if(!$customer){
            return redirect()->route('admin.error')->with('error', 'Email is not found!')->with('status_cod', 404);
        }
        $emails = ContactUs::with('childs')->where('email', $customer->email)->get();
        $last_id = ContactUs::where('email', $customer->email)->orderBy('id','desc')->first();
        return view('admin.contact_us.history', compact(['emails','last_id']));
    }




}
