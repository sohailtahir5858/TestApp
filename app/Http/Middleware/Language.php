<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Language
{


    public function handle($request, Closure $next)
    {
        // We are checking if appLocale variable is in the session. if yes then we are checking
        // if this variable(which is in session) belongs to the language.php which is placed in
        // config directory. if yes then it will simply set the Locale variable to that language which is in the session
        if (Session()->has('applocale') and array_key_exists(Session()->get('applocale'), config('languages'))) {
            App::setLocale(Session()->get('applocale'));
        } else {
             // If the language that is in variable setLcale (in session) is not recognized, then use the default fallback_locale
            App::setLocale(config('app.fallback_locale'));
        }
        // move to the next request
        return $next($request);
    }
}
