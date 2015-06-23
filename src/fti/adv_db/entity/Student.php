<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 10:39 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\EntityProperty;
use fti\adv_db\property\IntegerProperty;
use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class Student
 * @package fti\adv_db\entity
 */
class Student extends BasicEntity
{

    const TABLE_NAME = 'student';
    const LABEL = 'Student';

    const PROP_FIRST_NAME = 'em_student';
    const PROP_LAST_NAME = 'mb_student';
    const PROP_GROUP_ID = 'id_grup';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->label = self::LABEL;
        $this->id = array(self::PROP_ID => $params[self::PROP_ID]);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);
        $this->properties[self::PROP_FIRST_NAME] = new StringProperty(self::PROP_FIRST_NAME, 'Emri', $params[self::PROP_FIRST_NAME], true, true);
        $this->properties[self::PROP_LAST_NAME] = new StringProperty(self::PROP_LAST_NAME, 'Mbiemri', $params[self::PROP_LAST_NAME], true, true);
        $this->properties[self::PROP_GROUP_ID] = new EntityProperty(
            self::PROP_GROUP_ID, 'Grupi', intval($params[self::PROP_GROUP_ID]), Group::getBuilder()->getList(), true
        );

        $this->actionHelper = new EntityActionHelper(self::TABLE_NAME, $this);
    }


    /**
     * @return EntityBuilderHelper
     */
    public static function getBuilder()
    {
        return new EntityBuilderHelper(__CLASS__, self::TABLE_NAME, self::LABEL);
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty(self::PROP_FIRST_NAME)->getValue() . ' ' .
        $this->getProperty(self::PROP_LAST_NAME)->getValue();
    }
}