<?php

namespace YM\Http\Middleware;

use Closure;

class UmiUrlAuthMiddleware
{

    public function handle($request, Closure $next)
    {

        //todo: get all menus and transfer them to the master page. using cache

        //todo: entrance class administrator divide 2 parts: menu and bread.(may change administrator name)
        return $next($request);
    }
}
