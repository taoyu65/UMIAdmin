<?php

return[

#可以被自定义编辑的列表, 用于客户端下拉选择
#editable list that use for client side of drop down list

    #系统表名字 (如果在数据库中更改以下表名, 则必须同时修改以下表名 原始表名=>修改表名)
    #system table name (if modify following table name in the database, then following table name has to be changed same time)
    #originalTableName => changeableTableName
    'system_table_name'     => [
        'umi_table_relation_operation'  => 'umi_table_relation_operation',
        'umi_users'                     => 'umi_users'
    ],

    #数据类型
    #data type
    'data_type'             => [
        'text',
        'dollar',
        'link',
        'date',
        'picture',
        'select',
        'bool'
    ],

    #值比较操作符
    #operational character
    'operational_character' => [
        '=',
        '>',
        '<',
        '!=',
        'like'
    ],

    #数据关联操作类型
    #data table relation operation types
    'DT_relation_operation' => [

        #与给定的数值进行自身的检查
        #check itself with the given value
        'selfCheck',

        #检查其他数据表是否存在当前选定的数据值
        #check other data table if current value from selected exist
        'exist',

        #数据表的联动删除, 当当前数据记录被删除时 一并删除其他对应的数据表的记录
        #when delete current record, all the record from other table that has relation will be deleted at the same time
        'interlock',

        #自定义规则, 需要动态的修改工厂类的, 实现相应的接口.
        #custom rule, need add method to the factory class and implement the interface
        'custom'
    ],

    #数据表关系系统中, 可以触发操作的数据表操作类型
    #the action can be triggered by operation of data table
    'operation_type'      => [
        'delete',
        'edit',
        'add',
        'read'
    ],
];
