<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationLanguage
{
    
    public function handle(Request $request, Closure $next)
    {

        $languages = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'));
        App::setLocale('en');
        
        if($languages != null){

            App::setLocale($languages[0]);
        }else{

            App::setLocale('en');
        }
        
        return $next($request);
    }
}
