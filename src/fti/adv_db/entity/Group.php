<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 10:47 PM
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
 * Class Group
 * @package fti\adv_db\entity
 */
class Group extends BasicEntity
{

    const TABLE_NAME = 'grup';
    const LABEL = 'Grup';

    const PROP_NAME = 'em_grup';
    const PROP_DEPARTMENT_ID = 'id_dege';
    const PROP_START_AY_ID = 'id_va_fillim';

    /**
     * @param array $params
     * @param bool $isPartOfList [optional]
     */
    function __construct($params, $isPartOfList = false)
    {
        $this->label = self::LABEL;
        $this->id = array(self::PROP_ID => $params[self::PROP_ID]);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);
        $this->properties[self::PROP_NAME] = new StringProperty(self::PROP_NAME, 'Emri', $params[self::PROP_NAME], true, true);
        $this->properties[self::PROP_DEPARTMENT_ID] = new EntityProperty(
            self::PROP_DEPARTMENT_ID, 'Dega', intval($params[self::PROP_DEPARTMENT_ID]), Department::getBuilder()->getList($isPartOfList), true
        );
        $this->properties[self::PROP_START_AY_ID] = new EntityProperty(
            self::PROP_START_AY_ID, 'Viti Akademik', intval($params[self::PROP_START_AY_ID]), AcademicYear::getBuilder()->getList($isPartOfList), true
        );

        $this->actionHelper = new EntityActionHelper(self::TABLE_NAME, $this);
        $this->isPartOfList = $isPartOfList;
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
        $departmentID = intval($this->getProperty(self::PROP_DEPARTMENT_ID)->getValue());
        $departmentInstance = Department::getBuilder()->getByIdentifier(array(Department::PROP_ID => $departmentID));
        return $this->getProperty(self::PROP_NAME)->getValue() . ' ' . $departmentInstance->getDisplayName();
    }
}