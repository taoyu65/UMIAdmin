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

    #表关系操作
    #table relation operation
    #---------------------------------------------------------------
    Route::get('relationOpe/adding/{type?}', [
       'uses'       => 'relationOperationController@adding',
       'as'         => 'relationAdding'
    ]);
    Route::post('relationOpe/{table}/add', [
        'middleware'=> ['umi.bread.access:add'],
        'uses'      => 'relationOperationController@add',
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

    #删除确认页面 #confirmation before deletion
    Route::get('deleting/{table}/{id}/{fields?}', [
        'middleware'=> ['umi.bread.access:delete', 'umi.TRelation.confirmation'],
        'uses'      => 'umiTableDeleteController@deleting'
    ]);

    #删除动作 #delete action
    Route::post('delete/{table}', [
        'middleware'=> ['umi.bread.access:delete', 'umi.TRelation.execute'],
        'uses'      => 'umiTableDeleteController@delete'
    ]);
});
#------------------------------------------------------------------