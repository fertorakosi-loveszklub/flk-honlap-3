<?php
/**
 * (c) 2016. 10. 17..
 * Authors: nxu
 */

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminRightsRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return redirect('/');
        }

        if (! Auth::guard($guard)->user()->isAdmin()) {
            return redirect('/');
        }

        return $next($request);
    }

}
