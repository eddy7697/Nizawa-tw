<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use PublicServiceProvider;
use Mail;

class MailController extends Controller
{
    public function sendForm(Request $request)
    {
        $data = $request->all();

        session_start();

        if ($_SESSION['captcha'] !== $request->captcha) {
            return Redirect::back()->withErrors(array('captcha_error' => 'Captcha wrong'));
        }

        // $validator = Validator::make($data, [
        //     'g-recaptcha-response' => 'required|captcha'
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/contact')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

        Mail::send('mail.contact', [
            'name' => $data['name'],
            'email' => $data['email'],
            'company' => $data['company'],
            'type' => $data['type'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'content' => $data['content']
        ], function($message) use ($data) {
            $message->to(['info@nizawa-int.com.tw', 'vincent7697@gmail.com' ])->subject('日澤官方網站諮詢表單');
            $message->from('info@nizawa-int.com.tw', $name = env('APP_NAME'));
        });

        return PublicServiceProvider::exception(trans('string.send_success'));
    }
}
