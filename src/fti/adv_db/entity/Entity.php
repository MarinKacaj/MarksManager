<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 6:32 PM
 */

namespace fti\adv_db\entity;


/**
 * Interface Entity
 * @package fti\adv_db\entity
 */
interface Entity
{

    const UNSAVED_INSTANCE_ID = 0;
    const ALL_PROPERTIES = 1;
    const PROPERTY_PREFIX = 'PROP_';


    /**
     * @return Entity
     */
    public static function createEmpty();

    /**
     * @param $id
     * @return Entity
     */
    public static function retrieve($id);

    /**
     * @return string
     */
    public static function getEntityClassName();

    /**
     * @return Entity[]
     */
    public static function getList();
}