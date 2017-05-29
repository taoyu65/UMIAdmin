<?php

namespace YM\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Umi\TableRelation\UmiTableRelation;

class TableRelationConfirmationMiddleware
{
    #操作数据之前的行为 提示确认页面
    #the action before the data table operation, confirmation page
    public function handle($request, Closure $next)
    {
        #是否开启数据表关连操作
        #if it's available for data table relation operation
        if (Config::get('umi.table_relation_operation') == false)
            return $next($request);

        #参数fields如果不设置 则不加载数据表的关联操作
        #table relation operation will be not completed if parameter "fields" is not applied
        $activeFieldValues = $request->route()->parameter('fields');
        $deCodeActiveFieldValues = base64_decode($activeFieldValues);
        if (!$activeFieldValues)
            return $next($request);

        Umi::setCurrentTableName($request->table);

        #使提交按钮不可用
        #make the submit button is unavailable
        $umiTR = new UmiTableRelation();
        if (!$umiTR->showConfirmation($deCodeActiveFieldValues)) $request['TRO_Available'] = false;
        $request['TRO_Message'] = $umiTR->message;

        #将所有对应数据传递到下一层(执行额外数据操作层)
        #transferring all data to the next level which is extra operation layer
        $request['activeFieldValue'] = $activeFieldValues;

        $response = $next($request);

        return $response;
    }
}