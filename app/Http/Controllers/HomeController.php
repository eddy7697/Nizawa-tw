<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use App\User;
use App\Bonus;
use App\Admin;
use App\Address;
use App\SocialProvider;
use App\Services\PublicServiceProvider;
use Auth;
use Cart;
use Mail;
use Log;
use Artisan;
use Config;
use Analytics;
use Spatie\Analytics\Period;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('dashboard/admin');
    }

    public function createAdmin($value='')
    {
        if (count(User::all())) {
            return redirect('/');
        } else {
            return User::create([
                'guid' => PublicServiceProvider::generateGuid(),
                'name' => '最高管理者',
                'email' => 'admin@admin.com',
                // 'jobTitle' => 'SuperUser',
                'password' => bcrypt('admin123'),
                'point' => 9999,
                'role' => 'ADMIN',
                'level' => 'VIP'
            ]);
        }

    }

    public function test($value='')
    {

        return "Artisan::call('migrate')";
        $product = Product::where('isPublish', 1)
                    // ->where('schedulePost', '<', date('Y-m-d H:i:s'))
                    // ->where('scheduleDelete', '>', date('Y-m-d H:i:s'))
                    ->paginate(1);
        // return json_encode($product);

        return view('test', [
            'title' => '123',
            'shortcut' => '/',
            'isThumbShow' => false,
            'product' => $product,
        ]);
    }

    public function testPost(Request $request)
    {
        if (Input::hasFile('files')){
            $files = Input::file('files');
            foreach ($files as $file) {
                $file->move('uploads' , time().$file->getClientOriginalName());
            }
        } else {
            echo 'Not Uploaded';
        }
    }

    public function testAction()
    {
        // Config::set('mailTarget.test', 'array');
        // return config('mailTarget.test');
        return 'oh yeah';
    }

    public function truncate()
    {
        User::query()->truncate();
        SocialProvider::query()->truncate();
    }

    public function checkAuth()
    {
        $authStatus = array(
            'auth' => Auth::check()
        );
        return $authStatus;
    }

    public function getAddress($guid)
    {
        return Address::where('owner', $guid)->first();
    }

    public function gaTest()
    {
        //retrieve visitors and pageview data for the current day and the last seven days
        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        //retrieve visitors and pageviews since the 6 months ago
        // $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::months(6));

        //retrieve sessions and pageviews with yearMonth dimension since 1 year ago
        // $analyticsData = Analytics::performQuery(
        //     Period::years(1),
        //     'ga:sessions',
        //     [
        //         'metrics' => 'ga:sessions, ga:pageviews',
        //         'dimensions' => 'ga:yearMonth'
        //     ]
        // );

        return $analyticsData;
    }

    public function esunec(Request $request)
    {
        return $request->all();
    }

    /**
     * string random
     */
    public function getString()
    {
        return hash('sha256', str_random(6));
    }

    /**
     * Captcha
     */
    public function captcha()
    {
        session_start();

        if(isset($_SESSION['captcha']))
        {
            unset($_SESSION['captcha']);
        }

        //getting the required random 5 characters
        $captcha_text = (string)rand(100000, 999999);

        $_SESSION['captcha'] = $captcha_text;

        header("Content-type: image/png");// setting the content type as png
        $captcha_image=imagecreatetruecolor(120,40);

        $captcha_background=imagecolorallocate($captcha_image, 255, 255, 255);//setting captcha background colour
        $captcha_text_colour=imagecolorallocate($captcha_image, 255, 148, 77);//setting cpatcha text colour

        $glitch_colour = imagecolorallocate($captcha_image, 100, 100, 100);

        imagefilledrectangle($captcha_image,0,0,120,40,$captcha_background);//creating the rectangle

        $font = storage_path('arial.ttf');//setting the font path

        imagettftext($captcha_image,20,0,16,30,$captcha_text_colour,$font,$captcha_text);

        for ($i = 0; $i < 200 ; $i++) { 
            imagettftext($captcha_image,10,0,rand(1, 140),rand(1, 40),$glitch_colour,$font,'.');
        }
        
        imagepng($captcha_image);
        imagedestroy($captcha_image);
    }
}
