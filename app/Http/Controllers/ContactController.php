<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Mail\ContactMail;


class ContactController extends Controller
{
    function show(){
        return view('hotel.contact');
    }
    function submit(ContactRequest $request){
        Mail::to('m.samy1011997@gmail.com')->send(new ContactMail($request->name, $request->subject, $request->email ,$request->message));
        return to_route('/home');
    }
}
