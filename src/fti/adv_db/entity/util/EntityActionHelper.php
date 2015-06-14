<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:32 AM
 */

namespace fti\adv_db\entity\util;


use fti\adv_db\db\InsertQuery;
use fti\adv_db\db\UpdateQuery;
use fti\adv_db\entity\BasicEntity;

require_once dirname(dirname(dirname(__FILE__))) . '/functions/auto_loader.php';

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
        $this->entityInstance->setId($insertID);
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

        $filter = array($this->entityInstance->getPrimaryKeyColName() => $this->entityInstance->getID());

        $updateQuery = new UpdateQuery($this->tableName, $nameValuePairsToSet, $filter);
        $result = $updateQuery->exec();
        return $result;
    }


}