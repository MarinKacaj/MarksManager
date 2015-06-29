<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/27/2015
 * Time: 11:26 PM
 */

namespace fti\adv_db\entity;

use fti\adv_db\property\BasicProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class CompositeEntity
 * @package fti\adv_db\entity
 */
abstract class CompositeEntity implements Entity
{

    const PROP_ORDINAL_NUMBER = 'ordinalNumber';

    /**
     * @var BasicProperty[]
     */
    protected $properties;

    /**
     * @param string $propertyName
     * @return BasicProperty
     */
    public function getProperty($propertyName)
    {
        return $this->properties[$propertyName];
    }

    /**
     * @return BasicProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @return array
     */
    public function getIdentifier()
    {
        $rowNum = intval($this->getProperty(self::PROP_ORDINAL_NUMBER)->getValue());
        return array(self::PROP_ID => $rowNum);
    }
}