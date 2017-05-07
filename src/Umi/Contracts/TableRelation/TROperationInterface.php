<?php

namespace YM\Umi\Contracts\TableRelation;

interface TROperationInterface
{
    /**
     * 数据表关系操作之前的检查工作 以及返回不符合条件信息
     * confirming check before the action and return the message that do not match the rule
     * @param $activeTableName
     *          - 正在被操作数据表名
     *          - table name of being operated
     * @param $activeField
     *          - 正在被操作数据表中的字段, 可以关联到被关联数据表中的字段
     *          - field' name of table's name of being operated, may has relation of the field in response table
     * @param $currentFieldValue
     *          - 用于判断是否符合规则的值
     *          - value of using verify if match the rule
     * @param $targetValue
     *          - 目标数据 用于在执行操作之前判断是否符合该数据
     *          - target data use for checking the rule and match this value before operation
     * @param $responseTableName
     *          - 被关联数据表的表名
     *          - table name of response table
     * @param $responseField
     *          - 被关联数据表中的字段名称 和 被操作数据表中字段想对应
     *          - the field's name of response table and related the field of active table
     * @param string $checkOperation
     *          - 操作关系 可以为 =,<,>,<>,like 等等
     *          - relation of operation like =,<,>,<>,like etc
     * @return mixed
     *          - 返回布尔值true则通过验证可以执行此操作, 返回字符串则为错误信息, 并显示在客户端
     *          - when return true is passed and can be operated, if return a string than will be a wrong message and showing on the client side
     */
    public function showConfirmation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=');

    #具体的执行操作 参数和showConfirmation相同
    #specific action all the parameter are same as showConfirmation
    public function executeExtraOperation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=');
}