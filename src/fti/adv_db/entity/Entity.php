<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 6:32 PM
 */

namespace fti\adv_db\entity;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\BasicProperty;


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


    /**
     * @return string
     */
    public function getEntityName();

    /**
     * @param string $propertyName
     * @return BasicProperty
     */
    public function getProperty($propertyName);

    /**
     * @return BasicProperty[]
     */
    public function getProperties();

    /**
     * @return array
     */
    public function getIdentifier();

    /**
     * @return EntityBuilderHelper
     */
    public static function getBuilder();
}