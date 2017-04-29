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
        $activeFieldValues = $request->route()->parameter('fields');
        $activeFieldValues = base64_decode($activeFieldValues);
        if (!$umiTR->executeBeforeAction($activeFieldValues)) {
            $request['TRO_Available'] = false;
            $request['TRO_Message'] = $umiTR->message;
        }
        //Event::fire(new TableRelationOperationEvent($tableId, 'before'));

        $response = $next($request);

        #操作数据之后的行为
        #the action after the data table operation
        if (!$umiTR->executeAfterAction()) {
            //todo - 实际操作 关联数据表的代码 判断
            // todo - 如果为连级删除 显示所有被关联的数据,可在在接口文件在添加一个方法用于删除操作, 原来的改为confirmation,这个中间件为 提示所有操作用处, 另一个为操作数据表, 传递相应是否有extra操作的参数 在另一个页面进行数据操作.
            //todo - 如果编辑
            //todo - 如果阅读 则直接执行规则, 并返回已经操作的数据的信息 显示出来
            //todo - 如果添加
            //todo 因为要自定义操作, 所有字段custom_rule_name将有值, 其他操作需要屏蔽带有值的自定义操作, 也就是修改查询条件过滤这个字段的值
        }
        //Event::fire(new TableRelationOperationEvent($tableId, 'after'));

        return $response;
    }
}