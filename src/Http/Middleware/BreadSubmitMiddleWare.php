<?php

namespace YM\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Umi\TableRelation\UmiTableRelation;

class BreadSubmitMiddleWare
{
    public function handle($request, Closure $next)
    {
        #是否开启数据表关连操作
        #if it's available for data table relation operation
        if (Config::get('umi.table_relation_operation') == false)
            return $next($request);

        Umi::setCurrentTableName($request->table);

        $umiTR = new UmiTableRelation();

        #操作数据之前的行为
        #the action before the data table operation
        if (!$umiTR->executeBeforeAction(1)) {
            $request['TRO_Available'] = false;
            $request['TRO_WrongMessage'] = $umiTR->message;var_dump($request['TRO_WrongMessage']);
        }
        //Event::fire(new TableRelationOperationEvent($tableId, 'before'));

        $response = $next($request);

        #操作数据之后的行为
        #the action after the data table operation
        if (!$umiTR->executeAfterAction()) {

        }
        //Event::fire(new TableRelationOperationEvent($tableId, 'after'));

        return $response;
    }
}