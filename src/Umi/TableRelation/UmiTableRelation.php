<?php

namespace YM\Umi\TableRelation;

use YM\Facades\Umi as YM;
use YM\Models\TableRelationOperation;
use YM\Umi\FactoryTableRelation;

class UmiTableRelation
{
    public $message;

    public function executeBeforeAction($activeFieldValues)
    {
        $checked = true;
        $tableId = YM::currentTableId();
        $TRO = new TableRelationOperation();
        $rules = $TRO->getRulesByNames($tableId, false);
        $checkBool = true;

        $activeFieldValues = json_decode($activeFieldValues, true);
        $factory = new FactoryTableRelation();
        foreach ($rules as $rule) {
            $RO = $factory->getInstanceOfRelationOperation($rule->rule_name, $rule->operation_type);
            $bool = false;
            $re = '';
            $activeTableName = YM::getTableNameById($rule->active_table_id);
            $responseTableName = YM::getTableNameById($rule->response_table_id);

            $checkOperation = $rule->check_operation === '' ? '=' : $rule->check_operation;
            $currentFieldValue = $activeFieldValues[$rule->active_table_field];
            if ($RO != null) {
                    $re = $RO->showConfirmation(
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

    public function executeAfterAction($activeFieldValues)
    {
        $TRO = new TableRelationOperation();
        $tableId = YM::currentTableId();
        $rules = $TRO->getRulesByNames($tableId, true);

        $factory = new FactoryTableRelation();
        foreach ($rules as $rule) {
            $RO = $factory->getInstanceOfRelationOperation($rule->rule_name, $rule->operation_type);

            $activeTableName = YM::getTableNameById($rule->active_table_id);
            $responseTableName = YM::getTableNameById($rule->response_table_id);

            $checkOperation = $rule->check_operation === '' ? '=' : $rule->check_operation;
            $activeFieldValues = json_decode($activeFieldValues, true);
            $currentFieldValue = $activeFieldValues[$rule->active_table_field];

            if ($RO != null) {
                $re = $RO->executeExtraOperation(
                    $activeTableName,
                    $rule->active_table_field,
                    $currentFieldValue,
                    $rule->check_value,
                    $responseTableName,
                    $rule->response_table_field,
                    $checkOperation
                );
                //todo - show message
            }
        }
    }
}