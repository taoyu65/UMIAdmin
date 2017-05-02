<?php

namespace YM\Http\Middleware;

use Closure;
use YM\Umi\TableRelation\UmiTableRelation;
use YM\Facades\Umi;

class TableRelationExecuteMiddleware
{
    public function handle($request, Closure $next)
    {
        Umi::setCurrentTableName($request->table);

        $response = $next($request);

        #如果成功执行了动作 则进行数据关联操作
        #if the action was completed then go next action which are the data table relation operations
        if (isset($request['action_success']) && $request['action_success'] === true) {
            $activeFieldValues = $request['hidden_afv'];
            $activeFieldValues = base64_decode($activeFieldValues);
            $umiTR = new UmiTableRelation();
            $umiTR->executeAfterAction($activeFieldValues);
        }

        return $response;
    }
}