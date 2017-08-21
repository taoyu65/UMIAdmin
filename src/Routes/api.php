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

if (!function_exists('getFields')) {
    function getFields($table)
    {
        return \Illuminate\Support\Facades\Schema::getColumnListing('users');
        /*return DB::table('information_schema.COLUMNS')
            ->select('COLUMN_NAME')
            ->where('TABLE_NAME', $table)
            ->pluck('COLUMN_NAME');*/
    }
}

#查看是否存在指定角色, 并且返回权限列表以固定格式 例如 (browser1 = 表id为1的Browser权限)
#check if specific role exist, and return permission string (such as, browser1 equal the permission of browser from table of id is 1)
Route::get('/checkRole/{roleIdOrName}', function ($roleIdOrName) {
    //用视图解决
    //use view to solve this
    if (is_numeric($roleIdOrName))
        return DB::table('view_role_permission')
            ->where('role_id', $roleIdOrName)
            ->get()
            ->pluck('permission');

    return DB::table('view_role_permission')
        ->where('role_name', $roleIdOrName)
        ->get()
        ->pluck('permission');
});
/*Route::get('/checkRole/{roleName}', function ($roleName) {
    $tableRole = \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_roles');
    $tablePermissionRole = \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_permission_role');
    $tablePermission = \Illuminate\Support\Facades\Config::get('umiEnum.system_table_name.umi_permissions');

    //是否存在角色
    //if role exist
    $role = DB::table($tableRole)
        ->select('id')
        ->where('role_name', $roleName)
        ->first();
    if ($role) {
        //获取对应的权限字符串
        //get the permission string
        $permissionArr = DB::table($tablePermissionRole)
            ->join($tablePermission, "$tablePermissionRole.permission_id", '=', "$tablePermission.id")
            ->select("$tablePermission.table_id", "$tablePermission.key")
            ->where("$tablePermissionRole.role_id", $role->id)
            ->get()
            ->map(function ($item) {
                return $item->key.$item->table_id;
            });
        return $permissionArr;
    } else {
        return '';
    }
});*/

Route::get('/generatePassword/{password}', function ($password) {
    return bcrypt($password);
});