<?php

use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/fields/{table}', function ($table) {
    $re = DB::table('information_schema.COLUMNS')
        ->select('COLUMN_NAME')
        ->where('TABLE_NAME', $table)
        ->pluck('COLUMN_NAME');
    return json_encode($re);
});

