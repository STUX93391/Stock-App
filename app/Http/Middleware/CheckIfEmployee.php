<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $staus=auth()->user()->status;
        if($staus=='employee'){
            return $next($request);

        }else{
            return abort('403','Unauthorized');
        }
    }
}
