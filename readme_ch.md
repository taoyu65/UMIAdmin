#UMI Admin RBAC 后台管理系统 

> ```不同于其他后台管理, UMI Admin 可用于快速搭建后台 对于中小型后台甚至不用写任何代码``` 

English (https://github.com/taoyu65/UMIAdmin/blob/master/readme.md)

> QQ: 369881380 如果有任何问题可以过来讨论, 欢迎提出宝贵意见和进行项目测试. 
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Umi 是由laravel 5.3开发的全面的后台管理系统, 包括以下特性

- BREAD 系统 (编辑, 读取, 添加, 删除, 查看) 要求laravel 5.3
- RBAC 权限系统 (基于角色权限开发) 包含2部分, 一部分是 数据库中的数据表的操作权限, 增删改等, 另一部分是管理界面权限操作, 整个权限系统基于数据层面和URL界面的操作与分配
- 数据表的全面操作 增删改, 搜索, 以及自定义这些操作
- 表之间关系的设定与操作, 比如可以自定义关联删除,关联更新, 或定义删除某表之前检查是否在其他表存在外键因而不能删除表等, 例如删除一个购物车,里面的物品所在的物品表的数据将一并删除等
- 自定义显示数据格式, 可以设定任何字段用以什么方式现在在界面.例如一个外键可以显示其ID 或者 显示所对应表字段的名称.

## 功能简介 (详细攻略正在制作...)

- 权限系统: 分为2个层次, 硬编码层次 和 比较流行的RBAC系统
    - 硬编码权限: 权限不依赖数据库中的数据, 由代码来编写权限, 系统有相应的接口来实现权限, 硬编码权限拥有比RBAC更高的优先级, 也就是说如果用户被指定
    为硬编码权限将忽略所有RBAC权限. 已经实现的权限有: 超级管理员(拥有所有权限, 除了修改代码不能通过数据库改变他的权限)
        - 目的: 可以为不同的用户定制不依赖数据库的永久的权限, 可以定制不同风格的界面以及额外的功能
        - 实现: 在配置文件指定一个用户的硬编码权限名称 > 实现硬编码权限的接口 (指定特有的权限功能) > 在工厂类添加对应的代码用于生成权限对象
        - 风格: 在实现硬编码权限接口中, 可以指定不同的masterpage的模板, 搜索栏目, 页眉, 页尾, 左边栏, 提示栏目, 各个模块均可以实现接口自定义不同风格, 
        然后通过不同的用户调用不同的界面
    - RBAC系统: 比较流行的权限解决方案, 本案例的权限细度定制在数据表的增删改查 俗称BREAD, (不支持字段级别的增删改查, 因为本人觉得根本没用 还增加复杂程度)
    由于和硬编码权限共存, 所以只有用户没有被指定为特殊的硬编码权限时候才发挥作用. 此权限系统由umiAuth包实现, 调用方式借鉴了entrust, ("动作名称-表名称" 比如 
    delete-user) 
        - 实现1: 如果一个路由只查看一种权限可以使用中间件BreadAccessMiddleware配合路由来实现(逻辑代码完全不用关心权限问题), 路由必须包含table的参数即"{table}"
        路由调用中间件要指定要判断的权限动作(比如 'middleware'=> 'umi.bread.access:edit')
        - 实现2: 如果一个页面包含多种不同权限判断, 可以实例化umiAuth然后 调用里面的各种方法来判断权限
- 自定义数据显示: 用于在浏览, 编辑, 添加数据表记录的时候 自定义数据格式的显示.
    - 例如: 当添加文章信息时候, 文章类别(通常为外键) 需要显示对应数据表的真实类别名称, 而不是主表的数字. 在例如 输入性别的时候可以用下拉框或者单选按钮来替代文本框
    - 实现: 实现对应的接口, 完成接口中的方法
    - 潜力: 只要能想到的数据类型都可以实现, 时间, 文本, 连接, 图片, 星级, 标签(可以带样式, 不同类别不同样式), 外键显示, 等等...
- 表关系操作: 当删除, 编辑, 一条记录的时候可以自定义触发表关系操作 
    - 例如: 删除一个用户触发删除所有用户其他信息的操作, 或增加一个用户以后, 修改某个字段为其加一等等
    - 实现: 通过程序中的向导自定义, 分为4个类别, 内联删除, 外表检查, 自身检查, 自定义
        - 内联删除: 当删除一条记录则同时删除指定的数据, 可以为不同数据表, 删除条件可以自定义
        - 外表检查: 在执行一个动作之前(比如删除, 编辑) 检查指定的一个数据表中的记录是否符合指定的规则. 比如, 为了保持数据完整性,删除或者编辑之前查看是否其他表存在这条数据的外键
        - 自身检查: 在执行一个动作之前(比如删除, 编辑) 检查自身的数据记录是否符合指定的规则, 同外表检查, 只不过检查自身数据记录
        - 自定义: 就是完全自定义
- 自定义搜索: 对数据表进行搜索条件的配置
    - 例如: 功能定制为Tab页, 可以有多个不同的tab页, 每个tab页里面可以定制不同的搜索选项, 可以定制不同的数据类型. 可以组合搜索选项
- 菜单定制: 左边栏菜单可以根据不同的用户显示不同的菜单, 属于权限的一部分, 但是仅仅是url链接级别的显示和隐藏. 配合RBAC发挥最大作用.菜单功能在数据库层面上分为, 菜单树 和 json菜单
    - 菜单树: 以树状形态显示所有的菜单, 只有超级管理用会从这个菜单树加载菜单(因为超级管理员拥有全部权限,不受RBAC控制, 需要看到所有菜单)
    - json菜单: 每一个用户分配一个json菜单, 以json形式存储, json数据是根据彩单树的数据整合而成.(不要和RBAC的用户角色权限混淆)
    
## 安装
1. 安装composer 和 laravel 5.3 框架. 请自行安装,可以通过不同方式安装. 推荐composer方式 
> 执行命令 composer create-project --prefer-dist laravel/laravel blog 5.3.*
2. 安装UMI Admin. 
>执行命令  composer require ym/umi "v0.1.2.*" <br>
>如果可以正常使用composer 执行上面命令的可以忽略这个段落， 如果不能正常使用composer的小伙伴可以查看 https://github.com/taoyu65/UMIAdmin/wiki/install
3. 配置数据库连接文件(.env)
>DB_HOST=localhost<br>
>DB_DATABASE=新建一个空的数据库<br>
>DB_USERNAME=用户名<br>
>DB_PASSWORD=密码<br>
4. 添加服务提供者.添加下面2行代码到 根目录/config/app.php 里面providers数组里面
>YM\UmiServiceProvider::class,<br>
>YM\umiAuth\umiAuthServiceProvider::class,
5. 执行下面的命令, 用于安装应用程序
>php artisan umi:install (会提示选择安装数据库中数据的语言 1=汉语 2=英语) 输入1然后回车.
>附:如果数据库已经安装完毕, 在想更改语言英语或汉语 仅需执行 php artisan umi:install --lang-zh-only(或 --lang-en-only) 
6. 设置系统为中文:
>在根目录下config/app.php中 设置 'locale' => 'zh_cn', 即可
7. 设置app_key 执行命令 $ php artisan key:generate
8. 好了. 可以开始了.<br>
注意：为了保证数据库迁移，数据库结构和一些必要的数据。 请在执行php artisan umi：install之前 保持数据库为空。如果要重新安装请手动清空数据库包括结构。

    
## 图片 
![](http://umi.laravelumi.com/public/img/img2/a.jpg)
![](http://umi.laravelumi.com/public/img/img2/b.jpg)
![](http://umi.laravelumi.com/public/img/img2/c.jpg)
![](http://umi.laravelumi.com/public/img/img2/d.jpg)
![](http://umi.laravelumi.com/public/img/img2/e.jpg)
![](http://umi.laravelumi.com/public/img/img2/f.jpg)
![](http://umi.laravelumi.com/public/img/img2/g.jpg)
![](http://umi.laravelumi.com/public/img/img2/h.jpg)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
