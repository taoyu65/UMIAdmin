<?php

namespace YM\Http\Middleware;

use Closure;

class BreadSubmitMiddleWare
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}