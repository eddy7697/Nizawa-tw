<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LocaleController extends Controller
{
    public function switchLang($lang)
    {
        
        if (array_key_exists($lang, Config::get('languages'))) {
            Log::info(Session::get('applocale'));
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }
}
