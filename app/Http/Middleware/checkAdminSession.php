<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class checkAdminSession
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
            if ($aSession['user_type'] === 2) {
                return redirect('/admin/login');
            }            
        }
        return $next($request);  
    }
}
