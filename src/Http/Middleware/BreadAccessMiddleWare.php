<?php

namespace YM\Http\Middleware;

use Closure;
use YM\Exceptions\UmiException;
use YM\umiAuth\umiAuth;

class BreadAccessMiddleWare
{
    public function handle($request, Closure $next, $action)
    {
        $umiAuth = new umiAuth();
        $table = $request->route()->parameter('table');
        $permission = $action . '-' . $table;
        if (!$umiAuth->can($permission))
            throw new UmiException("You are not authorized to $action this record");

        return $next($request);
    }
}