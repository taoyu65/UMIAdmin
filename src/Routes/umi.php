<?php

Route::get('admin', function () {
   return view('umi::login');
});

Route::post('dashboard', [
    'uses'  => 'dashboardController@dashboard',
    'as'    => 'dashboard'
]);