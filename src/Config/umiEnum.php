<?php

return[

#可以被自定义编辑的列表, 用于客户端下拉选择
#editable list that use for client side of drop down list

    #系统表名字 (如果在数据库中更改以下表名, 则必须同时修改以下表名 原始表名=>修改表名)
    #system table name (if modify following table name in the database, then following table name has to be changed same time)
    #originalTableName => changeableTableName
    'system_table_name'     => [
        'umi_table_relation_operation'  => 'umi_table_relation_operation',
        'umi_users'                     => 'users',
        'umi_roles'                     => 'umi_roles',
        'umi_permission_role'           => 'umi_permission_role',
        'umi_permissions'               => 'umi_permissions',
        'umi_menus'                     => 'umi_menus',
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
                'showInputInterface'=> false,
            ],
            'label4Read'    => [
                'showInputInterface'=> false,
            ],
            'dollar'        => [
                'showInputInterface'=> false,
            ],
            'star'          => [
                'showInputInterface'=> false,
            ],
            'foreignKey'    => [
                'showInputInterface'=> true,
            ],
            'badge'         => [
                'showInputInterface'=> false,
            ],
            'keyIcon'       => [
                'showInputInterface'=> false,
            ],
        ],
        'editAdd'       => [
            'textBox'       => [
                'showInputInterface'=> false,
            ],
            'checkBox'      => [
                'showInputInterface'=> false,
            ],
            'textArea'      => [
                'showInputInterface'=> false,
            ],
            'tags'          => [
                'showInputInterface'=> false,
            ],
            'date'          => [
                'showInputInterface'=> false,
            ],
            'dropDownBox'   => [
                'showInputInterface'=> true,
            ],
            'popupWindow'   => [
                'showInputInterface'=> true,
            ],
            'bcryptPassword'=> [
                'showInputInterface'=> false,
            ]
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
        'read'
    ],

    #可填充数据字段
    #fields that can be filled
    'fillable'              => [
        'umi_badges'                => [
            'table_id', 'field', 'badge_name', 'class', 'created_at', 'updated_at'
        ],
        'users'                 => [
            'name', 'email', 'password', 'remember_token', 'created_at', 'updated_at'
        ],
        'umi_user_menu'             => [
            'user_id', 'json'
        ],
        'umi_roles'                 => [
            'role_name', 'display_name', 'created_at', 'updated_at'
        ],
        'umi_user_role'             => [
            'user_id', 'role_id'
        ],
        'umi_menus'                 => [
            'menu_id', 'title', 'url', 'target', 'icon_class', 'order', 'extra_icon_html', 'created_at', 'updated_at'
        ],
        'umi_field_display_browser' => [
            'table_id', 'field', 'type', 'relation_display', 'display_name', 'order', 'is_showing', 'created_at', 'updated_at'
        ],
        'umi_field_display_read'    => [
            'table_id', 'field', 'type', 'relation_display', 'display_name', 'order', 'is_showing', 'created_at', 'updated_at'
        ],
        'umi_field_display_edit'    => [
            'table_id', 'field', 'type', 'relation_display', 'custom_value', 'display_name', 'validation', 'details', 'order', 'is_editable', 'created_at', 'updated_at'
        ],
        'umi_field_display_add'     => [
            'table_id', 'field', 'type', 'relation_display', 'custom_value', 'display_name', 'validation', 'details', 'order', 'is_editable', 'created_at', 'updated_at'
        ],
        'umi_permissions'           => [
            'table_id', 'key', 'display_name', 'created_at', 'updated_at'
        ],
        'umi_permission_role'       => [
            'permission_id', 'role_id'
        ],
        'search'                    => [
            'search_tab_id', 'field', 'display_name', 'type', 'is_fuzzy', 'created_at', 'updated_at'
        ],
        'search_tab'                => [
            'table_id', 'tab_title', 'order', 'created_at', 'updated_at'
        ],
        'umi_table_relation_operation'=> [
            'rule_name', 'customer_rule_name', 'operation_type', 'active_table_id', 'active_table_field', 'response_table_id', 'response_table_field', 'check_value', 'check_operation', 'is_extra_operation', 'details', 'created_at', 'updated_at'
        ],
        'umi_tables'                => [
            'table_name', 'type', 'created_at', 'updated_at'
        ]
    ]
];
