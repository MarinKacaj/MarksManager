<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 10:02 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\property\BasicProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class BasicEntity
 * @package fti\adv_db\entity
 */
abstract class BasicEntity implements Entity
{

    const TABLE_NAME = 'ial';
    const LABEL = 'IAL';

    /**
     * @var string
     */
    protected $tableName;
    /**
     * @var string
     */
    protected $entityName;
    /**
     * @var array
     */
    protected $id;
    /**
     * @var BasicProperty[]
     */
    protected $properties;
    /**
     * @var string
     */
    protected $label;
    /**
     * @var EntityActionHelper
     */
    protected $actionHelper;
    /**
     * @var bool
     */
    protected $isPartOfList;


    /**
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @return string[]
     */
    public static function getPrimaryKeyColNames()
    {
        return array(self::PROP_ID);
    }

    /**
     * @return array
     */
    public function getIdentifier()
    {
        return $this->id;
    }

    /**
     * @param array $id
     */
    public function setID($id)
    {
        if (is_array($id)) {
            $this->id = $id;
        } else {
            $this->id = array(self::PROP_ID => $id);
        }
    }

    /**
     * @param string $propertyName
     */
    public function unsetProperty($propertyName)
    {
        unset($this->properties[$propertyName]);
    }

    /**
     * @param string $propertyName
     * @return BasicProperty
     */
    public function getProperty($propertyName)
    {
        return $this->properties[$propertyName];
    }

    /**
     * @param $propertyName
     * @param $propertyValue
     */
    public function setProperty($propertyName, $propertyValue)
    {
        $this->getProperty($propertyName)->setValue($propertyValue);
    }

    /**
     * @return BasicProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @return string[]
     */
    public function getPropertiesColNames()
    {
        $propertiesColNames = array();
        foreach ($this->properties as $property) {
            array_push($propertiesColNames, $property->getColName());
        }
        unset($property);
        return $propertiesColNames;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    abstract public function getDisplayName();

    /**
     * @return BasicEntity
     */
    public function save()
    {
        $excludedProperties = array(self::PROP_ID);
        $this->actionHelper->insert($excludedProperties);
        return $this;
    }

    /**
     * @return BasicEntity
     */
    public function update()
    {
        $this->actionHelper->update();
        return $this;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $result = $this->actionHelper->delete();
        return $result;
    }


}