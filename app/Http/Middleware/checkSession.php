<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class checkSession
{
    /**
     * Check session
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $aSession = Session::get('current_user');
        if (count((array)$aSession) === 0) {
            return redirect('/');            
        }
        return $next($request);  
    }
}
