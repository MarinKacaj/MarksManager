<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 12:17 AM
 */

namespace fti\adv_db\entity\util;


use fti\adv_db\entity\BasicEntity;
use fti\adv_db\entity\Entity;
use ReflectionClass;

require_once dirname(dirname(dirname(__FILE__))) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class EmptyEntityBuilder
 * @package fti\adv_db\entity\util
 */
class EmptyEntityBuilder
{

    /**
     * @param string $entityClassName
     * @param string[]|NULL $paramNames [optional]
     * @param string $primaryKeyColName [optional]
     * @return Entity
     */
    public static function buildFromParamNames($entityClassName, $paramNames = NULL, $primaryKeyColName = Entity::PROP_ID)
    {
        if (is_null($paramNames)) {
            $entityReflection = new ReflectionClass($entityClassName);
            $paramNames = $entityReflection->getConstants();
            foreach ($paramNames as $constName => $paramName) {
                if (strpos($constName, Entity::PROPERTY_PREFIX) !== 0) {
                    unset($paramNames[$constName]);
                }
            }
            unset($index);
            unset($paramName);
        }
        $params = array($primaryKeyColName => Entity::UNSAVED_INSTANCE_ID);

        foreach ($paramNames as $paramName) {
            if (strcmp($paramName, $primaryKeyColName) === 0) {
                $params[$paramName] = BasicEntity::UNSAVED_INSTANCE_ID;
            } else {
                $params[$paramName] = '';
            }
        }
        unset($paramName);

        return new $entityClassName($params);
    }


}