<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class preflight
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
        if($request->getMethod() == 'OPTIONS'){

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Key, Authorization');
        header('Access-Control-Allow-Credentials: true');
        exit(0);
    }
    return $next($request);
    }
}
