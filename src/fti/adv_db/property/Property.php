<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/8/2015
 * Time: 6:38 PM
 */

namespace fti\adv_db\property;


/**
 * Interface Property
 * @package fti\adv_db\property
 */
interface Property {

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return int
     */
    public function getType();

    /**
     * @return string
     */
    public function getColName();

    /**
     * @param string $label
     * @param string $name
     * @return string
     */
    public function createDOM($label, $name);
}