<?php

namespace App\Http\Middleware;

use App\Enums\RedirectUrlEnum;
use Closure;

class RedirectUrlMiddleware
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
        # Get all links in redirect url enum class.
        foreach (RedirectUrlEnum::LINKS as $link){

            # implode request segments to get current url without domain and check if current url exist in "RedirectUrlMiddleware" class.
            if( implode('/', request()->segments()) === $link['old'] )
                return redirect($link['new'], $link['code']); # if exist return to new url.

        }

        return $next($request);
    }
}
