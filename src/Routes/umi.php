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
    #通用数据选择器 通常在弹出页面选择一条记录的ID
    #common selector, normally select ID of record from modal page
    Route::get('selector/{table}/{property}', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'commonController@selector',
        'as'        => 'selector'
    ]);
#------------------------------------------------------------------

#main--------------------------------------------------------------
Route::group(['middleware' => 'umi.url.auth'], function () {

    #刷新 #refresh
    Route::get('refresh', [
        'uses'      => 'dashboardController@getRefresh',
        'as'        => 'refresh'
    ]);

    #控制面板 #dashboard
    Route::get('dashboard', [
        'uses'      => 'dashboardController@index',
        'as'        => 'dashboard'
    ]);

    #菜单管理与操作
    #side menu management
    #---------------------------------------------------------------
    Route::get('menuManagement/{table}', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'menuController@management',
        'as'        => 'menuManagement'
    ]);
    Route::post('menuManagement/{table}/updateOrder', [
        'middleware'=> 'umi.bread.access:edit',
        'uses'      => 'menuController@updateMenuOrder'
    ]);
    Route::get('menuManagement/{table}/distribution/{user?}', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'menuController@distribution'
    ]);
    Route::get('menuManagement/{table}/loadMenuTree', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'menuController@loadMenuTree'
    ]);
    Route::get('menuManagement/{table}/loadMenuTreeFromJson/{userId}', [
        'middleware'=> 'umi.bread.access:browser',
        'uses'      => 'menuController@loadMenuTreeFromJson'
    ]);
    #---------------------------------------------------------------

    #表关系操作
    #table relation operation
    #---------------------------------------------------------------
    Route::get('relationOpe/adding/{type?}', [
       'uses'       => 'relationOperationController@adding',
       'as'         => 'relationAdding'
    ]);
    Route::post('relationOpe/{table}/add', [
        'middleware'=> ['umi.bread.access:add'],
        'uses'      => 'relationOperationController@operationAdd',
    ]);
    #---------------------------------------------------------------

    #权限管理
    #authority management
    #---------------------------------------------------------------
    Route::get('authority', [
        'uses'      => 'authorityController@index',
        'as'        => 'authority'
    ]);
    #---------------------------------------------------------------

    #数据表 #table
    Route::match(['post','get'], 'umiTable/{table?}', [
        'uses'      => 'umiTableController@index',
        'as'        => 'umiTable'
    ]);

    #删除确认页面 和 执行删除
    #confirmation page before deletion and command of deletion
    #---------------------------------------------------------------
    Route::get('deleting/{table}/{id}/{fields?}', [
        'middleware'=> ['umi.bread.access:delete', 'umi.TRelation.confirmation'],
        'uses'      => 'umiTableDeleteController@deleting'
    ]);
    Route::post('delete/{table}', [
        'middleware'=> ['umi.bread.access:delete', 'umi.TRelation.execute'],
        'uses'      => 'umiTableDeleteController@delete'
    ]);
    #---------------------------------------------------------------
});
#------------------------------------------------------------------