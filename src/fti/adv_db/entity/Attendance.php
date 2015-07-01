<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 10:18 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\BooleanProperty;
use fti\adv_db\property\EntityProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class Attendance
 * @package fti\adv_db\entity
 */
class Attendance extends BasicEntity
{

    const TABLE_NAME = 'frekuentim';
    const LABEL = 'Frekuentim';

    const PROP_SUBJECT_ID = 'id_lende';
    const PROP_STUDENT_ID = 'id_student';
    const PROP_DEPARTMENT_ID = 'id_dege';
    const PROP_SEMINARIES = 'frek_semin';
    const PROP_LAB = 'frek_lab';
    const PROP_ASSIGNMENT = 'kalon_dk';
    const PROP_STATUS = 'gjendja';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->label = self::LABEL;

        $this->id = array(
            self::PROP_SUBJECT_ID => intval($params[self::PROP_SUBJECT_ID]),
            self::PROP_STUDENT_ID => intval($params[self::PROP_STUDENT_ID]),
            self::PROP_DEPARTMENT_ID => intval($params[self::PROP_DEPARTMENT_ID])
        );

        $this->properties[self::PROP_SUBJECT_ID] = new EntityProperty(
            self::PROP_SUBJECT_ID, 'Lende', $this->id[self::PROP_SUBJECT_ID], Subject::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_STUDENT_ID] = new EntityProperty(
            self::PROP_STUDENT_ID, 'Student', $this->id[self::PROP_STUDENT_ID], Student::getBuilder()->getList(), true,
            true, Student::getBuilder()->getByIdentifier(array(Student::PROP_ID => $this->id[self::PROP_STUDENT_ID]))
        );
        $this->properties[self::PROP_DEPARTMENT_ID] = new EntityProperty(
            self::PROP_DEPARTMENT_ID, 'Dege', $this->id[self::PROP_DEPARTMENT_ID], Department::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_SEMINARIES] = new BooleanProperty(
            self::PROP_SEMINARIES, 'Frekuentim Seminaresh', $params, self::PROP_SEMINARIES, true, true
        );
        $this->properties[self::PROP_LAB] = new BooleanProperty(
            self::PROP_LAB, 'Frekuentim Laboratoresh', $params, self::PROP_LAB, true, true
        );
        $this->properties[self::PROP_ASSIGNMENT] = new BooleanProperty(
            self::PROP_ASSIGNMENT, 'Dor&euml;zim Detyre Kursi', $params, self::PROP_ASSIGNMENT, true, true
        );
        $this->properties[self::PROP_STATUS] = new BooleanProperty(
            self::PROP_STATUS, 'P&euml;rmir&euml;sim', $params, self::PROP_STATUS, true, true
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
        return $this->getProperty(self::PROP_SUBJECT_ID)->getValue() . '#' .
        $this->getProperty(self::PROP_DEPARTMENT_ID)->getValue() . '#' .
        $this->getProperty(self::PROP_STUDENT_ID)->getValue();
    }
}