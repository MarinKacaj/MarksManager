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

/**
 * Class University
 * @package fti\adv_db\entity
 */
class University extends Entity
{

    const PROP_NAME = 'name';
    const PROP_CITY = 'city';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->tableName = 'ial';
        $this->label = 'IAL';
        $this->setIdFromParams($params);
        $this->properties[self::PROP_NAME] = new StringProperty(self::PROP_NAME, 'Em_IAL', 'Emri', $params[self::PROP_NAME]);
        $this->properties[self::PROP_CITY] = new StringProperty(self::PROP_CITY, 'Qytet', 'Qyteti', $params[self::PROP_CITY]);
    }


    /**
     * @param array $params
     * @return University
     */
    public function create($params)
    {
        return new University($params);
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return get_class();
    }

    /**
     * @return string
     */
    public static function getEntityClassName()
    {
        return __CLASS__;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->properties[self::PROP_NAME];
    }


}