<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.form');
    }

    public function confirm(Request $request)
    {
        $rules = [
            'subject' => 'required|string',
            'email' => 'required|email',
            'message' => 'required'
        ];
        $this->validate($request, $rules);

        $contact = $request->all();

        $request->session()->regenerateToken();

        return view('contact.confirm', $contact);
    }

    public function sent(Request $request)
    {
        $contact = $request->all();
        if ($request->action === 'back') {
            return redirect()->route('contact')->withInput($contact);
        }

        $request->session()->regenerateToken();

        Mail::to('abetyan31503@gmail.com')->send(new Contact($contact));

        return view('contact.thanks');
    }
}
