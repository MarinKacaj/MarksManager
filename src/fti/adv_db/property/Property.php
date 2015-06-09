<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/10/2015
 * Time: 12:39 AM
 */

namespace fti\adv_db\property;


interface Property
{

    const INTEGER = 1;
    const FLOAT = 2;
    const STRING = 3;
    const ARRAY_LIST = 4;
    const ENUM = 5;
    const ENTITY = 6;

    /**
     * @return int
     */
    public function getType();
}