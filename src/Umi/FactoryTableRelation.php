<?php

namespace YM\Umi;

use YM\Umi\TableRelation\TRDeleteInterlock;

class FactoryTableRelation
{
    public function __construct()
    {

    }

    public function executeRelationOperation($responseAction, $specialRelation)
    {
        switch ($responseAction) {
            case 'add':
                break;
            case 'delete':
                switch ($specialRelation) {
                    case 'interlock':
                        return new TRDeleteInterlock();
                    case 'exist':
                        break;
                    default:
                        break;
                }
                break;
            case 'edit':
                break;
            default:
                break;
        }
    }
}