<?php
/**
 * (c) 2016. 10. 27..
 * Authors: nxu
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function postContact(Request $request)
    {
        $this->validate($request, [
            'url' => 'honeypot',
            'website' => 'honeytime:3',
            'email' => 'required',
            'user_message' => 'required'
        ]);

        Mail::send(
            'emails.contact',
            $request->only('email', 'phone', 'user_message'),
            function($mail) {
                $mail->subject("Lövészklub: érdeklődés");
                $mail->to("nxu@nxu.hu", "Fekete Zsolt");
            }
        );

        return response()->json(['sucess' => true]);
    }
}
