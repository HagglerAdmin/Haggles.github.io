<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

class CheckProductSlug
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
        
        $product = (new \App\Repositories\Products)->validateUrl($request->id);
        
        $url = "p/".str_replace(' ','-', strtolower($request->slug))."&id=".$request->id;
        
        if ( $product !=  $url){

            return Redirect::back();
        }

        return $next($request);
    }
}
