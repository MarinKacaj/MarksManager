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
use InvalidArgumentException;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

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
     * @var int
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
        return array(self::PROP_ID => $this->id);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        if ($id >= self::UNSAVED_INSTANCE_ID) {
            $this->id = intval($id);
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @param string $primaryKeyColName
     * @param string[] $params
     */
    protected function setIdFromParams($primaryKeyColName, $params)
    {
        if (isset($params[$primaryKeyColName])) {
            $id = $params[$primaryKeyColName];
            $this->setId($id);
        } else {
            $this->setId(self::UNSAVED_INSTANCE_ID);
        }
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