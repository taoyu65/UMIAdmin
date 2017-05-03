<?php

namespace YM\Umi;

use YM\Umi\TableRelation\TRDeleteSelfCheck;
use YM\Umi\TableRelation\TREditExist;
use YM\Umi\TableRelation\TREditSelfCheck;
use YM\Umi\TableRelation\TRReadExist;
use YM\Umi\TableRelation\TRReadSelfCheck;
use YM\Umi\TableRelation\TRDeleteExist;
use YM\Umi\TableRelation\TRDeleteInterlock;
use ReflectionClass;

class FactoryTableRelation
{
    public function __construct()
    {

    }

    public function getInstanceOfRelationOperation($rule_name, $operation_type, $customerRuleName = '')
    {
        switch ($rule_name) {
            #数据表的联动删除, 当当前数据记录被删除时 一并删除其他对应的数据表的记录
            #when delete current record, all the record from other table that has relation will be deleted at the same time
            case 'interlock':
                if ($operation_type == 'delete')
                    return new TRDeleteInterlock();
                break;
            case 'custom':
                try {
                    $customer = new ReflectionClass("YM\\Umi\\TableRelation\\$customerRuleName");
                    return $customer->newInstance();
                } catch (\Exception $exception) {
                    echo $exception->getMessage();
                }
                break;
            #检查其他数据表是否存在当前选定的数据值
            #check other data table if current value from selected exist
            case 'exist':
                switch ($operation_type) {
                    case 'read':
                        return new TRReadExist();
                    case 'delete':
                        return new TRDeleteExist();
                    case 'edit':
                        return new TREditExist();
                    default:
                        return null;
                }
            #与给定的数值进行自身的检查
            #check itself with the given value
            case 'selfCheck':
                switch ($operation_type) {
                    case 'read':
                        return new TRReadSelfCheck();
                    case 'delete':
                        return new TRDeleteSelfCheck();
                    case 'edit':
                        return new TREditSelfCheck();
                    default:
                        return null;
                }
            default:
                return null;
        }
    }
}