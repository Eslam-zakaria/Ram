<?php

namespace App\Http\Middleware;

use App;
use Arr;
use Closure;
use Config;
use Session;
use Route;
class Language
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
            $segment = in_array($request->lang, Config::get('translatable.locales')) ? $request->lang : 'ar';

            Config::set('translatable.locale', $segment);
            Config::set('app.locale', $segment);
            App::setLocale($segment);
            Session::put('locale', $segment);
          
        return $next($request);
    }
}
