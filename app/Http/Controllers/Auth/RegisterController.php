<?php

namespace App\Http\Controllers\Auth;

use App\SocialProvider;
use App\User;
use App\Bonus;
use App\Http\Controllers\Controller;
use App\Services\PublicServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        try {
            $this->defaultPoint = Bonus::all()->first()['defaultPoint'];
        } catch (\Exception $e) {
            $this->defaultPoint = 25;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        try {
            $defaultPoint = Bonus::all()->first()['defaultPoint'];
        } catch (\Exception $e) {
            $defaultPoint = 25;
        }

        return User::create([
            'guid' => PublicServiceProvider::generateGuid(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'point' => $defaultPoint,
            'role' => 'NORMAL',
            'level' => 'VIP'
        ]);
    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider = "")
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider = "")
    {
        try
        {
            $socialUser = Socialite::driver($provider)->user();
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return redirect('/');
        }

        $checkAccountExist = User::where('email', $socialUser->getEmail())->first();

        $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();

        log::info($checkAccountExist);

        if ($checkAccountExist) {
            $checkAccountExist->socialProviders()->create([
                'provider_id' => $socialUser->getId(),
                'provider' => $provider
            ]);

            $userToAuth = $checkAccountExist;
        } else {
            if(!$socialProvider)
            {
                $user = User::Create([
                    'guid' =>PublicServiceProvider::generateGuid(),
                    'email' => $socialUser->getEmail(),
                    'name' => $socialUser->getName(),
                    'socialUser' => true,
                    'point' => 0,
                    'role' => 'NORMAL',
                    'level' => 'NORMAL'
                ]);

                $user->socialProviders()->create([
                    'provider_id' => $socialUser->getId(),
                    'provider' => $provider
                ]);
            }
            else
            {
                $user = $socialProvider->user;
            }

            $userToAuth = $user;
        }

        auth()->login($userToAuth);

        return redirect('/');
    }
}
