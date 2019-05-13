<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class checkTeacher
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
        if ($aSession['user_type'] === 1) {
            return $next($request);         
        }    
        return redirect('/forbidden');   
    }
}
