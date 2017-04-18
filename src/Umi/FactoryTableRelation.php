<?php

namespace YM\Umi;

use YM\Umi\TableRelation\TRCheckDelete;
use YM\Umi\TableRelation\TRCustomerDelete;
use YM\Umi\TableRelation\TRDeleteExist;
use YM\Umi\TableRelation\TRDeleteInterlock;

class FactoryTableRelation
{
    public function __construct()
    {

    }

    public function getInstanceOfRelationOperation($rule_name, $operation_type)
    {
        switch ($rule_name) {
            case 'interlock':
                if ($operation_type == 'delete')
                    return new TRDeleteInterlock();
                break;
            case 'exist':
                if ($operation_type == 'delete')
                    return new TRDeleteExist();
                break;
            case 'check':
                switch ($operation_type) {
                    case 'add':
                        return null;
                    case 'delete':
                        return new TRCheckDelete();
                    case 'edit':
                        return null;
                    default:
                        return null;
                }
            case 'customer':
                switch ($operation_type) {
                    case 'add':
                        return null;
                    case 'delete':
                        return new TRCustomerDelete();
                    case 'edit':
                        return null;
                    default:
                        return null;
                }
            default:
                return null;
        }


    }
}