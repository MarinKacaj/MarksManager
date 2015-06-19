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
     * @var string
     */
    private $tableName;
    /**
     * @var string
     */
    private $label;

    /**
     * @param string $className
     * @param string $tableName
     * @param string $label
     */
    function __construct($className, $tableName, $label)
    {
        $this->className = $className;
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
     * @param array $uniqueIdentifier
     * @return BasicEntity
     */
    public function getByIdentifier($uniqueIdentifier)
    {
        $entityInstance = EntityActionHelper::retrieve(
            $this->className,
            $this->tableName,
            $uniqueIdentifier
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