<?php

namespace YM\Http\Middleware;

use Closure;
use YM\Facades\Umi;
use YM\Umi\Admin\AdminStrategy;
use YM\umiAuth\umiAuth;

class BreadAccessMiddleware
{
    public function handle($request, Closure $next, $action)
    {
        $tableName = $request->route()->parameter('tableName');

        #检查用户是否拥有全部权限
        #check this user if has all the permission
        $adminStrategy = new AdminStrategy($tableName);
        if ($adminStrategy->hasSuperPermission()) {
            return $next($request);
        } else {
            if (Umi::isSystemRole()) {
                if (!$adminStrategy->actionPermission($action))
                    exit("You are not authorized to $action this record");
            } else {
                $umiAuth = new umiAuth();
                //$tableName = Umi::umiDecrypt($tableName);
                $permission = $action . '-' . $tableName;
                if (!$umiAuth->can($permission))
                    exit("You are not authorized to $action this record");
                //abort(403, "You are not authorized to $action this record");
            }
        }

        return $next($request);
    }
}
