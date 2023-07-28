<?php

namespace App\Http\Middleware;

use Closure;
class LanguageAutodetectionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
        $acceptLang = ['es', 'de', 'en'];
        $lang = in_array($userlang,$acceptLang) ? $userlang : 'en';
        \App::setLocale($lang);
        
        if($lang == 'es'){$lang='es_ES';}
        else if($lang == 'de'){$lang='de_DE';}
        else {$lang ='en_GB';}
        
        $request->request->add(['lang' => $lang]);
        return $next($request);

    }
}
