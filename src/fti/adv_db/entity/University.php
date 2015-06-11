<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 9:52 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

class University extends Entity
{

    const PROP_NAME = 'name';
    const PROP_CITY = 'city';

    /**
     * @param string $name
     * @param string $city
     * @param int $id
     */
    function __construct($name, $city, $id = Entity::UNSAVED_INSTANCE_ID)
    {
        parent::__construct($id, 'IAL');

        $this->properties[self::PROP_NAME] = new StringProperty('Em_IAL', 'Emri', $name);
        $this->properties[self::PROP_CITY] = new StringProperty('Qytet', 'Qyteti', $city);
    }


    public function createFromMap($propertiesMap)
    {
        $properties = array();

        $entityPropertyNames = Entity::getPropertyNames(__CLASS__);
        $receivedPropertyNames = array_keys($propertiesMap);
        $legitPropertyNames = array_intersect($entityPropertyNames, $receivedPropertyNames);

        foreach ($legitPropertyNames as $legitPropertyName)
        {
            $properties[$legitPropertyName] = $propertiesMap[$legitPropertyName];
        }
        unset($legitPropertyName);

        return $properties;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->properties[self::PROP_NAME];
    }

    /**
     * @return University[]
     */
    public function getList()
    {
        return array($this); // TODO - Get list from query result
    }


}