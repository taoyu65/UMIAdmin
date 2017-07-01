<?php

namespace YM\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UmiUrlAuthMiddleware
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                Session::flash('previousUrl', $request->fullUrl());
                return redirect()->guest(route('admin'));
            }
        }
        return $next($request);
    }
}
