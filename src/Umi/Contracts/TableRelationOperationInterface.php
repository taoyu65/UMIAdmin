<?php

namespace YM\Umi\Contracts;

/**
 * Interface for any operation on data table when related operation between tables need
 */
interface TableRelationOperationInterface
{
    /**
     * can be implemented by operation of add, edit or delete
     * @param $tableRelationOperation - object of table table_relation_operation
     * @return mixed
     */
    public function operation($tableRelationOperation);
}
