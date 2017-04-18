<?php

namespace YM\Umi\TableRelation;

use YM\Facades\Umi;
use YM\Models\TableRelationOperation;
use YM\Umi\FactoryTableRelation;

class UmiTableRelation
{
    private $records;
    private $factory;

    public $message;
    public $tableId;

    public function __construct()
    {
        $this->tableId = Umi::currentTableId();
        $TRO = new TableRelationOperation();
        $this->records = $TRO->getTableRelationOperationByTableId($this->tableId);
        $this->factory = new FactoryTableRelation();

        $this->message = '';
    }

    public function executeBeforeAction()
    {
        $checked = true;
        $TRO = new TableRelationOperation();
        $rules = $TRO->getRulesByNames(['exist', 'check'], $this->tableId);
        $checkBool = true;
        foreach ($rules as $rule) {
            $RO = $this->factory->getInstanceOfRelationOperation($rule->rule_name, $rule->operation_type);
            $bool = false;
            $re = '';
            if ($RO != null) {
                    $re = $RO->operation(
                    $rule->active_table_id,
                    $rule->active_table_field,
                    $rule->response_table_id,
                    $rule->response_table_field
                );

                if (is_bool($re) && $re === true){
                    $bool = true;
                }
            }

            if (!($bool && $checkBool)) {
                $this->message = $re;
                return false;
            }
        }
        return $checked;
    }

    public function executeAfterAction()
    {
        return false;
    }
}