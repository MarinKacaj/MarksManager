<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/15/2015
 * Time: 1:11 PM
 */

namespace fti\adv_db\entity\util;


use fti\adv_db\entity\BasicEntity;

require_once dirname(dirname(dirname(__FILE__))) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class EntityBuilderHelper
 * @package fti\adv_db\entity\util
 */
class EntityBuilderHelper
{

    /**
     * @var string
     */
    private $className;
    /**
     * @var
     */
    private $primaryKeyColName;
    /**
     * @var string
     */
    private $tableName;
    /**
     * @var string
     */
    private $label;

    /**
     * @param string $className
     * @param string $primaryKeyColName
     * @param string $tableName
     * @param string $label
     */
    function __construct($className, $primaryKeyColName, $tableName, $label)
    {
        $this->className = $className;
        $this->primaryKeyColName = $primaryKeyColName;
        $this->tableName = $tableName;
        $this->label = $label;
    }


    /**
     * @return BasicEntity
     */
    public function createEmpty()
    {
        $emptyInstance = EmptyEntityBuilder::buildFromParamNames($this->className);
        return $emptyInstance;
    }

    /**
     * @param $uniqueIdentifier
     * @return BasicEntity
     */
    public function getByIdentifier($uniqueIdentifier)
    {
        $entityInstance = EntityActionHelper::retrieve(
            __CLASS__,
            $this->tableName,
            array($this->primaryKeyColName => $uniqueIdentifier)
        );
        return $entityInstance;
    }

    /**
     * @return BasicEntity[]
     */
    public function getList()
    {
        $entityInstances = EntityActionHelper::getFullList($this->className, $this->tableName);
        return $entityInstances;
    }


}