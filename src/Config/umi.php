<?php
return [

    /*
    |--------------------------------------------------------------------------
    | 资源路径 Assets Path
    |--------------------------------------------------------------------------
    | 包括js css, images 等, 必须以 / 结尾
    | All the js, css, images files
    | include trailing slash like 'yourFolder/'
    |
    */

    'assets_path' => 'assets/',

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
];