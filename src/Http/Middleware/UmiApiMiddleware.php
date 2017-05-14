<?php

namespace YM\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UmiApiMiddleware
{
    public function handle($request, Closure $next)
    {
        return Auth::onceBasic() ?: $next($request);
    }
}