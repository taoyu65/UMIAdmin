<?php
return [

    /*
    |--------------------------------------------------------------------------
    | 资源路径 Assets Path
    |--------------------------------------------------------------------------
    | 包括js css, images 等
    | All the js, css, images files
    |
    */

    'assets_path' => '/umi/UMIAdmin/src/resources/assets',

    /*
    |--------------------------------------------------------------------------
    | 包路径 umi Path
    |--------------------------------------------------------------------------
    | 可以自定义. 必须要修改composer.json中的 autoload psr-4 变量到对应的路径
    | 之后还需要在运行命令 # composer dump-autoload. 路径必须以 / 结尾
    | package path
    | include trailing slash like 'yourFolder/'
    | once you change this path you have to config autoload psr-4 in composer.json
    | and run command # composer dump-autoload
    |
    */

    'umi_path' => 'src/',

    /*
    |--------------------------------------------------------------------------
    | 是否启用路径权限
    | if available for url authority
    |--------------------------------------------------------------------------
    | 后台界面的url权限 如果关闭将加载所有功能菜单列表, 否则只加载已经被授权的菜单
    | if set false, all the menus will be loaded instead of loading menus which
    | are authorized
    | (warning: the value must be boolean true or false)
    */

    'url_auth' => true,

    /*
    |--------------------------------------------------------------------------
    | 超级管理员名称
    | super admin's name
    |--------------------------------------------------------------------------
    | 应用程序只允许一个超级管理员(可以重写接口实现多个超级管理员以及应用逻辑)
    | 超级管理员拥有全部的操作权限包括Url(界面入口) 以及 BREAD (数据表的增删改)
    | 超级管理员不依赖数据库记录, 为了防止操作失误删除管理员或者其权限, 使权限管理逻辑更加清晰
    |
    | application allows only one super admin exist(can be implemented multiple
    | different super admins by overriding interface, that admin can be customized)
    | super admin has all authority including Url(entrance of web page) and BREAD
    | super admin doesn't depend on record of database, prevent mistake of operation
    | of deleting the record, to make the business logical of authority is clear
    */

    'super_admin' => 'admin_tem',

    /*
    |--------------------------------------------------------------------------
    | 数据缓存时间,单位为分钟
    | how many minutes for data cache
    |--------------------------------------------------------------------------
    */

    'cache_minutes' => 10,

    /*
    |--------------------------------------------------------------------------
    | 数据表的搜索功能是否开启
    | function of searching for data table
    |--------------------------------------------------------------------------
    */

    'dataTableSearch' => true,

    /*
    |--------------------------------------------------------------------------
    | 未被授权的功能按钮所呈现的样式, 支持'invisible', 'disable' (不可见 或者 不可用)
    | unauthorized access's style of button
    | available setting is 'invisible', 'disable'
    |--------------------------------------------------------------------------
    */

    'unAuthorizedAccessStyle' => 'disable',

    /*
    |--------------------------------------------------------------------------
    | 数据表browser的时候 是否显示用户自定义的数据类型 (如果开启可设置外键为对应数据表的内容)
    | when the data table is showing on browser see if shows the new format
    | that custom made (if open than can set a foreign key to specific name from
    | the table related to)
    |--------------------------------------------------------------------------
    */

    'data_field_reformat' => true,

    /*
    |--------------------------------------------------------------------------
    | 设置数据表名字的列表 为不可编辑 不具备BREAD功能
    | a list that does not have BREAD function
    |--------------------------------------------------------------------------
    */

    'bread_except' => [],

    /*
    |--------------------------------------------------------------------------
    | 数据表(umi table)的每页显示数据数
    | how many pages will be showing on umi table
    |--------------------------------------------------------------------------
    */

    'umi_table_perPage' => 10,

    //数据类型
    'data_type' => [
        'text',
        'dollar',
        'link',
        'date',
        'picture',
        'select',
        'bool'
    ],
];