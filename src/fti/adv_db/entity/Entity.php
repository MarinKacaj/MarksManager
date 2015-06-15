<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 6:32 PM
 */

namespace fti\adv_db\entity;
use fti\adv_db\entity\util\EntityBuilderHelper;


/**
 * Interface Entity
 * @package fti\adv_db\entity
 */
interface Entity
{

    const UNSAVED_INSTANCE_ID = 0;
    const ALL_PROPERTIES = 1;
    const PROPERTY_PREFIX = 'PROP_';
    const PROP_ID = 'ID';


    public function getEntityName();
    /**
     * @return Entity
     */
    public function save();

    /**
     * @return Entity
     */
    public function update();

    /**
     * @return bool
     */
    public function delete();

    /**
     * @return EntityBuilderHelper
     */
    public static function getBuilder();
}