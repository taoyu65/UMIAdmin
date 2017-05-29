<?php

namespace YM\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use YM\Umi\TableRelation\UmiTableRelation;
use YM\Facades\Umi;

class TableRelationExecuteMiddleware
{
    public function handle($request, Closure $next)
    {
        #是否开启数据表关连操作
        #if it's available for data table relation operation
        if (Config::get('umi.table_relation_operation') == false)
            return $next($request);

        Umi::setCurrentTableName($request->table);

        $response = $next($request);

        if (!$request['hidden_afv'])
            return $response;

        #如果成功执行了动作 则进行数据关联操作
        #if the action was completed then go next action which are the data table relation operations
        if (isset($request['action_success']) && $request['action_success'] === true) {
            $activeFieldValues = $request['hidden_afv'];
            $activeFieldValues = base64_decode($activeFieldValues);
            $umiTR = new UmiTableRelation();
            $umiTR->executeExtraOperation($activeFieldValues);
        }

        return $response;
    }
}