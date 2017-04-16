<?php

namespace YM\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Event;
use YM\Events\TableRelationOperationEvent;
use YM\Facades\Umi;

class BreadSubmitMiddleWare
{
    public function handle($request, Closure $next)
    {
        $tableId = Umi::currentTableId();

        #操作数据之前的行为
        #the action before the data table operation
        Event::fire(new TableRelationOperationEvent($tableId, 'before'));

        $response = $next($request);

        #操作数据之后的行为
        #the action after the data table operation
        Event::fire(new TableRelationOperationEvent($tableId, 'after'));

        return $response;
    }
}