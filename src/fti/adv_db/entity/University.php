<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 9:52 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\property\ADString;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

class University extends Entity
{

    const NAME = 'name';
    const CITY = 'city';

    /**
     * @param string $name
     * @param string $city
     * @param int $id
     */
    function __construct($name, $city, $id = Entity::UNSAVED_INSTANCE_ID)
    {
        parent::__construct($id, 'IAL');

        $this->properties[self::NAME] = new ADString('Em_IAL', 'Emri', $name);
        $this->properties[self::CITY] = new ADString('Qytet', 'Qyteti', $city);
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->properties[self::NAME];
    }

    /**
     * @return University[]
     */
    public function getList()
    {
        return array($this); // TODO - Get list from query result
    }


}