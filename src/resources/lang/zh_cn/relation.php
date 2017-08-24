<?php

return [
    'relationOperation'     => '数据关联操作',
    'selectAdd'             => '编辑 & 删除',
    'custom'                => '自定义',
    'handsUp'               => '提示!',
    'turnOff'               => '你可以在配置文件关闭此项功能.',
    'functionDescription'   => '功能描述: 当规则匹对成功, 删除操作会被执行',
    'tooltip'               => '帮助',
    'exampleCustom'         => '自定义关系使用说明',
    'customExplain'         => '<span class="fa-red">
                            警告: 完全自定义规则, 根据需要进行配置, 但是要给规则命名
                        </span><br>
                        <span class="fa-primary">
                            高级操作(advantage): 额外的删除操作将根据你设定的条件执行(默认是active field = response field). 规则: response filed 匹配自定义的值
                        </span>',
    'ruleName'              => 'Rule Name',
    'functionName'          => 'Will be method name you are going to program, has to be valid function name',
    'action'                => 'Action',
    'operationType'         => '请选择一个操作类型',
    'edit'                  => 'Edit',
    'delete'                => 'Delete',
    'actionInfo'            => '哪个动作会触发关联操作',
    'activeTable'           => 'Active Table',
    'activeTableInfo'       => '你要操作的记录来自哪个数据表',
    'activeFieldInfo'       => '来自主动表的字段',
    'responseTableInfo'     => '哪个数据表是和你要操作的主动表的记录发生关联',
    'responseFieldInfo'     => '这个字段将要匹配主动表字段, 用于执行关联操作',
    'advantageInfo'         => '设定一个规则匹配主动表字段',
    'targetValuePh'         => '这个值将匹配被动表字段',
    'targetValueInfo'       => '请设置一个正确的值去匹配被动表字段 TRUE:1 FALSE:0',
    'choose'                => '点击选择...',
    'activeField'           => 'Active Field',
    'selectActiveTable'     => '选择主动表',
    'responseTable'         => 'Response Table',
    'responseField'         => 'Response Field',
    'selectResponseTable'   => '选择被动表',
    'matchActiveField'      => '这个字段将会匹配主动字段',
    'advantage'             => 'Advantage',
    'operation'             => 'Operation',
    'targetValue'           => 'Target Value',
    'detail'                => 'Detail',
    'add'                   => '添加',
    'back'                  => '返回',
    'functionDescription2'  => '功能描述: 当规则匹对成功, 主操作将被禁止',
    'exitOperation'         => '使用说明 举例说明存在操作用法',
    'existExplain'          => '<span class="fa-red">
                            警告: 这个功能不会操作其他数据表, 仅仅和其他数据表进行查询匹配来限制主操作的进行 <br>
                            警告: 规则为 active field 和 response field对比, 或者 response field 和 custom value 对比 
                        </span><br>
                        例如: 有一个user表 和 user\'s article表. 在你执行删除user表记录之前, 检查是否此用户存在任何文章, 如果存在则不能执行删除操作
                        你可以设置如下: active table - user, active field - id, response table - article, response field - user_id.<br>
                        <span class="fa-primary">
                            高级操作(advantage): 额外的匹配操作将根据你设定的条件执行(默认是active field = response field). 规则: response filed 匹配自定义的值 
                        </span>',
    'deleteInterlock'       => '关联删除',
    'actionDelete'          => '执行动作: 删除',
    'extraOperation'        => '额外影响: 影响其他数据表 ',
    'relatedOtherTable'     => '关联并查询其他数据表 ',
    'interlockInfo'         => '根据规则的制定, 当你删除一条记录, 其他数据表的相关记录也会一并删除 ',
    'interlockExample'      => '举例: 文章和评论 - 当一篇文章被删除所有的属于此篇文章的评论将一并删除.',
    'next'                  => '下一步',
    'exist'                 => '存在操作',
    'actionDeleteEdit'      => '执行动作: 删除 或者 更新 ',
    'existInfo'             => '执行编辑或者删除之前, 根据规则检查其他数据表的某个字段是否符合规则, 此检查将导致提交按钮是否可用',
    'existExample'          => '举例: 文章和文章类别 - 如果删除一个文章类别, 系统将会检查此类别是否存在相应的文章, 只有不存在任何文章占用此类别时候,才可以删除类别.',
    'selfCheckInfo'         => '执行操作之前, 根据规则检查当前表的其他字段是否符合规则 ',
    'selfCheckExample'      => '举例: 文章 - 为了保护还没有发布的文章, 可以指定规则, 不能删除没有发布的文章. 或者发布时长短于某个时间段的文章.(当前文章记录,有控制是否发布的字段).',
    'customInfo'            => '需要指定一个规则名称, 并且编辑自己的任何操作逻辑.',
    'customExample'         => '举例: 可以指定一个规则, 操作指定数据表对某个字段进行数据处理, 比如当删除一篇文章, 文章总数减一.',
    'interlock'             => '关联删除',
    'functionDescription3'  => '功能描述: 当规则匹对成功, 删除操作会被执行',
    'interlockDelete'       => '使用说明 举例说明关联删除用法',
    'interlockExplain'      => 'user 表有id, user_name 字段<br>
                        article 表有id,user_id, article_title, content 字段<br>
                        现在当你想删除user表中的记录, 所有词用户的文章也一并删除, 你可以设置如下 active table: user, active field: id, response table: article, response filed: user_id (normally is foreign key)<br>
                        <span class="fa-primary">
                            高级操作(advantage): 额外的删除操作将根据你设定的条件执行(默认是active field = response field). 规则: response filed 匹配自定义的值 
                        </span>',
    'selfCheckOperation'    => '使用说明 举例说明自检操作用法',
    'selfCheckExplain'      => '<span class="fa-red">
                            警告: 这个功能不会操作其他数据表,也不会和其他数据表进行查询匹配, 仅仅和自身进行规则匹配<br>
                            警告: 规则仅仅为 active field 和 custom value 进行对比 
                        </span><br>
                        例如: 商品表, 表中有星级(1-5星)字段, 你不想任何用户对5星商品进行删除或编辑, 你可以设定规则如下 active table - items, active field - stars, operation - "=", target value - "5"',
    'selfCheck' => '自检操作'
];