<?php

Route::get('admin', function () {
   return view('umi::login');
});

Route::group(['middleware' => 'umi.url.auth'], function () {

   Route::post('dashboard', [
       'uses'  => 'dashboardController@dashboard',
       'as'    => 'dashboard'
   ]);

});
