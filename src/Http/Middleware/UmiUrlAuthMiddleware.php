<?php

namespace YM\Http\Middleware;

use Closure;

class UmiUrlAuthMiddleware
{

    public function handle($request, Closure $next)
    {
        /*var_dump('authority');
        $request->aaa = 'asdfsadfsdaf';
        */

        if (config('umi.url_auth')) {
            //todo: 加载所有菜单
        } else {
            //todo: 执行权限
        }

        return $next($request);
    }
}
