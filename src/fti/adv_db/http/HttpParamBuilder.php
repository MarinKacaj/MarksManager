<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 6/12/2015
 * Time: 10:47 AM
 */

namespace fti\adv_db\http;


use fti\adv_db\entity\Entity;
use ReflectionClass;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class HttpParamBuilder
 * @package fti\adv_db\http
 */
class HttpParamBuilder
{

    const NO_IDENTIFIER_REQ_FOR_ACTION = -1;

    /**
     * @var string[]
     */
    private $propertiesMap;

    /**
     * @param string $parentIdName [optional]
     */
    function __construct($parentIdName = '')
    {
        $this->propertiesMap = $_POST;
        if (isset($_GET[Entity::PROP_ID])) {
            $this->propertiesMap[Entity::PROP_ID] = intval($_GET[Entity::PROP_ID]);
        }
        if (!empty($parentIdName)) {
            $this->propertiesMap[$parentIdName] = $_GET[$parentIdName];
        }
    }


    /**
     * @return string[]
     */
    public function getPropertiesMap()
    {
        return $this->propertiesMap;
    }

    /**
     * @return int
     */
    public function getId()
    {
        if (isset($this->propertiesMap[Entity::PROP_ID])) {
            return $this->propertiesMap[Entity::PROP_ID];
        } else {
            return self::NO_IDENTIFIER_REQ_FOR_ACTION;
        }
    }

    /**
     * @param string $class
     * @return string[]
     */
    private function getPropertyNames($class)
    {
        $metaEntity = new ReflectionClass($class);
        $propertyNames = $metaEntity->getConstants();

        foreach ($propertyNames as $index => $property) {
            if (strpos($index, Entity::PROPERTY_PREFIX) !== 0) {
                unset($propertyNames[$index]);
            }
        }
        unset($index);
        unset($property);

        return $propertyNames;
    }

    /**
     * @param string $entityClassName
     * @return string[]
     */
    public function buildEntityParamMap($entityClassName)
    {
        $properties = array();

        $entityPropertyNames = self::getPropertyNames($entityClassName);
        $receivedPropertyNames = array_keys($this->propertiesMap);
        $legitPropertyNames = array_intersect($entityPropertyNames, $receivedPropertyNames);

        foreach ($legitPropertyNames as $legitPropertyName)
        {
            $properties[$legitPropertyName] = $this->propertiesMap[$legitPropertyName];
        }
        unset($legitPropertyName);

        return $properties;
    }
}