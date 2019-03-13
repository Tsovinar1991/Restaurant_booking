<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        if (!$request->user()->hasRole($role)) {
           //abort(401, 'This action is unauthorized.');
//            return view('admin.404');
            return redirect()->route('admin.error')->with('error','Unauthorized action!')->with('status_cod', 403);
        }
        return $next($request);
    }
}
