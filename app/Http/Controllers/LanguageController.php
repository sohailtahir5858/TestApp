<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    // This method will be used to switch from one to another language
    public function switchLang($lang)
    {
        // if the language in $lang exists in config.languages.php then put the passed language in
        // session
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }

        // return back
        return redirect()->back();
    }
}
