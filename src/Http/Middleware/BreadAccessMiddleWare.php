<?php

namespace YM\Http\Middleware;

use Closure;
use YM\umiAuth\umiAuth;

class BreadAccessMiddleware
{
    public function handle($request, Closure $next, $action)
    {
        $umiAuth = new umiAuth();
        $table = $request->route()->parameter('table');
        $permission = $action . '-' . $table;
        if (!$umiAuth->can($permission))
            abort(403, "You are not authorized to $action this record");

        return $next($request);
    }
}