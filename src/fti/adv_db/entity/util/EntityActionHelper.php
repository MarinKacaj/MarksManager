<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:32 AM
 */

namespace fti\adv_db\entity\util;


use fti\adv_db\db\DeleteQuery;
use fti\adv_db\db\InsertQuery;
use fti\adv_db\db\SelectQuery;
use fti\adv_db\db\UpdateQuery;
use fti\adv_db\entity\BasicEntity;
use fti\adv_db\entity\Entity;

require_once dirname(dirname(dirname(__FILE__))) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class EntityActionHelper
 * @package fti\adv_db\entity\util
 */
class EntityActionHelper
{

    /**
     * @var string
     */
    private $tableName;
    /**
     * @var BasicEntity
     */
    private $entityInstance;

    /**
     * @param string $tableName
     * @param BasicEntity $entityInstance
     */
    function __construct($tableName, $entityInstance)
    {
        $this->tableName = $tableName;
        $this->entityInstance = $entityInstance;
    }


    /**
     * @param string $entityClassName
     * @param string $entityTableName
     * @param array $filter
     * @return Entity|bool
     */
    public static function retrieve($entityClassName, $entityTableName, $filter)
    {
        $selectQuery = new SelectQuery(
            array(),
            array($entityTableName),
            $filter
        );
        $singleResultList = $selectQuery->exec();
        $params = $singleResultList->fetch_assoc();
        if ($params) {
            $entityInstance = new $entityClassName($params);
        } else {
            $entityInstance = false;
        }
        return $entityInstance;
    }

    /**
     * @param string $entityClassName
     * @param string $entityTableName
     * @param array $filterData
     * @return array
     */
    public static function getFilteredList($entityClassName, $entityTableName, $filterData)
    {
        $entityInstances = array();

        $selectQuery = new SelectQuery(array(), array($entityTableName), $filterData);
        $resultList = $selectQuery->exec();
        while (($params = $resultList->fetch_assoc()) !== NULL) {
            $entityInstance = new $entityClassName($params);
            array_push($entityInstances, $entityInstance);
        }

        return $entityInstances;
    }

    /**
     * @param string $entityClassName
     * @param string $entityTableName
     * @return BasicEntity[]
     */
    public static function getFullList($entityClassName, $entityTableName)
    {
        return self::getFilteredList($entityClassName, $entityTableName, array());
    }

    /**
     * @param array $excludedPropertyNames
     * @return bool
     */
    public function insert($excludedPropertyNames = array())
    {
        $nameValuePairs = array();
        $properties = $this->entityInstance->getProperties();

        foreach ($excludedPropertyNames as $excludedPropertyName) {
            unset($properties[$excludedPropertyName]);
        }
        unset($excludedPropertyName);

        foreach ($properties as $property) {
            $nameValuePairs[$property->getColName()] = $property->getValue();
        }
        unset($property);

        $insertQuery = new InsertQuery($this->tableName, $nameValuePairs);
        $result = $insertQuery->exec();
        $insertID = $insertQuery->getLastInsertedID();
        if ($insertID) {
            $this->entityInstance->setID($insertID);
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function update()
    {
        $nameValuePairsToSet = array();
        $properties = $this->entityInstance->getProperties();

        foreach ($properties as $property) {
            $nameValuePairsToSet[$property->getColName()] = $property->getValue();
        }
        unset($property);

        $filters = $this->entityInstance->getIdentifier();

        $updateQuery = new UpdateQuery($this->tableName, $nameValuePairsToSet, $filters);
        $result = $updateQuery->exec();
        return $result;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $filters = $this->entityInstance->getIdentifier();

        $deleteQuery = new DeleteQuery($this->tableName, $filters);
        $result = $deleteQuery->exec();
        return $result;
    }


}