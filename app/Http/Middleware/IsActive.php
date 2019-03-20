<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsActive
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
        if($request->user()->status == 0){
            Auth::guard('admin')->logout();
            session()->flush();
            session()->regenerate();
            return redirect(url('admin/login'));
        }
        return $next($request);
    }
}
