<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class MailController extends Controller
{
    public function sendForm(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return redirect('/contact')
                        ->withErrors($validator)
                        ->withInput();
        }

        Mail::send('mail.contact', [
            'name' => $data['name'],
            'email' => $data['email'],
            'company' => $data['company'],
            'phone' => $data['phone'],
            'content' => $data['content']
        ], function($message) use ($data) {
            $message->to([ $data['email'], env('MAIL_USERNAME'), '044555@gmail.com' ])->subject('易耕事業 客戶詢問');
            $message->from(env('MAIL_USERNAME'), $name = env('APP_NAME'));
        });

        return redirect('/');
    }
}
