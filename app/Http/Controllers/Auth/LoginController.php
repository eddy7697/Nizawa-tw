<?php

namespace App\Http\Controllers\Auth;

use Lang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/cyberholic-system/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
            // new rules here
        ]);
    }

    /**
     * normal user login
     */
    public function userLogin(Request $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        $userValidate = [
            'email' => $user['role']
        ];

        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $userValidator = Validator::make($userValidate, [
            'email' => "in:NORMAL"
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($userValidator->fails()) {
            return redirect('/login')
                        ->withErrors($userValidator)
                        ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('/');
        } 
        
        return Redirect::back();
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     return view('frontend.exception', [
    //         'isThumbShow' => false,
    //         'message' => Lang::get('auth.failed'),
    //     ]);
    // }
}
