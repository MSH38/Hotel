<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Mail\ContactMail;
use App\Models\Contact;


class ContactController extends Controller
{
    // function show(){
    //     return view('hotel.contact');
    // }
    // function submit(ContactRequest $request){
    //     Mail::to('m.samy1011997@gmail.com')->send(new ContactMail($request->name, $request->subject, $request->email ,$request->message));
    //     return to_route('/home');
    // }
    
    // Create Contact Form
    public function createForm (Request $request) {
        return view('hotel.contact');
      }
      // Store Contact Form data
      public function ContactUsForm(Request $request) {
        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'message' => 'required'
         ]);
        //  Store data in database
        Contact::create($request->all());
        //  Send mail to admin
        \Mail::send('mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('digambersingh126@gmail.com', 'Admin')->subject($request->get('subject'));
        });
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

}
