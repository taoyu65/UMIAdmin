<?php

#log in and out----------------------------------------------------
    Route::get('/', function () {
        return view('umi::login');
    });
    Route::get('admin', ['as' => 'admin', function () {
        return view('umi::login');
    }]);
    Route::post('submit', 'dashboardController@dashboard');
    Route::get('logout', 'dashboardController@getLogout');
#------------------------------------------------------------------

#common------------------------------------------------------------
    //通用数据选择器 通常在弹出页面选择一条记录的ID
    //common selector, normally select ID of record from modal page
    Route::get('selector/{table}/{property}', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'commonController@selector',
        'as'        => 'selector'
    ]);
#------------------------------------------------------------------

#main--------------------------------------------------------------
Route::group(['middleware' => 'umi.url.auth'], function () {

    //刷新 #refresh
    Route::get('refresh', [
        'uses'      => 'dashboardController@getRefresh',
        'as'        => 'refresh'
    ]);
    //控制面板 #dashboard
    Route::get('dashboard', [
        'uses'      => 'dashboardController@index',
        'as'        => 'dashboard'
    ]);

#菜单管理与操作
#side menu management
#---------------------------------------------------------------
    //显示所有菜单
    //show all the menus
    Route::get('menuManagement/{table}', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'menuController@management',
        'as'        => 'menuManagement'
    ]);
    //更新菜单的顺序
    //update the order of menus
    Route::post('menuManagement/{table}/updateMenuTree', [
        'middleware'=> 'umi.bread.access:edit',
        'uses'      => 'menuController@updateMenuOrder'
    ]);
    //用户菜单的分配界面
    //user's menus distribution interface
    Route::get('menuManagement/{table}/distribution/{user?}', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'menuController@distribution'
    ]);
    //重新加载所有菜单
    //reload all menus
    Route::get('menuManagement/{table}/loadMenuTree', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'menuController@loadMenuTree'
    ]);
    //加载用户菜单, 使用json字符串
    //load user's tree with json value
    Route::get('menuManagement/{table}/loadMenuTreeFromJson/{userId}', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'menuController@loadMenuTreeFromJson'
    ]);
    //更新用户菜单 (用户菜单为json格式)
    //update user's menu (user's menu is json format)
    Route::post('menuManagement/{table}/updateUserTree/{userId}', [
        'middleware'=> 'umi.bread.access:edit',
        'uses'      => 'menuController@updateUserTree'
    ]);
#---------------------------------------------------------------

#表关系操作
#table relation operation
#---------------------------------------------------------------
    //添加表关系的界面
    //the interface of adding a table relation
    Route::get('relationOpe/adding/{type?}', [
       'uses'       => 'relationOperationController@adding',
       'as'         => 'relationAdding'
    ]);
    //添加操作
    //add action
    Route::post('relationOpe/{table}/add', [
        'middleware'=> ['umi.bread.access:add'],
        'uses'      => 'relationOperationController@operationAdd',
    ]);
#---------------------------------------------------------------

#权限管理
#authority management
#---------------------------------------------------------------
    Route::get('authority/{table}/{type}', [
        'uses'      => 'authorityController@bread',
        'as'        => 'authority'
    ]);
#---------------------------------------------------------------

#字段显示管理
#field display management
#---------------------------------------------------------------
    //字段显示界面 默认为browser界面
    //the interface of field display, default is browser interface
    Route::get('fieldDisplay/{table}/type/{type}', [
        'uses'      => 'fieldDisplayController@display',
        'as'        => 'fieldDisplay'
    ]);
    //根据不同的数据表加载所属字段
    //load different fields base on the different table
    Route::get('fieldDisplay/{table}/id/{tableId}', [
        'uses'      => 'fieldDisplayController@loadFields'
    ]);
    //快速添加所有指定数据表的字段
    //quick add all the fields from designated table
    Route::get('fieldDisplay/{table}/quickAdd/{fields}/{selectedTableId}', [
        'middleware'=> ['umi.bread.access:add'],
        'uses'      => 'fieldDisplayController@quickAdd'
    ]);
    //加载规则界面用于显示某些数据类型需要其他数据表协同处理的问题, 例如外键类型: 可以显示外键id对应表的字段的内容
    //load a interface that need generate a rule for special display. such as data type of foreign key: can display the field of value
    //which is related that foreign key.
    Route::get('relationRule/{dom}', [
        'uses'      => 'fieldDisplayController@relationRule',
        'as'        => 'relationRule'
    ]);
    //browser 和read 的添加操作
    //browser and read's add action
    Route::post('fieldDisplay/{table}/addType/{type}', [
        'middleware'=> ['umi.bread.access:add'],
        'uses'      => 'fieldDisplayController@browserAdd'
    ]);
#---------------------------------------------------------------

#数据表
#table
#---------------------------------------------------------------
    Route::match(['post','get'], 'umiTable/{table?}', [
        'uses'      => 'umiTableController@index',
        'as'        => 'umiTable'
    ]);
#---------------------------------------------------------------

#删除确认页面 和 执行删除
#confirmation page before deletion and command of deletion
#---------------------------------------------------------------
    //删除前的确认界面
    //interface page before delete action
    Route::get('deleting/{table}/{id}/{fields?}', [
        'middleware'=> ['umi.bread.access:delete', 'umi.TRelation.confirmation'],
        'uses'      => 'umiTableDeleteController@deleting'
    ]);
    //删除操作
    //delete action
    Route::post('delete/{table}', [
        'middleware'=> ['umi.bread.access:delete', 'umi.TRelation.execute'],
        'uses'      => 'umiTableDeleteController@delete'
    ]);
#---------------------------------------------------------------

#添加确认页面 和 执行添加
#confirmation page before adding and command of adding
#---------------------------------------------------------------
    //添加数据记录的页面
    //  defaultValue: 提供默认字段以及值
    //interface of adding record
    //  defaultValue: supply defaults value and its fields
    Route::get('adding/{table}/{defaultValue?}', [
        'middleware'=> ['umi.bread.access:add'],
        'uses'      => 'umiTableAddController@adding'
    ]);
    //添加操作
    //add action
    Route::post('add/{table}', [
        'middleware'=> ['umi.bread.access:add'],
        'uses'      => 'umiTableAddController@add'
    ]);
#---------------------------------------------------------------
});
