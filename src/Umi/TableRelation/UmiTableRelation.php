<?php

namespace YM\Umi\TableRelation;

use YM\Facades\Umi as YM;
use YM\Models\TableRelationOperation;
use YM\Umi\FactoryTableRelation;

class UmiTableRelation
{
    public $message;

    public function showConfirmation($activeFieldValues)
    {//todo - need to see authority for all the relation operation.
        $tableId = YM::currentTableId();
        $TRO = new TableRelationOperation();
        $rules = $TRO->getRulesForConfirmation($tableId);

        $activeFieldValues = json_decode($activeFieldValues, true);
        $factory = new FactoryTableRelation();
        foreach ($rules as $rule) {
            $RO = $factory->getInstanceOfRelationOperation(
                $rule->rule_name,
                $rule->operation_type,
                $rule->customer_rule_name
                );

            $re = '';
            $activeTableName = YM::getTableNameById($rule->active_table_id);
            $responseTableName = YM::getTableNameById($rule->response_table_id);

            $checkOperation = $rule->check_operation === '' ? '=' : $rule->check_operation;
            //$currentFieldValue = $activeFieldValues[$rule->active_table_field];
            $currentFieldValue = $rule->check_value ? $rule->check_value : $activeFieldValues[$rule->active_table_field];

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
            }

            if ($rule->is_extra_operation) {
                $this->message .= $re;
                //return true;
            } else {
                $this->message = $re;
                if ($re !== true) return false;
            }
        }
        return true;
    }

    public function executeExtraOperation($activeFieldValues)
    {
        $TRO = new TableRelationOperation();
        $tableId = YM::currentTableId();
        $rules = $TRO->getRulesByNames($tableId, true);

        $factory = new FactoryTableRelation();
        $activeFieldValues = json_decode($activeFieldValues, true);
        foreach ($rules as $rule) {
            $RO = $factory->getInstanceOfRelationOperation(
                $rule->rule_name,
                $rule->operation_type,
                $rule->customer_rule_name
            );

            $activeTableName = YM::getTableNameById($rule->active_table_id);
            $responseTableName = YM::getTableNameById($rule->response_table_id);

            $checkOperation = $rule->check_operation === '' ? '=' : $rule->check_operation;
            //$currentFieldValue = $activeFieldValues[$rule->active_table_field];
            $currentFieldValue = $rule->check_value ? $rule->check_value : $activeFieldValues[$rule->active_table_field];

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
                if ($re) {
                   YM::showMessage(
                       "Relation $action success! - <strong style=\'color: orange\'>positive $action</strong>",
                       "There are <strong style=\'color: orange\'>$re</strong> records have been <strong style=\'color: orange\'>DELETE</strong> from table: <strong style=\'color: orange\'>$responseTableName</strong> due to the relation operation rules",
                       [
                           'class_name' => 'gritter-info',
                           'time'       => 10000
                       ]
                       );
                } else {
                    YM::showMessage(
                        "Relation $action failed! - <strong style=\'color: orange\'>positive $action</strong>",
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