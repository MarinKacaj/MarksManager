<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 10:02 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\db\SelectQuery;
use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\property\BasicProperty;
use InvalidArgumentException;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

abstract class BasicEntity implements Entity
{

    const TABLE_NAME = '';
    const LABEL = '';
    const PROP_ID = 'id';


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
    abstract public function getEntityName();

    /**
     * @return string
     */
    public static function getPrimaryKeyColName()
    {
        return self::PROP_ID;
    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->id;
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

    // TODO - move the following two functions to a more appropriate class
    /**
     * @param string $entityClassName
     * @param string $entityTableName
     * @param string $entityPrimaryKeyColName
     * @param int $id
     * @return BasicEntity
     */
    public static function retrieveByID($entityClassName, $entityTableName, $entityPrimaryKeyColName, $id)
    {
        $selectQuery = new SelectQuery(
            array(),
            array($entityTableName),
            array($entityPrimaryKeyColName => $id));
        $singleResultList = $selectQuery->exec();
        $params = $singleResultList->fetch_assoc();
        $entityInstance = new $entityClassName($params);
        return $entityInstance;
    }

    /**
     * @param string $entityClassName
     * @param string $entityTableName
     * @return BasicEntity[]
     */
    public static function getFullList($entityClassName, $entityTableName)
    {
        $entityInstances = array();

        $selectQuery = new SelectQuery(array(), array($entityTableName));
        $resultList = $selectQuery->exec();
        while (($params = $resultList->fetch_assoc()) !== NULL) {
            $entityInstance = new $entityClassName($params);
            array_push($entityInstances, $entityInstance);
        }

        return $entityInstances;
    }


}