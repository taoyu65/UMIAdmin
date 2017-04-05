<?php

namespace YM\Models;

use Illuminate\Support\Facades\DB;

class Umi
{
    #此模型不对应任何数据表, 仅做动态数据查询
    #this model does not relate any data table, only for dynamic data operation

    /**
     * @param $table
     *          - 获取参数table数据表中的所有符合ids 的数据
     *          - get all the record according to the table and ids of id's list
     * @param $ids
     * @return mixed
     */
    public function getFieldByIds($table, $ids)
    {
        $idsUnique = array_values(array_unique($ids));

        return DB::table($table)
            ->whereIn('id', $idsUnique)
            ->get();
    }

    public function getSelectedTable($tableName, $fields)
    {
        return DB::table($tableName)
            ->select($fields);
    }
}