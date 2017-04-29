<?php

namespace YM\Umi\TableRelation;

use YM\Facades\Umi as YM;
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
        $this->tableId = YM::currentTableId();
        $TRO = new TableRelationOperation();
        $this->records = $TRO->getTableRelationOperationByTableId($this->tableId);
        $this->factory = new FactoryTableRelation();
    }

    public function executeBeforeAction($activeFieldValues)
    {
        $checked = true;
        $TRO = new TableRelationOperation();
        $rules = $TRO->getRulesByNames($this->tableId, false);
        $checkBool = true;

        $activeFieldValues = json_decode($activeFieldValues, true);
        foreach ($rules as $rule) {
            $RO = $this->factory->getInstanceOfRelationOperation($rule->rule_name, $rule->operation_type);
            $bool = false;
            $re = '';
            $activeTableName = YM::getTableNameById($rule->active_table_id);
            $responseTableName = YM::getTableNameById($rule->response_table_id);

            $checkOperation = $rule->check_operation === '' ? '=' : $rule->check_operation;
            $currentFieldValue = $activeFieldValues[$rule->active_table_field];
            if ($RO != null) {
                    $re = $RO->operation(
                    $activeTableName,
                    $rule->active_table_field,
                    $currentFieldValue,
                    $rule->check_value,
                    $responseTableName,
                    $rule->response_table_field,
                    $checkOperation
                );

                #如果是检查类型的规则并且为真 则不能执行动作并且返回错误信息
                #if the policy is the type of checking and return true than the action will be defeat and return wrong message.
                if (is_bool($re) && $re === true) $bool = true;
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