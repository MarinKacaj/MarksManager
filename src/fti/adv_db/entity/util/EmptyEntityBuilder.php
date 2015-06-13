<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 12:17 AM
 */

namespace fti\adv_db\entity\util;


use fti\adv_db\entity\Entity;

require_once dirname(dirname(dirname(__FILE__))) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class EmptyEntityBuilder
 * @package fti\adv_db\entity\util
 */
class EmptyEntityBuilder
{

    /**
     * @var string
     */
    private $entityClassName;

    /**
     * @param string $entityClassName
     */
    function __construct($entityClassName)
    {
        $this->entityClassName = $entityClassName;
    }

    /**
     * @param string[] $paramNames
     * @param string $primaryKeyColName
     * @return Entity
     */
    public function buildFromParamNames($paramNames, $primaryKeyColName)
    {
        $params = array($primaryKeyColName => Entity::UNSAVED_INSTANCE_ID);

        foreach ($paramNames as $paramName) {
            $params[$paramName] = '';
        }
        unset($paramName);

        return new $this->entityClassName($params);
    }


}