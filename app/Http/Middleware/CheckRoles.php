<?php

namespace App\Http\Middleware;

use Closure;

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
        if ($roles != null) {
            if (!$request->user()->hasAnyRole(explode("|", $roles))) {
                return redirect()->route('admin.error')->withErrors('Unauthorized action!')->with('status_cod', 403);
            }
        }
        return $next($request);
    }

}
