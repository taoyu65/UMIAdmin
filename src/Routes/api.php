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

#获取所有指定数据表的字段列表
#get all specific table's fields list
Route::get('/fields/{table}', function ($table) {
    $re = getFields($table);
    return json_encode($re);
});

#获取所有不存在于规则列表里面的字段 (用于在下拉列表显示不存在的字段)
#get all fields that does not exist in the "browser rule table which is umi_field_display_bread"
Route::get('/fields/noExist/{fieldTable}/{table}/{tableId}', function ($fieldTable, $table, $tableId) {
    $allFields = getFields($table);

    $existFields = DB::table($fieldTable)->where('table_id', $tableId)->pluck('field')->toArray();
    $re = [];
    $allFields->map(function ($key) use ($existFields, &$re) {
        if (!in_array($key, $existFields)) {
            array_push($re, $key);
        }
    });
    return $re;
});

function getFields($table)
{
    return DB::table('information_schema.COLUMNS')
        ->select('COLUMN_NAME')
        ->where('TABLE_NAME', $table)
        ->pluck('COLUMN_NAME');
}
