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

    Route::get('refresh', [
        'uses'      => 'dashboardController@getRefresh',
        'as'        => 'refresh'
    ]);

    Route::get('dashboard', [
        'as'        => 'dashboard', function () {
        return view('umi::dashboard');
    }]);

    Route::match(['post','get'], 'umiTable/{table?}', [
        'uses'      => 'umiTableController@index',
        'as'        => 'umiTable'
    ]);

    Route::get('deleting/{table}/{id}/{fields?}', [
        'middleware'=> ['umi.bread.access:delete', 'umi.TRelation.confirmation'],
        'uses'      => 'umiTableDeleteController@deleting'
    ]);

    Route::post('delete/{table}', [
        'middleware'=> ['umi.bread.access:delete', 'umi.TRelation.execute'],
        'uses'      => 'umiTableDeleteController@delete'
    ]);
});
#------------------------------------------------------------------