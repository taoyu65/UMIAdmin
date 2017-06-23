<?php

return[

#可以被自定义编辑的列表, 用于客户端下拉选择
#editable list that use for client side of drop down list

    #系统表名字 (如果在数据库中更改以下表名, 则必须同时修改以下表名 原始表名=>修改表名)
    #system table name (if modify following table name in the database, then following table name has to be changed same time)
    #originalTableName => changeableTableName
    'system_table_name'     => [
        'umi_table_relation_operation'  => 'umi_table_relation_operation',
        'umi_users'                     => 'umi_users',
        'umi_field_display_add'         => 'umi_field_display_add',
        'umi_field_display_browser'     => 'umi_field_display_browser',
        'umi_field_display_read'        => 'umi_field_display_read',
        'umi_field_display_edit'        => 'umi_field_display_edit'
    ],

    #数据类型 browser, read 和 edit, add 会加载不同的数据类型.
    #   relation_display: 数据类型是否可用关系规则
    #   custom_value: 数据类型是否具有自定义数据 (比如下拉列表可以自定义数据)
    #data type browser, read and edit, add will load different data type list
    #   relation_display: data type if can use relation rule
    #   custom_value: data type if has custom value (drop down box may has custom data)
    'data_type'             => [
        'browserRead'   => [
            'label'         => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'dollar'        => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'star'          => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'foreignKey'    => [
                'relation_display'  => 'true',
                'custom_value'      => 'false'
            ],
            'badge'         => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'keyIcon'       => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
        ],
        'editAdd'       => [
            'textBox'       => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'checkBox'      => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'textArea'      => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'tags'          => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'date'          => [
                'relation_display'  => 'false',
                'custom_value'      => 'false'
            ],
            'dropDownBox'   => [
                'relation_display'  => 'false',
                'custom_value'      => 'true'
            ],
        ]
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
    'operation_type'        => [
        'delete',
        'edit',
        //'add',
        'read'
    ],

    #可填充数据字段
    #fields that can be filled
    'fillable'              => [
        'umi_menus'                 => [
            'menu_id', 'title', 'url', 'target', 'icon_class', 'order', 'extra_icon_html'
        ],
        'umi_field_display_browser' => [
            'table_id', 'field', 'type', 'relation_display', 'display_name', 'order', 'is_showing'
        ],
        'umi_field_display_read'    => [
            'table_id', 'field', 'type', 'relation_display', 'display_name', 'order', 'is_showing'
        ],
        'umi_field_display_edit'    => [
            'table_id', 'field', 'type', 'relation_display', 'custom_value', 'display_name', 'validation', 'details', 'order', 'is_editable'
        ],
        'umi_field_display_add'     => [
            'table_id', 'field', 'type', 'relation_display', 'custom_value', 'display_name', 'validation', 'details', 'order', 'is_editable'
        ],
    ]
];
