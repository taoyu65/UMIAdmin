<?php

namespace YM\Http\Middleware;

use Closure;
use YM\Facades\Umi;
use YM\Umi\TableRelation\UmiTableRelation;


class BreadSubmitMiddleWare
{
    public function handle($request, Closure $next)
    {

        Umi::setCurrentTableName($request->table);

        $umiTR = new UmiTableRelation();

        #操作数据之前的行为
        #the action before the data table operation
        if (!$umiTR->executeBeforeAction()) {

            $request['message'] = $umiTR->message;var_dump($request['message']);
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