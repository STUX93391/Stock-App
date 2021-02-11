<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfOwner
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
        $status=auth()->user()->status;
        if($status=='owner'){
            return $next($request);
        }
        else{
            return abort('403','Unauthorized');
        }
    }
}
