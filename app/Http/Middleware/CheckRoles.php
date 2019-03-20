<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles = null)
    {

//        if($request->user()->status == 0){
//            Auth::guard('admin')->logout();
//            session()->flush();
//            session()->regenerate();
//            return redirect(url('admin/login'));
//        }

        if ($roles != null) {
            if (!$request->user()->hasAnyRole(explode("|", $roles))) {
                return redirect()->route('admin.error')->with('error','Unauthorized action!')->with('status_cod', 403);
            }
        }
        return $next($request);
    }

}
