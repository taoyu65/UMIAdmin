<?php

#log in and out----------------------------------------------------
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

    Route::get('umiTable/{table?}', [
        'middleware'=> 'umi.bread.access',
        'uses'      => 'umiTableController@index',
        'as'        => 'umiTable'
    ]);
});
#------------------------------------------------------------------