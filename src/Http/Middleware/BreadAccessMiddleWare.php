<?php

namespace YM\Http\Middleware;

use Closure;

class BreadAccessMiddleWare
{
    public function handle($request, Closure $next)
    {
        //var_dump('a');
        return $next($request);
    }
}