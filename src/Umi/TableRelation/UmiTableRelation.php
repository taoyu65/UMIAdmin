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
            $RO = $factory->getInstanceOfRelationOperation(
                $rule->rule_name,
                $rule->operation_type
                );
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
            $RO = $factory->getInstanceOfRelationOperation(
                $rule->rule_name,
                $rule->operation_type,
                $rule->customer_rule_name
            );

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
                $action = $rule->operation_type;
                if ($re) {//todo - 这个优先, 由于用了session 并且是flash 当出现2个 message的时候 只能显示一个. 搞定这个
                   YM::showMessage(
                       "$action success! - positive $action",
                       "There are <strong style=\'color: orange\'>$re</strong> records have been <strong style=\'color: orange\'>DELETE</strong> from table: <strong style=\'color: orange\'>$responseTableName</strong> due to the relation operation rules",
                       [
                           'class_name' => 'gritter-info',
                           'time'       => 10000
                       ]
                       );
                } else {
                    YM::showMessage(
                        "$action failed",
                        "No records got deleted either something wrong or no related records have been found, just in case the redundancy please manage the data manually ",
                        [
                            'class_name' => 'gritter-error',
                            'sticky'     => true
                        ]
                    );
                }
            }
        }
    }
}